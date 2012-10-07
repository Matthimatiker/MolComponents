<?php

/**
 * Mol_Form_Factory_Plugin_CSRF
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
class Mol_Form_Factory_Plugin_CSRFTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Form_Factory_Plugin_CSRF
     */
    protected $plugin = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->plugin = null;
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
     * Checks if the plugin passes the provided element
     * options to the created CSRF element.
     */
    public function testPluginPassesOptionsToElement()
    {
        
    }
    
    /**
     * Ensures that the plugin adds a CSRF element to the given form.
     */
    public function testPluginAddsElementToForm()
    {
        
    }
    
    /**
     * Ensures that the plugin creates a new CSRF element for each
     * form that is passed.
     */
    public function testPluginCreatesNewElementForEachForm()
    {
        
    }
    
    /**
     * Ensures that the plugin does not add an element if the form already
     * contains a CSRF element.
     */
    public function testPluginDoesNotAddElementIfFormAlreadyContainsCsrfToken()
    {
        
    }
    
    /**
     * Checks if the form uses the configured name for the CSRF element.
     */
    public function testPluginUsesConfiguredElementName()
    {
        
    }
    
}