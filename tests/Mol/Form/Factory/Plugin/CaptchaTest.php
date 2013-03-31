<?php

/**
 * Mol_Form_Factory_Plugin_Captcha
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 12.03.2013
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the Captcha form plugin.
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 12.03.2013
 */
class Mol_Form_Factory_Plugin_CaptchaTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Form_Factory_Plugin_Captcha
     */
    protected $plugin = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        // Create a duck-typed session class to ensure that real session is started.
        $sessionClass = $this->getMockClass('stdClass', array('setExpirationHops', 'setExpirationSeconds'));
        $options = array(
            'generateId' => true,
            'element' => array(
                'id' => 'test-id',
                'captcha' => array(
                    'sessionClass' => $sessionClass
                )
            )
        );
        $this->plugin = new Mol_Form_Factory_Plugin_Captcha($options);
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->plugin = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that the plugin does not add a captcha element if the
     * "data-captcha" form attribute does not exist.
     */
    public function testPluginDoesNotAddElementIfCaptchaAttributeIsMissing()
    {
        $form = $this->createForm();
        
        $this->plugin->enhance($form);
        
        $this->assertCount(2, $form->getElements());
    }
    
    /**
     * Ensures that the plugin does not add a captcha element if the
     * "data-captcha" form attribute exists, but it is neither equal
     * to "yes" nor to true.
     */
    public function testPluginDoesNotAddElementIfFormAttributeExistsButDoesNotActivateCaptcha()
    {
        $form = $this->createForm();
        $form->setAttrib('data-captcha', 'no');
        
        $this->plugin->enhance($form);
        
        $this->assertCount(2, $form->getElements());
    }
    
    /**
     * Ensures that the plugin adds a captcha element if the "data-captcha"
     * form attribute equals "yes".
     */
    public function testPluginAddsElementIfFormAttributeRequestsCaptcha()
    {
        $form = $this->createForm();
        $form->setAttrib('data-captcha', 'yes');
        
        $this->plugin->enhance($form);
        
        $this->assertCount(3, $form->getElements());
    }
    
    /**
     * Ensures that the captcha element is added in front of the submit button.
     */
    public function testPluginAddsCaptchaInFrontOfButton()
    {
        $form = $this->createForm();
        $form->setAttrib('data-captcha', 'yes');
        
        $this->plugin->enhance($form);
        
        $this->assertCaptchaInFrontOfLastButton($form);
    }
    
    /**
     * Ensures that the captcha is added in front of the button if the form elements
     * have order values.
     */
    public function testPluginAddsCaptchaInFrontOfButtonIfElementsHaveOrderValues()
    {
        $form = $this->createFormWithOrderedElements(array(0, 10, 20, 30, 40));
        
        $this->plugin->enhance($form);
        
        $this->assertCaptchaInFrontOfLastButton($form);
    }
    
    /**
     * Ensures that the captcha is added in front of the button if the form elements
     * have negative order values.
     */
    public function testPluginAddsCaptchaInFrontOfButtonIfElementsHaveNegativeOrderValues()
    {
        $form = $this->createFormWithOrderedElements(array(-40, -30, -20, -10));
        
        $this->plugin->enhance($form);
        
        $this->assertCaptchaInFrontOfLastButton($form);
    }
    
    
    /**
     * Ensures that the plugin adds the captcha in front of the button if that
     * is the only element in the form.
     */
    public function testPluginAddsCaptchaInFrontOfButtonIfFormContainsOnlyButton()
    {
        $form = $this->createForm();
        $form->removeElement('content');
        $form->setAttrib('data-captcha', 'yes');
        
        $this->plugin->enhance($form);
        
        $this->assertCaptchaInFrontOfLastButton($form);
    }
    
    /**
     * Ensures that the order value of the original form elements is not changed
     * if that is not necessary to insert the captcha.
     */
    public function testPluginDoesNotChangeOrderValuesOfElementsIfNotNecessary()
    {
        $form = $this->createFormWithOrderedElements(array(0, 10, 20, 30, 40));
        
        $this->plugin->enhance($form);
        
        $this->assertOrderValue($form, 'element_0', 0);
        $this->assertOrderValue($form, 'element_10', 10);
        $this->assertOrderValue($form, 'element_20', 20);
        $this->assertOrderValue($form, 'element_30', 30);
        $this->assertOrderValue($form, 'element_40', 40);
    }
    
    /**
     * Ensures that the plugin leaves as much order values as possible
     * untouched even if it is required to change the ordering at least
     * partially to insert the captcha.
     */
    public function testPluginChangesOrderValuesOnlyPartiallyIfRequired()
    {
        $form = $this->createFormWithOrderedElements(array(0, 10, 20, 30, 31));
        
        $this->plugin->enhance($form);
        
        $this->assertOrderValue($form, 'element_0', 0);
        $this->assertOrderValue($form, 'element_10', 10);
        $this->assertOrderValue($form, 'element_20', 20);
        $this->assertOrderValue($form, 'element_30', 30);
    }
    
    /**
     * Checks if the plugin chooses a median order value to insert the captcha element.
     *
     * This ensures that additional elements can be inserted before nd after the captcha
     * without further order changes.
     */
    public function testPluginChoosesMedianOrderValueOfSurroundingElementsForCaptcha()
    {
        $form = $this->createFormWithOrderedElements(array(0, 10, 20, 30, 40));
        
        $this->plugin->enhance($form);
        
        $this->assertOrderValue($form, Mol_Form_Factory_Plugin_Captcha::DEFAULT_CAPTCHA_NAME, 35);
    }
    
    /**
     * Checks if the plugin can handle a form that contains sub forms.
     */
    public function testPluginWorksWithFormThatContainsSubForm()
    {
        $form = $this->createForm();
        $form->setAttrib('data-captcha', 'yes');
        $form->addSubForm(new Zend_Form(), 'sub_form', -10);
        
        $this->setExpectedException(null);
        $this->plugin->enhance($form);
    }
    
    /**
     * Ensures that the captcha is added at the end of the form element
     * list if the form does not contain any button.
     */
    public function testPluginAddsCaptchaElementAtTheEndIfFormDoesNotContainButtons()
    {
        $form = $this->createForm();
        $form->setAttrib('data-captcha', 'yes');
        $form->removeElement('send');
        
        $this->plugin->enhance($form);
        
        $elements = $this->getOrderedElements($form);
        $captcha  = array_pop($elements);
        $this->assertInstanceOf('Zend_Form_Element_Captcha', $captcha);
    }
    
    /**
     * Checks if a "data-captcha" form attribute that does not request
     * a captcha is removed.
     */
    public function testPluginRemovesFormAttributeIfCaptchaIsInactive()
    {
        $form = $this->createForm();
        $form->setAttrib('data-captcha', 'no');
        
        $this->plugin->enhance($form);
        
        $this->assertNull($form->getAttrib('data-captcha'));
    }
    
    /**
     * Checks if a "data-captcha" form attribute that requests a
     * captcha is removed.
     */
    public function testPluginRemovesFormAttributeIfCaptchaIsActive()
    {
        $form = $this->createForm();
        $form->setAttrib('data-captcha', 'yes');
        
        $this->plugin->enhance($form);
        
        $this->assertNull($form->getAttrib('data-captcha'));
    }
    
    /**
     * Ensures that the captcha elements get different IDs if they are added
     * to multiple forms.
     */
    public function testAddedCaptchaElementsGetDifferentIds()
    {
        $first = $this->createForm();
        $first->setAttrib('data-captcha', 'yes');
        $second = $this->createForm();
        $second->setAttrib('data-captcha', 'yes');
        
        $this->plugin->enhance($first);
        $this->plugin->enhance($second);
        
        $firstCaptcha  = $first->getElement(Mol_Form_Factory_Plugin_Captcha::DEFAULT_CAPTCHA_NAME);
        $secondCaptcha = $second->getElement(Mol_Form_Factory_Plugin_Captcha::DEFAULT_CAPTCHA_NAME);
        $this->assertInstanceOf('Zend_Form_Element', $firstCaptcha);
        $this->assertInstanceOf('Zend_Form_Element', $secondCaptcha);
        $this->assertNotEquals($firstCaptcha->getId(), $secondCaptcha->getId());
    }
    
    /**
     * Ensures that the generated captcha ID depends on the ID that was explicitly provided.
     */
    public function testGeneratedIdDependsOnOriginalId()
    {
        $form = $this->createForm();
        $form->setAttrib('data-captcha', 'yes');
        
        $this->plugin->enhance($form);
        
        $captcha = $form->getElement(Mol_Form_Factory_Plugin_Captcha::DEFAULT_CAPTCHA_NAME);
        $this->assertInstanceOf('Zend_Form_Element', $captcha);
        $this->assertContains('test-id', $captcha->getId());
    }
    
    /**
     * Ensures that the plugin does not generate unique captcha element IDs
     * if that behavior was not activated via "generateId" option.
     */
    public function testPluginDoesNotGenerateUniqueIdsIfBehaviorIsNotEnabled()
    {
        $options = array(
            'element' => array(
                'id' => 'test-id'
            )
        );
        $this->plugin = new Mol_Form_Factory_Plugin_Captcha($options);
        
        $form = $this->createForm();
        $form->setAttrib('data-captcha', 'yes');
        
        $this->plugin->enhance($form);
        
        $captcha = $form->getElement(Mol_Form_Factory_Plugin_Captcha::DEFAULT_CAPTCHA_NAME);
        $this->assertInstanceOf('Zend_Form_Element', $captcha);
        $this->assertEquals('test-id', $captcha->getId());
    }
    
    /**
     * Asserts that the captcha element is located in front of the last button
     * in the given form.
     *
     * @param Zend_Form $form
     */
    protected function assertCaptchaInFrontOfLastButton(Zend_Form $form)
    {
        $elements = $this->getOrderedElements($form);
        
        $elementToName = function (Zend_Form_Element $element) {
            return $element->getName();
        };
        $names   = array_map($elementToName, $elements);
        $message = 'Invalid element order detected. Current order: ' . implode(', ', $names);
        
        // Last element should be the button, therefore remove it first.
        $button = array_pop($elements);
        $this->assertInstanceOf('Zend_Form_Element_Submit', $button, $message);
        $captcha = array_pop($elements);
        $this->assertInstanceOf('Zend_Form_Element_Captcha', $captcha, $message);
    }
    
    /**
     * Asserts that the element with the provided name has the given order value.
     *
     * @param Zend_Form $form
     * @param string $elementName
     * @param integer $order
     */
    protected function assertOrderValue(Zend_Form $form, $elementName, $order)
    {
        $element = $form->getElement($elementName);
        $this->assertInstanceOf('Zend_Form_Element', $element, 'Element "' . $elementName . '" does not exist.');
        
        $elements = $this->getOrderedElements($form);
        $getOrder = function ($element) {
            return $element->getOrder();
        };
        $orderValues = array_map($getOrder, $elements);
        $message     = 'Unexpected order value. Order values in form: ' . implode(', ', $orderValues);
        $this->assertSame($order, $element->getOrder(), $message);
    }
    
    /**
     * Returns the elements of the given form in rendering order.
     *
     * @param Zend_Form $form
     * @return array(Zend_Form_Element)
     */
    protected function getOrderedElements(Zend_Form $form)
    {
        $markup = $form->render(new Zend_View());
        // Find the 'name="*"' substrings to determine the real element order.
        $nameAttributes = array();
        preg_match_all('/name="(.*?)(\[.*?\])?"/', $markup, $nameAttributes, PREG_PATTERN_ORDER);
        $names = $nameAttributes[1];
        // Remove duplicates. These can occur if braces notation is used:
        // captcha[id], captcha[input]
        $names = array_unique($names);
        $elements = array_map(array($form, 'getElement'), $names);
        $message  = 'Cannot find one of the following elements in form: ' . implode(', ', $names);
        $this->assertNotContains(null, $elements, $message);
        return $elements;
    }
    
    /**
     * Creates a form for testing.
     *
     * @return Zend_Form
     */
    protected function createForm()
    {
        $form = new Zend_Form();
        $form->addElement(new Zend_Form_Element_Text('content'));
        $form->addElement(new Zend_Form_Element_Submit('send'));
        return $form;
    }
    
    /**
     * Creates a form that requests a captcha and whose elements use
     * order values.
     *
     * This method uses the provided order values for the added elements.
     * The last value is used for the button element.
     * The elements are named by their order: "element_$order"
     *
     * @param array(integer) $orderValues
     * @return Zend_Form
     */
    protected function createFormWithOrderedElements(array $orderValues)
    {
        $buttonOrder = array_pop($orderValues);
        $form = new Zend_Form();
        $form->setAttrib('data-captcha', 'yes');
        foreach ($orderValues as $order) {
            /* @var $order integer */
            $inputElement = new Zend_Form_Element_Text('element_' . $order);
            $inputElement->setOrder($order);
            $form->addElement($inputElement);
        }
        $button = new Zend_Form_Element_Submit('element_' . $order);
        $button->setOrder($buttonOrder);
        $form->addElement($button);
        return $form;
    }
    
}
