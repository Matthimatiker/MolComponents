<?php

/**
 * Mol_Validate_Form_ElementRelationTest
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 23.06.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the ElementComparison validator.
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 23.06.2012
 */
class Mol_Validate_Form_ElementRelationTest extends PHPUnit_Framework_TestCase
{
    
    public function testIsValidReturnsFalseIfNoContextIsProvided()
    {
        
    }
    
    public function testValidatorProvidesMessageIfNoContextIsProvided()
    {
        
    }
    
    public function testIsValidReturnsFalseIfContextIsNotAnArray()
    {
        
    }
    
    public function testValidatorProvidesMessageIfContextIsNotAnArray()
    {
    
    }
    
    public function testIsValidReturnsFalseIfComparedValueIsMissing()
    {
        
    }
    
    public function testValidatorProvidesMessageIfComparedValueIsMissing()
    {
    
    }
    
    public function testValidatedValueIsPassedToRelationValidator()
    {
        
    }
    
    public function testCompareValueIsPassedToRelationValidator()
    {
        
    }
    
    public function testValidatorRejectsInputIfRelationValidatorDoesNotAcceptValues()
    {
        
    }
    
    public function testGetMessagesReturnsMessagesProvidedByRelationValidator()
    {
        
    }
    
    public function testValidatedValueIsAccessibleViaMagicProperty()
    {
        
    }
    
    public function testLabelOfComparedElementIsAccessibleViaMagicProperty()
    {
        
    }
    
    public function testComparedValueIsAccessibleViaMagicProperty()
    {
    
    }
    
    public function testConstructorThrowsExceptionIfInvalidRelationIdentifierIsProvided()
    {
    
    }
    
    public function testConstructorThrowsExceptionIfInvalidRelationObjectIsProvided()
    {
    
    }
    
}