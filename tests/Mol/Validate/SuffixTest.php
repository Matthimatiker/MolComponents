<?php

/**
 * Mol_Validate_SuffixTest
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 28.06.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the Suffix validator.
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 28.06.2012
 */
class Mol_Validate_SuffixTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Checks if getSuffixes() returns an array.
     */
    public function testGetSuffixesReturnsArray()
    {
        
    }
    
    /**
     * Checks if getSuffixes() returns the correct number of suffixes.
     */
    public function testGetSuffixesReturnsCorrectNumberOfSuffixes()
    {
        
    }
    
    /**
     * Checks if getSuffixes() returns the correct suffixes.
     */
    public function testGetSuffixesReturnsCorrectSuffixes()
    {
        
    }
    
    /**
     * Checks if setSuffixes() provides a fluent interface.
     */
    public function testSetSuffixesProvidesFluentInterface()
    {
        
    }
    
    /**
     * Ensures that setSuffixes() overwrites the current suffixes.
     */
    public function testSetSuffixesOverwritesCurrentSuffixes()
    {
        
    }
    
    /**
     * Ensures that the validator rejects values of invalid type.
     */
    public function testIsValidRejectsInvalidValue()
    {
        
    }
    
    /**
     * Checks if isValid() accepts a value with an accepted suffix.
     */
    public function testIsValidAcceptsValueWithAcceptedSuffix()
    {
        
    }
    
    /**
     * Ensures that isValid() accepts a value that ends with a suffix from
     * the end of the suffixes list.
     */
    public function testIsValidAcceptsValueWithSuffixFromEndOfList()
    {
        
    }
    
    /**
     * Ensures that the validator rejects a value without accepted suffix.
     */
    public function testIsValidRejectsValueWithoutAcceptedSuffix()
    {
        
    }
    
    /**
     * Ensures that isValid() accepts all string if the list of suffixes
     * is empty.
     */
    public function testIsValidAcceptsValueIfListOfAcceptedSuffixesIsEmpty()
    {
        
    }
    
    /**
     * Ensures that the validator provides a failure message if a value
     * of invalid type is provided.
     */
    public function testValidatorProvidesMessageIfInvalidValueIsProvided()
    {
        
    }
    
    /**
     * Ensures that the validator provides a failure message if a value without
     * accepted suffix is provided.
     */
    public function testValidatorProvidesMessageIfValueWithoutAcceptedSuffixIsProvided()
    {
        
    }
    
    /**
     * Checks if the suffixes property contains the allowed suffixes.
     */
    public function testSuffixesPropertyContainsStringRepresentationOfAllowedSuffixes()
    {
        
    }
    
    /**
     * Ensures that the constructor throws an exception if a suffixes parameter of
     * invalid type is passed.
     */
    public function testConstructorThrowsExceptionIfInvalidSuffixParameterIsProvided()
    {
        
    }
    
    /**
     * Checks if the constructor accepts a single suffix (string parameter).
     */
    public function testConstructorAcceptsSingleSuffix()
    {
        
    }
    
}
