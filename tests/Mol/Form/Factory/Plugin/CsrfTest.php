<?php

/**
 * Mol_Form_Factory_Plugin_Csrf
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 08.10.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the CSRF plugin.
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 08.10.2012
 */
class Mol_Form_Factory_Plugin_CsrfTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Form_Factory_Plugin_Csrf
     */
    protected $plugin = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $options = array(
            'element' => array(
                'name'    => 'my_csrf_token',
                'salt'    => 'csrf-salt',
                'session' => $this->createSession()
            )
        );
        $this->plugin = new Mol_Form_Factory_Plugin_Csrf($options);
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
     * Ensures that the plugin adds a CSRF element to the given form.
     */
    public function testPluginAddsElementToForm()
    {
        $form = new Zend_Form();
        $this->plugin->enhance($form);
        $elements = $form->getElements();
        $this->assertEquals(1, count($elements));
        $this->assertContainsOnly('Zend_Form_Element_Hash', $elements);
    }
    
    /**
     * Ensures that the plugin creates a new CSRF element for each
     * form that is passed.
     */
    public function testPluginCreatesNewElementForEachForm()
    {
        $form = new Zend_Form();
        $this->plugin->enhance($form);
        $elements = $form->getElements();
        $first    = current($elements);
        
        $form = new Zend_Form();
        $this->plugin->enhance($form);
        $elements = $form->getElements();
        $second   = current($elements);
        
        $this->assertNotSame($first, $second);
    }
    
    /**
     * Ensures that the plugin does not add an element if the form already
     * contains a CSRF element.
     */
    public function testPluginDoesNotAddElementIfFormAlreadyContainsCsrfToken()
    {
        $csrf = new Zend_Form_Element_Hash('another_token', array('session' => $this->createSession()));
        $form = new Zend_Form();
        $form->addElement($csrf);
        $this->plugin->enhance($form);
        $elements = $form->getElements();
        $this->assertEquals(1, count($elements));
    }
    
    /**
     * Ensures that the plugin does not add a CSRF element if the form already contains
     * an element with the same name as configured for the CSRF element.
     */
    public function testPluginDoesNotAddElementIfFormAlreadyContainsElementWithSameName()
    {
        $form = new Zend_Form();
        $form->addElement(new Zend_Form_Element_Text('my_csrf_token'));
        $this->plugin->enhance($form);
        $this->assertInstanceOf('Zend_Form_Element_Text', $form->getElement('my_csrf_token'));
    }
    
    /**
     * Checks if the plugin passes the provided element
     * options to the created CSRF element.
     */
    public function testPluginPassesOptionsToElement()
    {
        $form = new Zend_Form();
        $this->plugin->enhance($form);
        $elements = $form->getElements();
        /* @var $csrf Zend_Form_Element_Hash */
        $csrf = current($elements);
        $this->assertInstanceOf('Zend_Form_Element_Hash', $csrf);
        $this->assertEquals('csrf-salt', $csrf->getSalt());
    }
    
    /**
     * Checks if the form uses the configured name for the CSRF element.
     */
    public function testPluginUsesConfiguredElementName()
    {
        $form = new Zend_Form();
        $this->plugin->enhance($form);
        $this->assertNotNull($form->getElement('my_csrf_token'));
    }
    
    /**
     * Ensures that the plugin uses the default name if the element
     * name is not specified in the options.
     */
    public function testPluginUsesDefaultNameIfConfigurationIsMissing()
    {
        $options = array(
            'element' => array(
                'session' => $this->createSession()
            )
        );
        $this->plugin = new Mol_Form_Factory_Plugin_Csrf($options);
        $form = new Zend_Form();
        $this->plugin->enhance($form);
        $this->assertNotNull($form->getElement(Mol_Form_Factory_Plugin_Csrf::DEFAULT_TOKEN_NAME));
    }
    
    /**
     * Checks if the plugin can be created without element options.
     */
    public function testPluginCanBeCreatedWithoutElementOptions()
    {
        $this->setExpectedException(null);
        new Mol_Form_Factory_Plugin_Csrf(array());
    }
    
    /**
     * Ensures that the plugin accepts the token name as element option.
     */
    public function testPluginAcceptsNameAsElementOption()
    {
        $this->setExpectedException(null);
        new Mol_Form_Factory_Plugin_Csrf(array('element' => 'my_csrf_token'));
    }
    
    /**
     * Creates a mocked session object.
     *
     * @return stdClass
     */
    protected function createSession()
    {
        $methods = array(
            'setExpirationHops',
            'setExpirationSeconds'
        );
        return $this->getMock('stdClass', $methods);
    }
    
}