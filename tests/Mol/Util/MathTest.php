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
    
    public function testSignThrowsExceptionIfNeitherIntegerNorDoubleIsProvided()
    {
        
    }
    
    public function testSignReturnsMinusOneIfProvidedIntegerIsLessThanZero()
    {
        
    }
    
    public function testSignReturnsZeroIfProvidedIntegerIsZero()
    {
        
    }
    
    public function testSignReturnsZeroIfProvidedIntegerIsGreaterThanZero()
    {
    
    }
    
    public function testSignReturnsMinusOneIfProvidedDoubleIsLessThanZero()
    {
    
    }
    
    public function testSignReturnsZeroIfProvidedDoubleIsZero()
    {
    
    }
    
    public function testSignReturnsZeroIfProvidedDoubleIsGreaterThanZero()
    {
    
    }
    
    public function testIsEvenThrowsExceptionIfNoIntegerIsProvided()
    {
        
    }
    
    public function testIsEvenReturnsTrueIfProvidedIntegerIsEven()
    {
        
    }
    
    public function testIsEvenReturnsFalseIfProvidedIntegerIsOdd()
    {
        
    }
    
    public function testIsOddThrowsExceptionIfNoIntegerIsProvided()
    {
    
    }
    
    public function testIsOddReturnsFalseIfProvidedIntegerIsEven()
    {
    
    }
    
    public function testIsOddReturnsTrueIfProvidedIntegerIsOdd()
    {
    
    }
    
}
