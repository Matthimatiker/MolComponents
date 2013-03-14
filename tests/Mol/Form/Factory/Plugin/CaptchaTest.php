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
        $this->plugin = new Mol_Form_Factory_Plugin_Captcha();
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
        
        $elements = $form->getElementsAndSubFormsOrdered();
        // Last element should be the button, therefore remove it first.
        array_pop($elements);
        $captcha = array_pop($elements);
        $this->assertInstanceOf('Zend_Form_Element_Captcha', $captcha);
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
        
        $elements = $form->getElementsAndSubFormsOrdered();
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
    
}
