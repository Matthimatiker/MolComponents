<?php

/**
 * Mol_Form_Factory_Plugin_Captcha
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 12.03.2013
 */

/**
 * Plugin that is able to add captchas to forms.
 *
 * # Usage #
 *
 * ## Overview ##
 *
 * The captcha plugin checks during creation if the form requests captcha
 * protection.
 * If required a captcha element will be added right in front of the last
 * button in the form.
 *
 * ## Plugin Configuration ##
 *
 * The plugin can be activated via form factory configuration:
 *
 *     resources.form.plugins.captcha.class = "Mol_Form_Factory_Plugin_Captcha"
 *     resources.form.plugins.captcha.options.element.name = "my_captcha"
 *     resources.form.plugins.captcha.options.element.captcha.captcha    = "Image"
 *     resources.form.plugins.captcha.options.element.captcha.imgDir     = "/path/to/generated/captchas"
 *     resources.form.plugins.captcha.options.element.captcha.imgUrl     = "/url/to/captchas"
 *     resources.form.plugins.captcha.options.element.captcha.imgAlt     = "Alternative text"
 *     resources.form.plugins.captcha.options.element.captcha.font       = "/path/to/font/file"
 *     resources.form.plugins.captcha.options.element.captcha.wordlen    = 5
 *     resources.form.plugins.captcha.options.element.captcha.width      = 200
 *     resources.form.plugins.captcha.options.element.captcha.height     = 100
 *     resources.form.plugins.captcha.options.element.captcha.expiration = 600
 *
 * ## Captcha Activation ##
 *
 * To ensure that a captcha is injected the form must set the attribute
 * "data-captcha" to "yes":
 *
 *     $form->setAttrib('data-captcha', 'yes');
 *
 * ## ID generation ##
 *
 * To avoid ID clashes whenever two captchas are rendered on the same page
 * the plugin can generate unique IDs for each added captcha.
 *
 * This behavior can be activated via option:
 *
 *     ; [...]
 *     resources.form.plugins.captcha.options.generateId = On
 *     ; [...]
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 12.03.2013
 */
class Mol_Form_Factory_Plugin_Captcha extends Mol_Form_Factory_Plugin_AbstractPlugin
{
    
    /**
     * The default nam of the added captcha element.
     *
     * @var string
     */
    const DEFAULT_CAPTCHA_NAME = 'captcha';
    
    /**
     * The options that are used to create the captcha.
     *
     * @var array(string=>mixed)
     */
    protected $captchaOptions = null;
    
    /**
     * See {@link Mol_Form_Factory_Plugin::__construct()} for details.
     *
     * @param array(string=>mixed) $options
     */
    public function __construct(array $options = array())
    {
        parent::__construct($options);
        $elementOptions = $this->getOption('element', array());
        $this->captchaOptions = $this->mergeWithDefaults($elementOptions);
    }
    
    /**
     * Adds a captcha element to the given form if the for attribute
     * "data-captcha" equals true or "yes".
     *
     * The "data-captcha" attribute is removed after processing to
     * ensure that it is not rendered by the form.
     *
     * @param Zend_Form $form
     */
    public function enhance(Zend_Form $form)
    {
        $activate = $form->getAttrib('data-captcha');
        if ($activate === null) {
            // Form does not define instructions regarding captcha usage.
            return;
        }
        // Remove the attribute to ensure that the instruction is not rendered.
        $form->removeAttrib('data-captcha');
        if ($activate !== 'yes') {
            return;
        }
        $this->addCaptcha($form);
    }
    
    /**
     * Adds a captcha to the given form.
     *
     * @param Zend_Form $form
     */
    protected function addCaptcha(Zend_Form $form)
    {
        $captcha = $this->createCaptcha();
        $button  = $this->getLastButton($form);
        if ($button !== null) {
            $this->insertBefore($form, $button, $captcha);
        } else {
            $form->addElement($captcha);
        }
    }
    
