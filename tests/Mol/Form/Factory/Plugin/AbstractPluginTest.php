<?php

/**
 * Mol_Form_Factory_AbstractPluginTest
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 04.03.2013
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Load implementation of the abstract plugin that is used for testing.
 */
require_once(dirname(__FILE__) . '/TestData/Base.php');

/**
 * Tests the abstract base class for form factory plugins.
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 04.03.2013
 */
class Mol_Form_Factory_AbstractPluginTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Form_Factory_Plugin_TestData_Base
     */
    protected $plugin = null;
    
    /**
     * The bootstrapper that is used for testing.
     *
     * @var Mol_Test_Bootstrap
     */
    protected $bootstrapper = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->bootstrapper = Mol_Test_Bootstrap::create();
        $this->plugin       = new Mol_Form_Factory_Plugin_TestData_Base();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->plugin       = null;
        $this->bootstrapper = null;
        parent::tearDown();
    }
    
    /**
     * Checks if the plugin is bootstrap aware.
     */
    public function testPluginIsBootstrapAware()
    {
        
    }
    
    /**
     * Checks if the abstract plugin implements the form factory
     * plugin interface.
     */
    public function testImplementsPluginInterface()
    {
        
    }
    
    /**
     * Ensures that getBootstrap() throws an exception if the bootstrapper was
     * not injected before.
     */
    public function testGetBootstrapThrowsExceptionIfBootstrapperIsNotAvailable()
    {
        
    }
    
    /**
     * Checks if getBootstrap() returns the injected bootstrapper.
     */
    public function testGetBootstrapReturnsInjectedBootstrapper()
    {
        
    }

    /**
     * Ensures that getResource() throws an exception if the requested resource
     * does not exist.
     */
    public function testGetResourceThrowsExceptionIfResourceDoesNotExist()
    {
        
    }
    
    /**
     * Checks if getResource() returns the bootstrapped resource.
     */
    public function testGetResourceReturnsBootstrappedResource()
    {
        
    }
    
    /**
     * Ensures that getResource() returns null if the requested resource was bootstrapped,
     * but did not provide any return value.
     *
     * This test guarantees that the return value of a resource is not used to determine
     * if the resource was bootstrapped..
     */
    public function testGetResourceReturnsNullIfResourceWasBootstrappedButNoValueIsProvided()
    {
        
    }
    
    /**
     * Injects the bootstrapper into the plugin if possible.
     */
    protected function injectBootstrapper()
    {
        $injector = new Mol_Application_Bootstrap_Injector($this->bootstrapper);
        $injector->inject($this->plugin);
    }
    
}
