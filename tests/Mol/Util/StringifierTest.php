<?php

/**
 * Mol_Util_StringifierTest
 *
 * @category PHP
 * @package Mol_Util
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 31.10.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the stringifier.
 *
 * @category PHP
 * @package Mol_Util
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 31.10.2012
 */
class Mol_Util_StringifierTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Checks if stringify() adds quotes to strings.
     */
    public function testStringifyTransformsStringsCorrectly()
    {
        
    }
    
    /**
     * Checks if stringify() transforms booleans correctly.
     */
    public function testStringifyTransformsBooleansCorrectly()
    {
    
    }
    
    /**
     * Checks if stringify() transforms null correctly.
     */
    public function testStringifyTransformsNullCorrectly()
    {
    
    }
    
    /**
     * Checks if stringify() transforms integers correctly.
     */
    public function testStringifyTransformsIntegersCorrectly()
    {
    
    }
    
    /**
     * Checks if stringify() transforms doubles correctly.
     */
    public function testStringifyTransformsDoublesCorrectly()
    {
    
    }
    
    /**
     * Ensures that stringify() determines the class name of objects.
     */
    public function testStringifyTransformsObjectsCorrectly()
    {
    
    }
    
    /**
     * Checks if stringify() determines the type of provided resources.
     */
    public function testStringifyTransformsResourcesCorrectly()
    {
    
    }
    
    /**
     * Ensures that stringify() shows numerical arrays in "[]" brackets.
     */
    public function testStringifyTransformsNumericalArraysCorrectly()
    {
        
    }
    
    /**
     * Ensures that stringify() shows numerical arrays in "{}" brackets.
     */
    public function testStringifyTransformsAssociativeArraysCorrectly()
    {
    
    }
    
    /**
     * Ensures that stringify() sets an associative array that contains
     * only numerical keys (not ascending in steps of one) into "{}" brackets.
     */
    public function testStringifyTransformsAssociativeArraysWithNumericalKeysCorrectly()
    {
    
    }
    
    /**
     * Checks if a closure is transformed correctly by stringify.
     */
    public function testStringifyTransformsClosuresCorrectly()
    {
    
    }
    
    /**
     * Checks if stringifyException() returns a representation that
     * contains the class name of the given exception.
     */
    public function testStringifyExceptionShowsNameOfExceptionClass()
    {
        
    }
    
    /**
     * Checks if stringifyException() returns a representation that
     * contains the message of the given exception.
     */
    public function testStringifyExceptionShowsMessage()
    {
    
    }
    
    /**
     * Checks if stringifyException() returns a representation that
     * contains the code of the given exception.
     */
    public function testStringifyExceptionShowsCode()
    {
    
    }
    
    /**
     * Checks if stringifyException() returns a representation that
     * contains thestack trace of the given exception.
     */
    public function testStringifyExceptionShowsStacktrace()
    {
    
    }
    
    /**
     * Ensures that stringifyException() renders the inner exception
     * of the given exception object.
     */
    public function testStringifyExceptionShowsInnerException()
    {
    
    }
    
    /**
     * Ensures that stringifyException() renders the inner exception
     * of the inner exception object.
     */
    public function testStringifyExceptionShowsInnerExceptionAtLevelTwo()
    {
    
    }
    
    /**
     * Ensures that stringifyException() indents the first inner exception
     * correctly. Indention is indicated via ">".
     */
    public function testStringifyExceptionIndentsFirstInnerException()
    {
        
    }
    
    /**
     * Ensures that stringifyException() indents the second inner exception
     * correctly. Indention is indicated via ">>".
     */
    public function testStringifyExceptionIndentsSecondInnerException()
    {
    
    }
    
}
