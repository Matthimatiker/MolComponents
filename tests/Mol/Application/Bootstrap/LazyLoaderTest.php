<?php

/**
 * Mol_Application_Bootstrap_LazyLoaderTest
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
 * Tests the lazy loader.
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
class Mol_Application_Bootstrap_LazyLoaderTest extends PHPUnit_Framework_TestCase
{
    
    public function testConstructorThrowsExceptionIfInvalidCallbackIsProvided()
    {
        
    }
    
    public function testLoadExecutesCallback()
    {
        
    }
    
    public function testCallbackIsExecutedOnlyOnceEvenIfLoadIsCalledMultipleTimes()
    {
        
    }
    
    public function testLoadReturnsResultOfCallback()
    {
        
    }
    
    public function testLoadReturnsCorrectResultOnFollowingCalls()
    {
        
    }
    
}
