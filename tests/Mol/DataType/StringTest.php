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
    
    /**
     * Ensures that endsWith() returns true if the string ends with the given suffix.
     */
    public function testEndsWithReturnsTrueIfTheStringEndsWithTheProvidedSuffix()
    {
    
    }
    
    /**
     * Ensures that endsWith() returns false if the string does not end with the
     * given suffix but contains it.
     */
    public function testEndsWithReturnsFalseIfTheStringOnlyContainsTheSuffix()
    {
    
    }
    
    /**
     * Ensures that endsWith() returns false if the string does not even contain
     * the given suffix.
     */
    public function testEndsWithReturnsFalseIfTheStringDoesNotContainTheSuffix()
    {
    
    }
    
    /**
     * Checks if removePrefix() removes the given prefix from the string.
     */
    public function testRemovePrefixRemovesProvidedPrefix()
    {
        
    }
    
    /**
     * Ensures that removePrefix() removes the prefix only once.
     */
    public function testRemovePrefixRemovesPrefixOnlyOnce()
    {
    
    }
    
    /**
     * Ensures that removePrefix() does not modify the string if it does not
     * start with the prefix but contains it.
     */
    public function testRemovePrefixDoesNotModifyStringIfItOnlyContainsPrefix()
    {
        
    }
    
    /**
     * Checks if removeSuffix() removes the provided suffix from the string.
     */
    public function testRemoveSuffixRemovesProvidedSuffix()
    {
    
    }
    
    /**
     * Ensures that removeSuffix() removes the suffix only once.
     */
    public function testRemoveSuffixRemovesSuffixOnlyOnce()
    {
    
    }
    
    /**
     * Ensures that removeSuffix() does not modify the string if it does not
     * end with the suffix but contains it.
     */
    public function testRemoveSuffixDoesNotModifyStringIfItOnlyContainsSuffix()
    {
    
    }
    
    /**
     * Ensures that replace() does not modify the string if it does not contain
     * the search value.
     */
    public function testReplaceDoesNotModifyStringIfItDoesNotContainSearchString()
    {
        
    }
    
    /**
     * Tests signature replace(string, string):
     * Checks if replace() replaces the search string by the provided values.
     */
    public function testReplaceReplacesSingleSearchStringByReplaceValue()
    {
        
    }
    
    /**
     * Tests signature replace(array(string), string):
     * Checks if replace() replaces all search strings by the provided value.
     */
    public function testReplaceReplacesListOfSearchStringsByReplaceValue()
    {
        
    }
    
    /**
     * Tests signature replace(array(string=>string)):
     * Checks if replace() applies the mapping of search/replace pairs to the string.
     */
    public function testReplaceAppliesMappingIfAssociativeArrayIsProvided()
    {
        
    }
    
    /**
     * Checks if subString() extracts the correct part of the string.
     */
    public function testSubStringExtractRequestedPartOfString()
    {
        
    }
    
    /**
     * Ensures that the stubString() is extended to end of the original string if no
     * length parameter is provided.
     */
    public function testSubStringExtendsSubStringToEndOfOriginalStringIfLengthIsNotProvided()
    {
        
    }
    
    /**
     * Ensures that the stubString() is extended to end of the original string if the provided
     * length exceeds the length of the original string.
     */
    public function testSubStringExtendsSubStringToEndOfOriginalStringIfLengthExceedsOriginalString()
    {
        
    }
    
    /**
     * Checks if subString() handles multi-byte characters (for example umlauts) correctly.
     */
    public function testSubStringWorksWithUmlauts()
    {
        
    }
    
    /**
     * Checks if toUpperCase() returns the correct string.
     */
    public function testToUpperCaseReturnsCorrectValue()
    {
        
    }
    
    /**
     * Checks if toUpperCase() treats umlauts correctly.
     */
    public function testToUpperCaseWorksWithUmlauts()
    {
        
    }
    
    /**
     * Checks if toLowerCase() returns the correct string.
     */
    public function testToLowerCaseReturnsCorrectValue()
    {
        
    }
    
    /**
     * Checks if toLowerCase() treats umlauts correctly.
     */
    public function testToLowerCaseWorksWithUmlauts()
    {
        
    }
    
    /**
     * Checks if trim() removes whitespace from the start of the string.
     */
    public function testTrimRemovesWhitespaceFromStart()
    {
        
    }
    
    /**
     * Checks if trim() removes whitespace from the end of the string.
     */
    public function testTrimRemovesWhitespaceFromEnd()
    {
        
    }
    
    /**
     * Checks if trim() removes the provided characters from the start of the string.
     */
    public function testTrimRemovesProvidedCharactersFromStart()
    {
        
    }
    
    /**
     * Checks if trim() removes the provided characters from the end of the string.
     */
    public function testTrimRemovesProvidedCharactersFromEnd()
    {
        
    }
    
    /**
     * Checks if trimLeft() removes whitespace from the start of the string.
     */
    public function testTrimLeftRemovesWhitespaceFromStart()
    {
        
    }
    
    /**
     * Ensures that trimLeft() does not touch whitespace at the end of the string.
     */
    public function testTrimLeftDoesNotTouchWhitespaceAtTheEndOfTheString()
    {
        
    }
    
    /**
     * Checks if trimLeft() removes the provided characters from the start of the string.
     */
    public function testTrimLeftRemovesProvidedCharactersFromStart()
    {
    
    }
    
    /**
     * Ensures that trimLeft() does not touch the characters at the end of the string.
     */
    public function testTrimLeftDoesNotTouchProvidedCharactersAtTheEndOfTheString()
    {
    
    }
    
    /**
     * Checks if trimRight() removes whitespace from the end of the string.
     */
    public function testTrimRightRemovesWhitespaceFromEnd()
    {
    
    }
    
    /**
     * Ensures that trimRight() does not touch whitespace at the start of the string.
     */
    public function testTrimRightDoesNotTouchWhitespaceAtTheStartOfTheString()
    {
    
    }
    
    /**
     * Checks if trimRight() removes the provided characters from the end of the string.
     */
    public function testTrimRightRemovesProvidedCharactersFromEnd()
    {
    
    }
    
    /**
     * Ensures that trimRight() does not touch characters at the start of the string.
     */
    public function testTrimRightDoesNotTouchProvidedCharactersAtTheStartOfTheString()
    {
    
    }
    
    /**
     * Checks if toCharacters() returns an array.
     */
    public function testToCharactersReturnsArray()
    {
        
    }
    
    /**
     * Checks if toCharacters() returns the expected number of characters.
     */
    public function testToCharactersReturnsExpectedNumberOfCharacters()
    {
        
    }
    
    /**
     * Ensures that toCharacters() returns the correct characters.
     */
    public function testToCharactersReturnsCorrectCharacters()
    {
        
    }
    
    /**
     * Checks if toCharacters() returns the characters in correct order.
     */
    public function testToCharactersReturnsCharactersInCorrectOrder()
    {
        
    }
    
    /**
     * Checks if toCharacters() handles multi-byte characters (for example
     * umlauts) correctly.
     */
    public function testToCharactersWorksWithUmlauts()
    {
        
    }
    
    /**
     * Checks if the string object is traverable.
     */
    public function testStringIsTraversable()
    {
        
    }
    
    /**
     * Ensures that getIterator() returns an instance of Traversable.
     */
    public function testGetIteratorReturnsTraversable()
    {
        
    }
    
    /**
     * Checks if the iteration loops through the characters of the string.
     */
    public function testIterationLoopsThroughCharacters()
    {
        
    }
    
    /**
     * Ensures that equals() returns true if the string are equal.
     */
    public function testEqualsReturnsTrueIfStringsAreEqual()
    {
        
    }
    
    /**
     * Ensures that equals() returns false if the compared strings
     * have different lengths.
     */
    public function testEqualsReturnsFalseIfStringLengthIsNotEqual()
    {
        
    }
    
    /**
     * Ensures that equals() returns false if teh compared string have the
     * same length, but their content differs.
     */
    public function testEqualsReturnsFalseIfStringContentDiffers()
    {
        
    }
    
    /**
     * Checks if length() returns an integer.
     */
    public function testLengthReturnsInteger()
    {
        
    }
    
    /**
     * Checks if length() returns the number of characters.
     */
    public function testLengthReturnsCorrectValue()
    {
        
    }
    
    /**
     * Ensures that length() returns the correct number of characters even
     * if the string contains multi-byte characters.
     */
    public function testLengthReturnsCorrectValueIfStringContainsUmlauts()
    {
        
    }
    
    /**
     * Ensures that lengthInBytes() returns an integer.
     */
    public function testLengthInBytesReturnsInteger()
    {
        
    }
    
    /**
     * Checks if lengthInBytes() returns the correct number of bytes.
     */
    public function testLengthInBytesReturnsCorrectValue()
    {
        
    }
    
    /**
     * Ensures that lengthInBytes() returns the correct value if the string
     * contains multi-byte characters.
     */
    public function testLengthInBytesReturnsCorrectValueIfStringContainsUmlauts()
    {
        
    }
    
    /**
     * Checks if the string is countable.
     */
    public function testStringIsCountable()
    {
        
    }
    
    /**
     * Ensures that count() returns the same value as length().
     */
    public function testCountReturnsSameValueAsLength()
    {
        
    }
    
    /**
     * Ensures that isEmpty() returns true if the length of the string is 0.
     */
    public function testIsEmptyReturnsTrueIfStringLengthIsZero()
    {
        
    }
    
    /**
     * Ensures that isEmpty() returns true if the string contains only whitespace.
     */
    public function testIsEmptyReturnsTrueIfStringContainsOnlyWhitespace()
    {
        
    }
    
    /**
     * Ensures that isEmpty() returns false if the string contains non-whitespace
     * characters.
     */
    public function testIsEmptyReturnsFalseIfStringContainsNonWhitespaceCharacters()
    {
        
    }
    
    /**
     * Checks if toString() returns a string.
     */
    public function testToStringReturnsString()
    {
        
    }
    
    /**
     * Checks if toString() returns the correct string.
     */
    public function testToStringReturnsCorrectValue()
    {
        
    }
    
    /**
     * Checks if it is possible to cast the object to a string.
     */
    public function testCastingObjectToStringReturnsCorrectValue()
    {
        
    }
    
}
