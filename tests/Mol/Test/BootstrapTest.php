<?php

/**
 * Mol_Test_BootstrapTest
 *
 * @category PHP
 * @package Mol_Test
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 06.07.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the bootstrapper that is used for testing.
 *
 * @category PHP
 * @package Mol_Test
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 06.07.2012
 */
class Mol_Test_BootstrapTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Ensures that create() returns always new bootstrapper instances.
     */
    public function testCreateReturnsNewBootstrapperOnEachCall()
    {
        
    }
    
    /**
     * Checks if the bootstrapper implements the bootstrapper interface.
     */
    public function testBootrapperImplementsBootstrapperInterface()
    {
        
    }
    
    /**
     * Checks if simulateResource() provides a fluent interface.
     */
    public function testSimulateResourceProvidesFluentInterface()
    {
        
    }
    
    /**
     * Ensures that getResource() returns simulated resources.
     */
    public function testGetResourceReturnsSimulatedResource()
    {
    
    }
    
    /**
     * Ensures that a resource is overwritten if simlateResource() is called again.
     */
    public function testSimulateResourceOverwritesPreviousResourceWithSameName()
    {
        
    }
    
    /**
     * Ensures that multiple bootstrapper instances do not share their resources.
     */
    public function testBootstrappersDoNotShareResources()
    {
    
    }
    
    /**
     * Ensures that bootstrap() does not throw an exception if the provided
     * resource was simulated.
     */
    public function testBootstrapDoesNotThrowExceptionIfResourceWasSimulated()
    {
        
    }
    
    /**
     * Ensures that bootstrap() throws an exception if the provided resource
     * was not simulated.
     */
    public function testBootstrapThrowsExceptionIfResourceWasNotSimulated()
    {
        
    }
    
}
