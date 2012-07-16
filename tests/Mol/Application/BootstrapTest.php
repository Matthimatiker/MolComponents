<?php

/**
 * Mol_Application_BootstrapTest
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 15.07.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the bootstrapper with lazy loading support.
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 15.07.2012
 */
class Mol_Application_BootstrapTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Short name of the resource that is used for testing.
     *
     * @var string
     */
    const RESOURCE_NAME = 'lazy';
    
    /**
     * System under test.
     *
     * @var Mol_Application_Bootstrap
     */
    protected $bootstrapper = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->bootstrapper = new Mol_Application_Bootstrap(Mol_Test_Bootstrap::create());
        $this->bootstrapper->setPluginLoader($this->createPluginLoader());
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->bootstrapper = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that the lazyLoad option is not passed to resource plugins.
     */
    public function testBootstrapperDoesNotPassLazyLoadOptionToResource()
    {
        $options = $this->createOptions(array('lazyLoad' => false));
        $this->bootstrapper->setOptions($options);
        
        $this->bootstrapper->bootstrap(self::RESOURCE_NAME);
        
        $resource = $this->bootstrapper->getResource(self::RESOURCE_NAME);
        $this->assertInstanceOf('Mol_Application_Bootstrap_TestData_LazyResource', $resource);
        $resourceOptions = $resource->getOptions();
        $this->assertArrayNotHasKey('lazyLoad', $resourceOptions);
    }
    
    /**
     * Ensures that lazy loading is not applied if the lazyLoad option is not provided.
     */
    public function testBootstrapperDoesNotApplyLazyLoadingIfLazyLoadOptionIsNotProvided()
    {
        $options = $this->createOptions(array());
        $this->bootstrapper->setOptions($options);
        
        $this->bootstrapper->bootstrap(self::RESOURCE_NAME);
        
        $this->assertNotLazyLoaded();
    }
    
    /**
     * Ensures that lazy loading is not applied if the lazyLoad option evaluates to false.
     */
    public function testBootstrapperDoesNotApplyLazyLoadingIfLazyLoadOptionIsFalse()
    {
        $options = $this->createOptions(array('lazyLoad' => false));
        $this->bootstrapper->setOptions($options);
        
        $this->bootstrapper->bootstrap(self::RESOURCE_NAME);
        
        $this->assertNotLazyLoaded();
    }
    
    /**
     * Ensures that lazy loading is applied if the lazyLoad option is true.
     */
    public function testBootstrapperAppliesLazyLoadingIfLazyLoadOptionIsTrue()
    {
        $options = $this->createOptions(array('lazyLoad' => true));
        $this->bootstrapper->setOptions($options);
        
        $this->bootstrapper->bootstrap(self::RESOURCE_NAME);
        
        $this->assertLazyLoaded();
    }
    
    /**
     * Ensures that getResource() returns the correct value if the resource
     * was bootstrapped without lazy loading.
     */
    public function testGetResourceReturnsCorrectValueIfResourceWasNotLazyLoaded()
    {
        $result  = new stdClass();
        $options = $this->createOptions(array('lazyLoad' => false, 'return' => $result));
        $this->bootstrapper->setOptions($options);
        
        $this->bootstrapper->bootstrap(self::RESOURCE_NAME);
        $this->assertSame($result, $this->bootstrapper->getResource(self::RESOURCE_NAME));
    }
    
    /**
     * Ensures that getResource() returns the correct value if the resource is
     * lazy loaded.
     */
    public function testGetResourceReturnsCorrectValueIfResourceIsLazyLoaded()
    {
        $result  = new stdClass();
        $options = $this->createOptions(array('lazyLoad' => true, 'return' => $result));
        $this->bootstrapper->setOptions($options);
        
        $this->bootstrapper->bootstrap(self::RESOURCE_NAME);
        $this->assertSame($result, $this->bootstrapper->getResource(self::RESOURCE_NAME));
    }
    
    /**
     * Ensures that hasResource() returns true if the resource was bootstrapped
     * and not lazy loaded.
     */
    public function testHasResourceReturnsTrueIfResourceWasNotLazyLoaded()
    {
        $options = $this->createOptions(array('lazyLoad' => false));
        $this->bootstrapper->setOptions($options);
        
        $this->bootstrapper->bootstrap(self::RESOURCE_NAME);
        
        $this->assertTrue($this->bootstrapper->hasResource(self::RESOURCE_NAME));
    }
    
    /**
     * Ensures that hasResource() returns true if the resource was bootstrapped
     * and is lazy loaded.
     */
    public function testHasResourceReturnsTrueIfResourceWasLazyLoaded()
    {
        $options = $this->createOptions(array('lazyLoad' => true));
        $this->bootstrapper->setOptions($options);
        
        $this->bootstrapper->bootstrap(self::RESOURCE_NAME);
        
        $this->assertTrue($this->bootstrapper->hasResource(self::RESOURCE_NAME));
    }
    
    /**
     * Ensures that hasResource() returns false if the resource is configured,
     * but was not bootstrapped yet.
     */
    public function testHasResourceReturnsFalseIfResourceWasNotLoadedYet()
    {
        $options = $this->createOptions(array('lazyLoad' => false));
        $this->bootstrapper->setOptions($options);
        
        $this->assertFalse($this->bootstrapper->hasResource(self::RESOURCE_NAME));
    }
    
    /**
     * Ensures that an exception is thrown if the configured resource was not found by
     * the plugin loader.
     */
    public function testBootstrapperThrowsExceptionIfConfiguredResourceWasNotFoundByThePluginLoader()
    {
        $this->setExpectedException('Zend_Application_Bootstrap_Exception');
        
        $options = array(
            'resources' => array(
                'missing' => array()
            )
        );
        $this->bootstrapper->setOptions($options);
        
        $this->bootstrapper->bootstrap('missing');
    }
    
    /**
     * Ensures that an exception is thrown if the requested resource is not configured.
     */
    public function testBootstrapperThrowsExceptionIfResourceWasNotConfigured()
    {
        $this->setExpectedException('Zend_Application_Bootstrap_Exception');
        
        $options = array();
        $this->bootstrapper->setOptions($options);
        
        $this->bootstrapper->bootstrap(self::RESOURCE_NAME);
    }
    
    /**
     * Asserts that the test resource was lazy loaded.
     */
    protected function assertLazyLoaded()
    {
        $this->assertInContainer();
        $result = $this->bootstrapper->getContainer()->{self::RESOURCE_NAME};
        $this->assertInstanceOf('Mol_Application_Bootstrap_LazyLoader', $result);
    }
    
    /**
     * Asserts that the test resource was not lazy loaded.
     */
    protected function assertNotLazyLoaded()
    {
        $this->assertInContainer();
        $result = $this->bootstrapper->getContainer()->{self::RESOURCE_NAME};
        $this->assertNotInstanceOf('Mol_Application_Bootstrap_LazyLoader', $result);
    }
    
    /**
     * Asserts that the container contains the result of the test resource.
     */
    protected function assertInContainer()
    {
        $container = $this->bootstrapper->getContainer();
        $message   = 'Container does not contain result of ' . self::RESOURCE_NAME . ' resource.';
        $this->assertTrue(isset($container->{self::RESOURCE_NAME}), $message);
    }
    
    /**
     * Creates options that can be consumed by the bootstrapper.
     *
     * Uses the provided options for the simulated lazy resource.
     *
     * @param array(string=>mixed) $resourceOptions
     * @return array(string=>array(string=>mixed))
     */
    protected function createOptions($resourceOptions)
    {
        $options = array(
            'resources' => array(
                self::RESOURCE_NAME => $resourceOptions
            )
        );
        return $options;
    }
    
    /**
     * Creates a mocked plugin loader.
     *
     * The plugin loader simulates the loading of the resource named "lazy".
     *
     * @return Zend_Loader_PluginLoader_Interface
     */
    protected function createPluginLoader()
    {
        $mock = $this->getMock('Zend_Loader_PluginLoader_Interface');
        $mock->expects($this->any())
             ->method('load')
             ->will($this->returnCallback(array($this, 'getClassFor')));
        return $mock;
    }
    
    /**
     * Returns the class name for the resource with the provided short name.
     *
     * Is used as callback that simulates the load() method of the plugin loader.
     *
     * @param string $resource The short resource name.
     * @return string The class name.
     */
    public function getClassFor($resource)
    {
        if ($resource !== self::RESOURCE_NAME) {
            // Simulate a resource that was not found.
            return false;
        }
        // Ensure that the mock resource class is loaded.
        require_once(dirname(__FILE__) . '/TestData/LazyResource.php');
        return 'Mol_Application_Bootstrap_TestData_LazyResource';
    }
    
}
