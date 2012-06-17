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
    
    public function testCreateReturnsStringObject()
    {
        
    }
    
    public function testCreateReturnsStringWithProvidedCharset()
    {
        
    }
    
    public function testCreateThrowsExceptionIfStringDoesNotUseTheProvidedCharset()
    {
        
    }
    
    public function testCreateThrowsExceptionIfInvalidCharsetIsProvided()
    {
        
    }
    
    public function testConvertToReturnsStringWithProvidedCharset()
    {
        
    }
    
    public function testConvertChangesCharsetOfOriginalString()
    {
        
    }
    
    public function testConvertToReturnsSelfIfCurrentCharsetIsRequested()
    {
        
    }
    
    public function testConvertToThrowsExceptionIfInvalidCharsetIsRequested()
    {
        
    }
    
    public function testIndexOfReturnsMinusOneIfStringDoesNotContainNeedle()
    {
        
    }
    
    public function testIndexOfReturnsCorrectIndex()
    {
        
    }
    
    public function testIndexOfDoesNotSearchBeforeProvidedOffset()
    {
        
    }
    
    public function testLastIndexOfReturnsMinusOneIfStringDoesNotContainNeedle()
    {
        
    }
    
    public function testLastIndexOfReturnsCorrectIndex()
    {
        
    }
    
    public function testLastIndexOfDoesNotSearchAfterProvidedOffset()
    {
        
    }
    
    public function testIndexesOfReturnsArray()
    {
        
    }
    
    public function testIndexesOfReturnsCorrectIndexes()
    {
        
    }
    
    public function testIndexesOfReturnsSortedIndexes()
    {
        
    }
    
    public function testStartsWithReturnsTrueIfTheStringStartsWithTheProvidedPrefix()
    {
        
    }
    
    public function testStartsWithReturnsFalseIfTheStringOnlyContainsThePrefix()
    {
        
    }
    
    public function testStartsWithReturnsFalseIfTheStringDoesNotContainThePrefix()
    {
        
    }
    
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
