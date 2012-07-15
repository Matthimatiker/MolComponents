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
    
    /**
     * Ensures that an exception is thrown if an invalid callback is passed
     * to the constructor.
     */
    public function testConstructorThrowsExceptionIfInvalidCallbackIsProvided()
    {
        
    }
    
    /**
     * Checks if the load() executes the callback.
     */
    public function testLoadExecutesCallback()
    {
        
    }
    
    /**
     * Ensures that the callback is executed only once, even if load() is
     * called multiple times.
     */
    public function testCallbackIsExecutedOnlyOnceEvenIfLoadIsCalledMultipleTimes()
    {
        
    }
    
    /**
     * Ensures that the callback is executed only once, even if it returns
     * null as result.
     */
    public function testCallbackIsExecutedOnlyOnceEvenIfCallbackReturnsNull()
    {
        
    }
    
    /**
     * Checks if load() returns the return value of the callback.
     */
    public function testLoadReturnsResultOfCallback()
    {
        
    }
    
    /**
     * Ensures that following calls to load() return the correct value.
     */
    public function testLoadReturnsCorrectResultOnFollowingCalls()
    {
        
    }
    
}
