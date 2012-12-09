<?php

/**
 * Mol_Form_Factory_Plugin_Csrf
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 08.10.2012
 */

/**
 * Plugin that adds CSRF tokens to forms.
 *
 * # Usage #
 *
 * ## Configuration ##
 *
 * Activate CSRF plugin without further configuration:
 *
 *     resources.form.plugins.csrf = "Mol_Form_Factory_Plugin_Csrf"
 *
 * Configure added element in detail:
 *
 *     resources.form.plugins.csrf.class = "Mol_Form_Factory_Plugin_Csrf"
 *     resources.form.plugins.csrf.options.element.name    = "my_csrf_token"
 *     resources.form.plugins.csrf.options.element.salt    = "secret-salt"
 *     resources.form.plugins.csrf.options.element.timeout = 1800
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 08.10.2012
 */
class Mol_Form_Factory_Plugin_Csrf implements Mol_Form_Factory_Plugin
{
    
    /**
     * The default name for the token element.
     *
     * @var string
     */
    const DEFAULT_TOKEN_NAME = 'csrf_token';
    
    /**
     * Options for the csrf element.
     *
     * @var array(string=>mixed)
     */
    protected $csrfOptions = null;
    
    /**
     * See {@link Mol_Form_Factory_Plugin::__construct()} for details.
     *
     * @param array(string=>mixed) $options
     */
    public function __construct(array $options = array())
    {
        $elementOptions = isset($options['element']) ? $options['element'] : array();
        if (is_string($elementOptions)) {
            // Just the element name was provided.
            $elementOptions = array('name' => $elementOptions);
        }
        if (!isset($elementOptions['name'])) {
            $elementOptions['name'] = self::DEFAULT_TOKEN_NAME;
        }
        $this->csrfOptions = $elementOptions;
    }
    
    /**
     * Adds a CSRF token to the form if it does not already contain one.
     *
     * @param Zend_Form $form
     */
    public function enhance(Zend_Form $form)
    {
        if ($this->hasCsrf($form)) {
            return;
        }
        $csrf = $this->createCsrf();
        if ($form->getElement($csrf->getName())) {
            // Form already contains an element with the
            // same name, do not overwrite it.
            return;
        }
        $form->addElement($csrf);
    }
    
    /**
     * Checks if the provided form already contains a CSRF element.
     *
     * @param Zend_Form $form
     * @return boolean
     */
    protected function hasCsrf(Zend_Form $form)
    {
        foreach ($form->getElements() as $element) {
            /* @var $element Zend_Form_Element */
            if ($element instanceof Zend_Form_Element_Hash) {
                // Form already contains a CSRF token.
                return true;
            }
        }
        return false;
    }
    
    /**
     * Creates a new CSRF element.
     *
     * @return Zend_Form_Element_Hash
     */
    protected function createCsrf()
    {
        return new Zend_Form_Element_Hash($this->csrfOptions);
    }
    
}
