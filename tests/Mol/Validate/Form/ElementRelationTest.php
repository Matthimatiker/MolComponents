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
    
    /**
     * Ensures that isValid() returns false if no context is provided.
     */
    public function testIsValidReturnsFalseIfNoContextIsProvided()
    {
        
    }
    
    /**
     * Checks if the validator provides a failure message if no context
     * was available during validation.
     */
    public function testValidatorProvidesMessageIfNoContextIsProvided()
    {
        
    }
    
    /**
     * Ensures that isValid() returns false if no valid context is provided.
     */
    public function testIsValidReturnsFalseIfContextIsNotAnArray()
    {
        
    }
    
    /**
     * Checks if the validator provides a failure message if no valid context
     * was passed to isValid().
     */
    public function testValidatorProvidesMessageIfContextIsNotAnArray()
    {
    
    }
    
    /**
     * Ensures that isValid() returns false if the context does not contain
     * the compared value.
     */
    public function testIsValidReturnsFalseIfComparedValueIsMissing()
    {
        
    }
    
    /**
     * Checks if the validator provides a failure message if the context that
     * was passed to isValid() did not contain the compared value.
     */
    public function testValidatorProvidesMessageIfComparedValueIsMissing()
    {
    
    }
    
    /**
     * Checks if the validated value is passed to the relation validator.
     */
    public function testValidatedValueIsPassedToRelationValidator()
    {
        
    }
    
    /**
     * Checks if the compared value is passed to the relationb validator.
     */
    public function testCompareValueIsPassedToRelationValidator()
    {
        
    }
    
    /**
     * Ensures that isValid() returns false if the relation validator rejects
     * the compared values.
     */
    public function testValidatorRejectsInputIfRelationValidatorDoesNotAcceptValues()
    {
        
    }
    
    /**
     * Ensures that getMessages() returns the messages that are provided by the
     * relation validator.
     */
    public function testGetMessagesReturnsMessagesProvidedByRelationValidator()
    {
        
    }
    
    /**
     * Ensures that the validator injects properties into the message of the relation validator
     * if it contains placeholders.
     */
    public function testValidatorInjectsPropertiesIntoMessagesThatAreProvidedByTheRelationValidator()
    {
        
    }
    
    /**
     * Checks if the validated value is available as property.
     */
    public function testValidatedValueIsAccessibleAsProperty()
    {
        
    }
    
    /**
     * Checks if the label of the compared element is available as property.
     */
    public function testLabelOfComparedElementIsAccessibleAsProperty()
    {
        
    }
    
    /**
     * Checks if the compared value is available as property.
     */
    public function testComparedValueIsAccessibleAsProperty()
    {
    
    }
    
    /**
     * Ensures that the constructor throws an exception if an invalid relation identifier
     * is provided.
     */
    public function testConstructorThrowsExceptionIfInvalidRelationIdentifierIsProvided()
    {
    
    }
    
    /**
     * Ensures that the constructor throws an exception if an invalid relation object
     * is provided.
     *
     * Valid relation object must at least implement Zend_Validate_Interface.
     */
    public function testConstructorThrowsExceptionIfInvalidRelationObjectIsProvided()
    {
    
    }
    
}