    /**
     * Inserts $newElement right before $reference.
     *
     * @param Zend_Form $form
     * @param Zend_Form_Element $reference
     * @param Zend_Form_Element $newElement
     */
    protected function insertBefore(Zend_Form $form, Zend_Form_Element $reference, Zend_Form_Element $newElement)
    {
        /* @var $orderedElements array(Zend_Form_Element|Zend_Form|Zend_Form_DisplayGroup) */
        $orderedElements = array_values(iterator_to_array($form));
        // Ensure that each element has a numerical order value.
        $this->assignOrderValues($orderedElements);
        
        $buttonIndex = array_search($reference, $orderedElements, true);
        $buttonOrder = $orderedElements[$buttonIndex]->getOrder();
        if ($buttonIndex === 0) {
            // Button is the first element, therefore no previous element
            // whose order could be used for calculation exists.
            // Choose a constant value which ensures that the calculated
            // order value for the new element avoids re-ordering.
            $previousElementOrder = $buttonOrder - 2;
        } else {
            $previousElementOrder = $orderedElements[$buttonIndex - 1]->getOrder();
        }
        // Try to assign an order value between previous element and button order value.
        $newElementOrder = (int)round(($previousElementOrder + $buttonOrder) / 2);
        $newElement->setOrder($newElementOrder);
        // Insert $newElement at the position of the button.
        array_splice($orderedElements, $buttonIndex, 0, array($newElement));
        if ($newElementOrder === $buttonOrder) {
            // Order values clash, therefore a re-ordering of the elements
            // starting with the captcha is required.
            $elementsFromCaptcha = array_slice($orderedElements, $buttonIndex);
            $this->assignOrderValues($elementsFromCaptcha);
        }
        
        $this->reAssignElements($form, $orderedElements);
    }
    
    /**
     * Explicitly removes and re-adds elements to the provided form to
     * ensure that the form re-builds the element order.
     *
     * Due to a bug this is required if the order of an element is
     * changed after the internal form index was created:
     * {@link http://framework.zend.com/issues/browse/ZF-9946}
     *
     * @param Zend_Form $form
     * @param array $elements
     */
    protected function reAssignElements(Zend_Form $form, array $elements)
    {
        $form->clearElements();
        $form->addElements($elements);
    }
    
    /**
     * Assigns numerical order values to the provided form elements
     * in such a way that the array order is preserved.
     *
     * If possible existing order values will be preserved.
     *
     * @param array(Zend_Form_Element|Zend_Form|Zend_Form_DisplayGroup) $elements Non-empty list of elements.
     */
    protected function assignOrderValues(array $elements)
    {
        // Initialize order value of first element if necessary.
        if ($elements[0]->getOrder() === null) {
            $elements[0]->setOrder(0);
        }
        $numberOfElements = count($elements);
        for ($i = 1; $i < $numberOfElements; $i++) {
            /* @var $element Zend_Form_Element|Zend_Form|Zend_Form_DisplayGroup */
            $element = $elements[$i];
            /* @var $previousElement Zend_Form_Element|Zend_Form|Zend_Form_DisplayGroup */
            $previousElement = $elements[$i - 1];
            if ($element->getOrder() === null || $element->getOrder() <= $previousElement->getOrder()) {
                // Preserve the current element order.
                $element->setOrder($previousElement->getOrder() + 1);
            }
        }
    }
    
    /**
     * Returns the last button in the given form.
     *
     * Returns null if the form does not contain any button.
     *
     * @param Zend_Form $form
     * @return Zend_Form_Element_Submit|null
     */
    protected function getLastButton(Zend_Form $form)
    {
        $elements = $form->getElementsAndSubFormsOrdered();
        foreach (array_reverse($elements) as $element) {
            /* @var $element Zend_Form|Zend_Form_Element */
            if ($element instanceof Zend_Form_Element_Submit) {
                // Button found.
                return $element;
            }
        }
        // Form does not contain any button.
        return null;
    }
    
    /**
     * Merges defaults into the given options where necessary.
     *
     * @param array(string=>mixed) $options
     * @return array(string=>mixed) The merged options.
     */
    protected function mergeWithDefaults(array $options)
    {
        $defaults = $this->getDefaultOptions();
        $options  = $options + $defaults;
        // Ensure that captcha adapter options are merged too.
        $options['captcha'] = $options['captcha'] + $defaults['captcha'];
        return $options;
    }
    
    /**
     * Returns the default options that are used to create the captcha.
     *
     * @return array(string=>mixed)
     */
    protected function getDefaultOptions()
    {
        return array(
            'name'  =>  self::DEFAULT_CAPTCHA_NAME,
            'label' => 'Please enter the code',
            'captcha' => array(
                'captcha' => 'Figlet',
                'wordLen' => 6,
                'timeout' => 900
            )
        );
    }
    
    /**
     * Creates the captcha element.
     *
     * @return Zend_Form_Element
     */
    protected function createCaptcha()
    {
        $captcha = new Zend_Form_Element_Captcha($this->captchaOptions);
        if ($this->getOption('generateId', false)) {
            // Generate a unique element ID to avoid clashes if two
            // captchas are rendered on the same page.
            $captcha->setAttrib('id', $captcha->getId() . '-' . uniqid());
        }
        return $captcha;
    }
    
}
