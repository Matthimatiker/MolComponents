<?php

/**
 * Mol_Util_MathTest
 *
 * @category PHP
 * @package Mol_Util
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 22.06.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the mathematical functions.
 *
 * @category PHP
 * @package Mol_Util
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 22.06.2012
 */
class Mol_Util_MathTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Ensures that sign() throws an exception if neither an integer nor
     * a double is provided as argument.
     */
    public function testSignThrowsExceptionIfNeitherIntegerNorDoubleIsProvided()
    {
        
    }
    
    /**
     * Ensures that sign() returns -1 if a negative integer is provided.
     */
    public function testSignReturnsMinusOneIfProvidedIntegerIsLessThanZero()
    {
        
    }
    
    /**
     * Ensures that sign() returns 0 if the provided integer equals 0.
     */
    public function testSignReturnsZeroIfProvidedIntegerIsZero()
    {
        
    }
    
    /**
     * Ensures that sign returns 1 if a positive integer is provided.
     */
    public function testSignReturnsZeroIfProvidedIntegerIsGreaterThanZero()
    {
    
    }
    
    /**
     * Ensures that sign() returns -1 if a negative double is provided.
     */
    public function testSignReturnsMinusOneIfProvidedDoubleIsLessThanZero()
    {
    
    }
    
    /**
     * Ensures that sign() returns 0 if the provided integer equals 0.0.
     */
    public function testSignReturnsZeroIfProvidedDoubleIsZero()
    {
    
    }
    
    /**
     * Ensures that sign returns 1 if a positive double is provided.
     */
    public function testSignReturnsZeroIfProvidedDoubleIsGreaterThanZero()
    {
    
    }
    
    /**
     * Ensures that isEven() throws an exception if no integer is provided.
     */
    public function testIsEvenThrowsExceptionIfNoIntegerIsProvided()
    {
        
    }
    
    /**
     * Checks if isEven() accepts even integers.
     */
    public function testIsEvenReturnsTrueIfProvidedIntegerIsEven()
    {
        
    }
    
    /**
     * Checks if isEven() rejects odd integers.
     */
    public function testIsEvenReturnsFalseIfProvidedIntegerIsOdd()
    {
        
    }
    
    /**
     * Ensures that isOdd() throws an exception if no integer is provided.
     */
    public function testIsOddThrowsExceptionIfNoIntegerIsProvided()
    {
    
    }
    
    /**
     * Checks if isOdd() rejects even integers.
     */
    public function testIsOddReturnsFalseIfProvidedIntegerIsEven()
    {
    
    }
    
    /**
     * Checks if isOdd() accepts odd integers.
     */
    public function testIsOddReturnsTrueIfProvidedIntegerIsOdd()
    {
    
    }
    
}
