<?php

/**
 * Mol_Application_Bootstrap_LazyLoad_ResourceDecoratorTest
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
 * Tests the application resource decorator.
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
class Mol_Application_Bootstrap_LazyLoad_ResourceDecoratorTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Ensures that the constructor throws an exception if no resource is provided.
     */
    public function testConstructorThrowsExceptionIfNoResourceIsProvided()
    {
        
    }
    
    /**
     * Checks if setBootstrap() provides a fluent interface.
     */
    public function testSetBootstrapProvidesFluentInterface()
    {
        
    }
    
    /**
     * Checks if setBootstrap() passes the bootstrapper to the inner resource.
     */
    public function testSetBootstrapPassesBootstrapperToInnerResource()
    {
        
    }
    
    /**
     * Checks if getBootstrap() returns teh bootstrapper from the inner resource.
     */
    public function testGetBootstrapReturnsBootstrapperFromInnerResource()
    {
        
    }
    
    /**
     * Checks if setOptions() provides a fluent interface.
     */
    public function testSetOptionsProvidesFluentInterface()
    {
        
    }
    
    /**
     * Ensures that setOptions() passes the options to the inner resource.
     */
    public function testSetOptionsPassesOptionsToInnerResource()
    {
        
    }
    
    /**
     * Checks if getOptions() returns the options from the inner resource.
     */
    public function testGetOptionsReturnsOptionsFromInnerResource()
    {
        
    }
    
    /**
     * Checks if init() returns a lazy loader.
     */
    public function testInitReturnsLazyLoader()
    {
        
    }
    
    /**
     * Ensures that init() creates a new lazy loader on each call.
     */
    public function testInitCreateNewLazyLoaderOnEachCall()
    {
        
    }
    
    /**
     * Ensures that the lazy loader that is returned by init() calls the init()
     * method of the inner resource.
     */
    public function testInitReturnsLazyLoaderThatInitializesTheInnerResource()
    {
        
    }
    
}
