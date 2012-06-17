<?php

/**
 * Mol_DataType_StringTest
 *
 * @category PHP
 * @package Mol_DataType
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 16.06.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the String class.
 *
 * @category PHP
 * @package Mol_DataType
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 16.06.2012
 */
class Mol_DataType_StringTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Checks if create() returns a string object.
     */
    public function testCreateReturnsStringObject()
    {
        
    }
    
    /**
     * Ensures that create() returns a string with the provided charset.
     */
    public function testCreateReturnsStringWithProvidedCharset()
    {
        
    }
    
    /**
     * Ensures that create() throws an exception if the provided string does not
     * use the given charset.
     */
    public function testCreateThrowsExceptionIfStringDoesNotUseTheProvidedCharset()
    {
        
    }
    
    /**
     * Ensures that create() throws an exception if the provided charset is  not valid.
     */
    public function testCreateThrowsExceptionIfInvalidCharsetIsProvided()
    {
        
    }
    
    /**
     * Checks if convertTo() returns a string with the requested charset.
     */
    public function testConvertToReturnsStringWithProvidedCharset()
    {
        
    }
    
    /**
     * Checks if convertTo() converts the string into the requested charset.
     */
    public function testConvertChangesCharsetOfOriginalString()
    {
        
    }
    
    /**
     * Ensures that convertTo() returns the original string object if the
     * current charset is requested.
     */
    public function testConvertToReturnsSelfIfCurrentCharsetIsRequested()
    {
        
    }
    
    /**
     * Ensures that convertTo() throws an exception if an invalid charset is passed.
     */
    public function testConvertToThrowsExceptionIfInvalidCharsetIsRequested()
    {
        
    }
    
    /**
     * Ensures that inexOf() returns -1 if the string does not contain
     * the needle.
     */
    public function testIndexOfReturnsMinusOneIfStringDoesNotContainNeedle()
    {
        
    }
    
    /**
     * Checks if indexOf() returns the correct index.
     */
    public function testIndexOfReturnsCorrectIndex()
    {
        
    }
    
    /**
     * Ensures that indexOf() starts to search at the provided offset.
     */
    public function testIndexOfDoesNotSearchBeforeProvidedOffset()
    {
        
    }
    
    /**
     * Ensures that lastIndexOf() returns -1 of the string does not contain the needle.
     */
    public function testLastIndexOfReturnsMinusOneIfStringDoesNotContainNeedle()
    {
        
    }
    
    /**
     * Checks if lastIndexOf() returns the correct index.
     */
    public function testLastIndexOfReturnsCorrectIndex()
    {
        
    }
    
    /**
     * Ensures that lastIndexOf() does not search after the provided offset.
     */
    public function testLastIndexOfDoesNotSearchAfterProvidedOffset()
    {
        
    }
    
    /**
     * Checks if indexesOf() returns an array.
     */
    public function testIndexesOfReturnsArray()
    {
        
    }
    
    /**
     * Ensures that indexesOf() returns an array that contains the correct indexes.
     */
    public function testIndexesOfReturnsCorrectIndexes()
    {
        
    }
    
    /**
     * Checks if the result of indexesOf() is a sorted integer array.
     */
    public function testIndexesOfReturnsSortedIndexes()
    {
        
    }
    
    /**
     * Ensures that startsWith() returns true if the string starts with the given
     * prefix.
     */
    public function testStartsWithReturnsTrueIfTheStringStartsWithTheProvidedPrefix()
    {
        
    }
    
    /**
     * Ensures that startsWith() returns false if the string does not start with
     * the prefix but contains it.
     */
    public function testStartsWithReturnsFalseIfTheStringOnlyContainsThePrefix()
    {
        
    }
    
    /**
     * Ensures that startsWith() returns false if the string does not even contain the prefix.
     */
    public function testStartsWithReturnsFalseIfTheStringDoesNotContainThePrefix()
    {
        
    }
    
    /**
     * Ensures that startsWith() returns false if the string is shorter than the
     * prefix and equals the first part of the prefix.
     */
    public function testStartsWithReturnsFalseIfStringEqualsFirstPartOfPrefix()
    {
        
    }
    
    public function testEndsWithReturnsTrueIfTheStringEndsWithTheProvidedSuffix()
    {
    
    }
    
    public function testEndsWithReturnsFalseIfTheStringOnlyContainsTheSuffix()
    {
    
    }
    
    public function testEndsWithReturnsFalseIfTheStringDoesNotContainTheSuffix()
    {
    
    }
    
    public function testRemovePrefixRemovesProvidedPrefix()
    {
        
    }
    
    public function testRemovePrefixDoesNotModifyStringIfItOnlyContainsPrefix()
    {
        
    }
    
    public function testRemovePrefixRemovesPrefixOnlyOnce()
    {
        
    }
    
    public function testRemoveSuffixRemovesProvidedSuffix()
    {
    
    }
    
    public function testRemoveSuffixDoesNotModifyStringIfItOnlyContainsSuffix()
    {
    
    }
    
    public function testRemoveSuffixRemovesSuffixOnlyOnce()
    {
    
    }
    
    public function testReplaceDoesNotModifyStringIfItDoesNotContainSearchString()
    {
        
    }
    
    public function testReplaceReplacesSingleSearchStringByReplaceValue()
    {
        
    }
    
    public function testReplaceReplacesListOfSearchStringsByReplaceValue()
    {
        
    }
    
    public function testReplaceAppliesMappingIfAssociativeArrayIsProvided()
    {
        
    }
    
    public function testSubStringExtractRequestedPartOfString()
    {
        
    }
    
    public function testSubStringExtendsSubStringToEndOfOriginalStringIfLengthIsNotProvided()
    {
        
    }
    
    public function testSubStringExtendsSubStringToEndOfOriginalStringIfLengthExceedsOriginalString()
    {
        
    }
    
    public function testToUpperCaseReturnsCorrectValue()
    {
        
    }
    
    public function testToUpperCaseWorksWithUmlauts()
    {
        
    }
    
    public function testToLowerCaseReturnsCorrectValue()
    {
        
    }
    
    public function testToLowerCaseWorksWithUmlauts()
    {
        
    }
    
    public function testTrimRemovesWhitespaceFromStart()
    {
        
    }
    
    public function testTrimRemovesWhitespaceFromEnd()
    {
        
    }
    
    public function testTrimRemovesProvidedCharactersFromStart()
    {
        
    }
    
    public function testTrimRemovesProvidedCharactersFromEnd()
    {
        
    }
    
    public function testTrimLeftRemovesWhitespaceFromStart()
    {
        
    }
    
    public function testTrimLeftDoesNotTouchWhitespaceAtTheEndOfTheString()
    {
        
    }
    
    public function testTrimLeftRemovesProvidedCharactersFromStart()
    {
    
    }
    
    public function testTrimLeftDoesNotTouchProvidedCharactersAtTheEndOfTheString()
    {
    
    }
    
    public function testTrimRightRemovesWhitespaceFromEnd()
    {
    
    }
    
    public function testTrimRightDoesNotTouchWhitespaceAtTheStartOfTheString()
    {
    
    }
    
    public function testTrimRightRemovesProvidedCharactersFromEnd()
    {
    
    }
    
    public function testTrimRightDoesNotTouchProvidedCharactersAtTheStartOfTheString()
    {
    
    }
    
    public function testToCharactersReturnsArray()
    {
        
    }
    
    public function testToCharactersReturnsExpectedNumberOfCharacters()
    {
        
    }
    
    public function testToCharactersReturnsCorrectCharacters()
    {
        
    }
    
    public function testToCharactersReturnsCharactersInCorrectOrder()
    {
        
    }
    
    public function testToCharactersWorksWithUmlauts()
    {
        
    }
    
    public function testStringIsTraversable()
    {
        
    }
    
    public function testGetIteratorReturnsTraversable()
    {
        
    }
    
    public function testIterationLoopsThroughCharacters()
    {
        
    }
    
    public function testEqualsReturnsTrueIfStringsAreEqual()
    {
        
    }
    
    public function testEqualsReturnsFalseIfStringLengthIsNotEqual()
    {
        
    }
    
    public function testEqualsReturnsFalseIfStringContentDiffers()
    {
        
    }
    
    public function testLengthReturnsInteger()
    {
        
    }
    
    public function testLengthReturnsCorrectValue()
    {
        
    }
    
    public function testLengthReturnsCorrectValueIfStringContainsUmlauts()
    {
        
    }
    
    public function testLengthInBytesReturnsInteger()
    {
        
    }
    
    public function testLengthInBytesReturnsCorrectValue()
    {
        
    }
    
    public function testLengthInBytesReturnsCorrectValueIfStringContainsUmlauts()
    {
        
    }
    
    public function testStringIsCountable()
    {
        
    }
    
    public function testCountReturnsSameValueAsLength()
    {
        
    }
    
    public function testIsEmptyReturnsTrueIfStringLengthIsZero()
    {
        
    }
    
    public function testIsEmptyReturnsTrueIfStringContainsOnlyWhitespace()
    {
        
    }
    
    public function testIsEmptyReturnsFalseIfStringContainsNonWhitespaceCharacters()
    {
        
    }
    
    public function testToStringReturnsString()
    {
        
    }
    
    public function testToStringReturnsCorrectValue()
    {
        
    }
    
    public function testCastingObjectToStringReturnsCorrectValue()
    {
        
    }
    
}
