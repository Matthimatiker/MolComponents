<?php

/**
 * Mol_Util_TypeInspectorTest
 *
 * @category PHP
 * @package Mol_Util
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/Mol_Components
 * @since 13.11.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the type inspector.
 *
 * @category PHP
 * @package Mol_Util
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/Mol_Components
 * @since 13.11.2012
 */
class Mol_Util_TypeInspectorTest extends PHPUnit_Framework_TestCase
{
    
    public function testIsClassThrowsExceptionIfNoStringIsProvided()
    {
        
    }
    
    public function testIsClassReturnsFalseIfGivenValueIsNoType()
    {
        
    }
    
    public function testIsClassReturnsFalseIfGivenValueIsAnInterface()
    {
        
    }
    
    public function testIsClassReturnsTrueIfGivenValueIsClassName()
    {
        
    }
    
    public function testIsThrowsExceptionIfProvidedConstraintIsNoType()
    {
        
    }
    
    public function testIsThrowsExceptionIfAtLeastOneOfTheProvidedConstraintsIsNoType()
    {
        
    }
    
    public function testIsThrowsExceptionIfProvidedValueIsNoString()
    {
        
    }
    
    public function testIsReturnsBooleanIfProvidedConstraintIsType()
    {
        
    }
    
    public function testIsReturnsBooleanIfConstraintListContainsOnlyValidTypes()
    {
        
    }
    
    public function testIsReturnsFalseIfValueDoesNotFulfillTypeConstraint()
    {
        
    }
    
    public function testIsReturnsFalseIfValueDoesNotFulfillAllGivenConstraints()
    {
        
    }
    
    public function testIsReturnsTrueIfValueFulfillsTypeConstraint()
    {
        
    }
    
    public function testIsReturnsTrueIfValueFulfillsAllGivenTypeConstraints()
    {
        
    }
    
    public function testIsReturnsTrueIfValueIsExactlyOfRequestedType()
    {
        
    }
    
    public function testIsReturnsTrueIfValueIsSubclassOfRequestedType()
    {
    
    }
    
    public function testIsReturnsTrueIfValueImplementsRequestedInterfaceType()
    {
        
    }
    
    public function testIsReturnsTrueIfValueIsAnInterfaceThatExtendsTheRequestedInterfaceType()
    {
        
    }
    
}
