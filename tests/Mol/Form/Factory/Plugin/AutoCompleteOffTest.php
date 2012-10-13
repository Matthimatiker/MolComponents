<?php

/**
 * Mol_Form_Factory_Plugin_AutoCompleteOffTest
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 13.10.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the AutoCompleteOff plugin.
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 13.10.2012
 */
class Mol_Form_Factory_Plugin_AutoCompleteOffTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Form_Factory_Plugin_AutoCompleteOff
     */
    protected $plugin = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->plugin = new Mol_Form_Factory_Plugin_AutoCompleteOff();
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
     * Checks if the plugin adds an autocomplete attribute to forms.
     */
    public function testPluginAddsAutocompleteAttribute()
    {
        $form = new Zend_Form();
        $this->plugin->enhance($form);
        $this->assertNotNull($form->getAttrib('autocomplete'));
    }
    
    /**
     * Ensures that the plugin sets the autocomplete attribute to "off".
     */
    public function testPluginSetAutocompleteAttributeToOff()
    {
        $form = new Zend_Form();
        $this->plugin->enhance($form);
        $this->assertEquals('off', $form->getAttrib('autocomplete'));
    }
    
    /**
     * Ensures that the plugin does not modify the autocomplete attribute if it
     * is already defined in the form.
     */
    public function testPluginDoesNotModifyAutocompleteAttributeIfItIsAlreadyDefinedInTheForm()
    {
        $form = new Zend_Form();
        $form->setAttrib('autocomplete', 'any-value');
        $this->plugin->enhance($form);
        $this->assertEquals('any-value', $form->getAttrib('autocomplete'));
    }
    
}
