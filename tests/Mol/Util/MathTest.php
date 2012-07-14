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
 * @link https://github.com/Matthimatiker/MolComponents
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
 * @link https://github.com/Matthimatiker/MolComponents
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
        $this->setExpectedException('InvalidArgumentException');
        Mol_Util_Math::sign('this is not numeric');
    }
    
    /**
     * Ensures that sign() returns -1 if a negative integer is provided.
     */
    public function testSignReturnsMinusOneIfProvidedIntegerIsLessThanZero()
    {
        $this->assertEquals(-1, Mol_Util_Math::sign(-42));
    }
    
    /**
     * Ensures that sign() returns 0 if the provided integer equals 0.
     */
    public function testSignReturnsZeroIfProvidedIntegerIsZero()
    {
        $this->assertEquals(0, Mol_Util_Math::sign(0));
    }
    
    /**
     * Ensures that sign returns 1 if a positive integer is provided.
     */
    public function testSignReturnsZeroIfProvidedIntegerIsGreaterThanZero()
    {
        $this->assertEquals(1, Mol_Util_Math::sign(42));
    }
    
    /**
     * Ensures that sign() returns -1 if a negative double is provided.
     */
    public function testSignReturnsMinusOneIfProvidedDoubleIsLessThanZero()
    {
        $this->assertEquals(-1, Mol_Util_Math::sign(-7.5));
    }
    
    /**
     * Ensures that sign() returns 0 if the provided integer equals 0.0.
     */
    public function testSignReturnsZeroIfProvidedDoubleIsZero()
    {
        $this->assertEquals(0, Mol_Util_Math::sign(0.0));
    }
    
    /**
     * Ensures that sign returns 1 if a positive double is provided.
     */
    public function testSignReturnsZeroIfProvidedDoubleIsGreaterThanZero()
    {
        $this->assertEquals(1, Mol_Util_Math::sign(7.5));
    }
    
    /**
     * Ensures that isEven() throws an exception if no integer is provided.
     */
    public function testIsEvenThrowsExceptionIfNoIntegerIsProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        Mol_Util_Math::isEven(4.2);
    }
    
    /**
     * Checks if isEven() accepts even integers.
     */
    public function testIsEvenReturnsTrueIfProvidedIntegerIsEven()
    {
        $this->assertTrue(Mol_Util_Math::isEven(2));
    }
    
    /**
     * Checks if isEven() rejects odd integers.
     */
    public function testIsEvenReturnsFalseIfProvidedIntegerIsOdd()
    {
        $this->assertFalse(Mol_Util_Math::isEven(5));
    }
    
    /**
     * Ensures that isOdd() throws an exception if no integer is provided.
     */
    public function testIsOddThrowsExceptionIfNoIntegerIsProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        Mol_Util_Math::isOdd(4.2);
    }
    
    /**
     * Checks if isOdd() rejects even integers.
     */
    public function testIsOddReturnsFalseIfProvidedIntegerIsEven()
    {
        $this->assertFalse(Mol_Util_Math::isOdd(6));
    }
    
    /**
     * Checks if isOdd() accepts odd integers.
     */
    public function testIsOddReturnsTrueIfProvidedIntegerIsOdd()
    {
        $this->assertTrue(Mol_Util_Math::isOdd(7));
    }
    
}
