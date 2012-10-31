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
        $this->assertEquals('"Hello World!"', Mol_Util_Stringifier::stringify('Hello World!'));
    }
    
    /**
     * Checks if stringify() transforms booleans correctly.
     */
    public function testStringifyTransformsBooleansCorrectly()
    {
        $this->assertEquals('true', Mol_Util_Stringifier::stringify(true));
        $this->assertEquals('false', Mol_Util_Stringifier::stringify(false));
    }
    
    /**
     * Checks if stringify() transforms null correctly.
     */
    public function testStringifyTransformsNullCorrectly()
    {
        $this->assertEquals('null', Mol_Util_Stringifier::stringify(null));
    }
    
    /**
     * Checks if stringify() transforms integers correctly.
     */
    public function testStringifyTransformsIntegersCorrectly()
    {
        $this->assertEquals('42', Mol_Util_Stringifier::stringify(42));
    }
    
    /**
     * Checks if stringify() transforms doubles correctly.
     */
    public function testStringifyTransformsDoublesCorrectly()
    {
        $this->assertEquals('42.42', Mol_Util_Stringifier::stringify(42.42));
    }
    
    /**
     * Ensures that stringify() transforms doubles without decimals
     * in such a way, that they are identified as doubles easily.
     * For example: 42.0
     */
    public function testStringifyTransformsDoublesWithoutDecimalsCorrectly()
    {
        $this->assertEquals('42.0', Mol_Util_Stringifier::stringify(42.0));
    }
    
    /**
     * Ensures that stringify() determines the class name of objects.
     */
    public function testStringifyTransformsObjectsCorrectly()
    {
        $this->assertEquals('stdClass', Mol_Util_Stringifier::stringify(new stdClass()));
    }
    
    /**
     * Checks if stringify() determines the type of provided resources.
     */
    public function testStringifyTransformsResourcesCorrectly()
    {
        $handle = fopen(__FILE__, 'r');
        $representation = Mol_Util_Stringifier::stringify($handle);
        fclose($handle);
        $this->assertEquals('file stream', $representation);
    }
    
    /**
     * Ensures that stringify() shows numerical arrays in "[]" brackets.
     */
    public function testStringifyTransformsNumericalArraysCorrectly()
    {
        $value = array(1, 2, 3);
        $representation = Mol_Util_Stringifier::stringify($value);
        $this->assertEquals('[1, 2, 3]', $representation);
    }
    
    /**
     * Ensures that stringify() shows numerical arrays in "{}" brackets.
     */
    public function testStringifyTransformsAssociativeArraysCorrectly()
    {
        $value = array('a' => 'b', 'c' => 'd');
        $representation = Mol_Util_Stringifier::stringify($value);
        $this->assertEquals('{"a": "b", "c": "d"}', $representation);
    }
    
    /**
     * Ensures that stringify() sets an associative array that contains
     * only numerical keys (not ascending in steps of one) into "{}" brackets.
     */
    public function testStringifyTransformsAssociativeArraysWithNumericalKeysCorrectly()
    {
        $value = array(5 => 42, 8 => 42);
        $representation = Mol_Util_Stringifier::stringify($value);
        $this->assertEquals('{5: 42, 8: 42}', $representation);
    }
    
    /**
     * Ensures that an empty array is rendered correctly.
     */
    public function testStringifyTransformsEmptyArrayCorrectly()
    {
        $value = array();
        $representation = Mol_Util_Stringifier::stringify($value);
        $this->assertEquals('[]', $representation);
    }
    
    /**
     * Checks if a closure is transformed correctly by stringify.
     */
    public function testStringifyTransformsClosuresCorrectly()
    {
        $closure = function () {
        };
        $representation = Mol_Util_Stringifier::stringify($closure);
        $this->assertEquals('Closure', $representation);
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
