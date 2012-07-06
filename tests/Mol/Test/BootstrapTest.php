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
    
    public function testCreateReturnsNewBootstrapperOnEachCall()
    {
        
    }
    
    public function testBootrapperImplementsBootstrapperInterface()
    {
        
    }
    
    public function testSimulateResourceProvidesFluentInterface()
    {
        
    }
    
    public function testGetResourceReturnsSimulatedResource()
    {
    
    }
    
    public function testSimulateResourceOverwritesPreviousResourceWithSameName()
    {
        
    }
    
    public function testBootstrapDoesNotThrowExceptionIfResourceWasSimulated()
    {
        
    }
    
    public function testBootstrappersDoNotShareResources()
    {
        
    }
    
    public function testBootstrapThrowsExceptionIfResourceWasNotSimulated()
    {
        
    }
    
}
