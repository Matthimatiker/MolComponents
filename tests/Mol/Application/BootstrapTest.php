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
        $options = array(
            'resources' => array(
                'lazy' => array(
                    'lazyLoad' => false
                )
            )
        );
        $this->bootstrapper->setOptions($options);
        $this->bootstrapper->bootstrap('lazy');
        $resource = $this->bootstrapper->getResource('lazy');
        $this->assertInstanceOf('Mol_Application_Bootstrap_TestData_LazyResource', $resource);
        $resourceOptions = $resource->getOptions();
        $this->assertArrayNotHasKey('lazyLoad', $resourceOptions);
    }
    
    /**
     * Ensures that lazy loading is not applied if the lazyLoad option is not provided.
     */
    public function testBootstrapperDoesNotApplyLazyLoadingIfLazyLoadOptionIsNotProvided()
    {
        
    }
    
    /**
     * Ensures that lazy loading is not applied if the lazyLoad option evaluates to false.
     */
    public function testBootstrapperDoesNotApplyLazyLoadingIfLazyLoadOptionIsFalse()
    {
        
    }
    
    /**
     * Ensures that lazy loading is applied if the lazyLoad option is true.
     */
    public function testBootstrapperAppliesLazyLoadingIfLazyLoadOptionIsTrue()
    {
        
    }
    
    /**
     * Ensures that getResource() returns the correct value if the resource
     * was bootstrapped without lazy loading.
     */
    public function testGetResourceReturnsCorrectValueIfResourceWasNotLazyLoaded()
    {
        
    }
    
    /**
     * Ensures that getResource() returns the correct value if the resource is
     * lazy loaded.
     */
    public function testGetResourceReturnsCorrectValueIfResourceIsLazyLoaded()
    {
        
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
        if ($resource !== 'lazy') {
            // Simulate a resource that was not found.
            return false;
        }
        // Ensure that the mock resource class is loaded.
        require_once(dirname(__FILE__) . '/TestData/LazyResource.php');
        return 'Mol_Application_Bootstrap_TestData_LazyResource';
    }
    
}
