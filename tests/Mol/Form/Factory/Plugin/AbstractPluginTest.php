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
class Mol_Form_Factory_Plugin_AbstractPluginTest extends PHPUnit_Framework_TestCase
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
        $this->bootstrapper = $this->createBootstrapper();
        $this->plugin       = $this->createPlugin();
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
        $this->assertInstanceOf('Mol_Application_Bootstrap_Aware', $this->plugin);
    }
    
    /**
     * Checks if the abstract plugin implements the form factory
     * plugin interface.
     */
    public function testImplementsPluginInterface()
    {
        $this->assertInstanceOf('Mol_Form_Factory_Plugin', $this->plugin);
    }
    
    /**
     * Ensures that getBootstrap() throws an exception if the bootstrapper was
     * not injected before.
     */
    public function testGetBootstrapThrowsExceptionIfBootstrapperIsNotAvailable()
    {
        $this->setExpectedException('RuntimeException');
        $this->plugin->execute('getBootstrap');
    }
    
    /**
     * Checks if getBootstrap() returns the injected bootstrapper.
     */
    public function testGetBootstrapReturnsInjectedBootstrapper()
    {
        $this->injectBootstrapper();
        $this->assertSame($this->bootstrapper, $this->plugin->execute('getBootstrap'));
    }

    /**
     * Ensures that getResource() throws an exception if the requested resource
     * does not exist.
     */
    public function testGetResourceThrowsExceptionIfResourceDoesNotExist()
    {
        $this->injectBootstrapper();
        
        $this->setExpectedException('Zend_Application_Bootstrap_Exception');
        $this->plugin->execute('getResource', array('missingResource'));
    }
    
    /**
     * Checks if getResource() returns the bootstrapped resource.
     */
    public function testGetResourceReturnsBootstrappedResource()
    {
        $this->injectBootstrapper();
        $resource = $this->plugin->execute('getResource', array('objectResource'));
        $this->assertSame($this->bootstrapper->getResource('objectResource'), $resource);
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
        $this->injectBootstrapper();
        $this->assertNull($this->plugin->execute('getResource', array('nullResource')));
    }
    
    /**
     * Checks if the plugin stores the options that are passed to the constructor.
     */
    public function testPluginStoresPassedOptions()
    {
        $expected = array(
            'a' => 'b',
            'c' => 'd',
            'e' => null
        );
        $this->assertEquals($expected, $this->plugin->getOptions());
    }
    
    /**
     * Checks if getOption() returns the value of the requested option.
     */
    public function testGetOptionReturnsRequestedOption()
    {
        $this->assertEquals('b', $this->plugin->execute('getOption', array('a')));
    }
    
    /**
     * Ensures that getOption() returns the provided default value if
     * the option does not exist.
     */
    public function testGetOptionReturnsDefaultValueIfOptionDoesNotExist()
    {
        $this->assertEquals('x', $this->plugin->execute('getOption', array('y', 'x')));
    }
    
    /**
     * Ensures that getOption() returns the option value and not the default
     * value if the option exists and its value is null.
     */
    public function testGetOptionReturnsCorrectValueIfOptionIsNull()
    {
        $this->assertNull($this->plugin->execute('getOption', array('e', 'x')));
    }
    
    /**
     * Creates a plugin instance that can be used for testing.
     *
     * @return Mol_Form_Factory_Plugin_TestData_Base
     */
    protected function createPlugin()
    {
        $options = array(
            'a' => 'b',
            'c' => 'd',
            'e' => null
        );
        return $this->getMockForAbstractClass('Mol_Form_Factory_Plugin_TestData_Base', array($options));
    }
    
    /**
     * Creates a bootstrapper and simulates some resources for testing.
     *
     * @return Mol_Test_Bootstrap
     */
    protected function createBootstrapper()
    {
        $bootstrapper = Mol_Test_Bootstrap::create();
        $bootstrapper->simulateResource('nullResource', null);
        $bootstrapper->simulateResource('objectResource', new stdClass());
        return $bootstrapper;
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
