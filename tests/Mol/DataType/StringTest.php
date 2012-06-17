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
        $object = Mol_DataType_String::create('test');
        $this->assertStringObject($object);
    }
    
    /**
     * Ensures that create() returns a string with the provided charset.
     */
    public function testCreateReturnsStringWithProvidedCharset()
    {
        $object = Mol_DataType_String::create('test', Mol_DataType_String::CHARSET_LATIN1);
        $this->assertStringObject($object);
        $this->assertEquals(Mol_DataType_String::CHARSET_LATIN1, $object->getCharset());
    }
    
    /**
     * Ensures that create() throws an exception if the provided string does not
     * use the given charset.
     */
    public function testCreateThrowsExceptionIfStringDoesNotUseTheProvidedCharset()
    {
        $this->setExpectedException('InvalidArgumentException');
        Mol_DataType_String::create('täääst', Mol_DataType_String::CHARSET_LATIN1);
    }
    
    /**
     * Ensures that create() throws an exception if the provided charset is  not valid.
     */
    public function testCreateThrowsExceptionIfInvalidCharsetIsProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        Mol_DataType_String::create('test', 'an-invalid-charset');
    }
    
    /**
     * Checks if toString() returns a string.
     */
    public function testToStringReturnsString()
    {
        $object = $this->create('test');
        $this->assertInternalType('string', $object->toString());
    }
    
    /**
     * Checks if toString() returns the correct string.
     */
    public function testToStringReturnsCorrectValue()
    {
        $object = $this->create('test');
        $this->assertInternalType('string', $object->toString());
        $this->assertEquals('test', $object->toString());
    }
    
    /**
     * Checks if convertTo() returns a string with the requested charset.
     */
    public function testConvertToReturnsStringWithProvidedCharset()
    {
        $object    = $this->create('test');
        $converted = $object->convertTo(Mol_DataType_String::CHARSET_LATIN1);
        $this->assertStringObject($converted);
        $this->assertEquals(Mol_DataType_String::CHARSET_LATIN1, $converted->getCharset());
    }
    
    /**
     * Checks if convertTo() converts the string into the requested charset.
     */
    public function testConvertChangesCharsetOfOriginalString()
    {
        $object    = $this->create('tääst');
        $converted = $object->convertTo(Mol_DataType_String::CHARSET_LATIN1);
        $this->assertStringObject($converted);
        $this->assertNotEquals('tääst', $converted->toString());
    }
    
    /**
     * Ensures that convertTo() returns the original string object if the
     * current charset is requested.
     */
    public function testConvertToReturnsSelfIfCurrentCharsetIsRequested()
    {
        $object    = $this->create('tääst');
        $converted = $object->convertTo(Mol_DataType_String::CHARSET_UTF8);
        $this->assertSame($object, $converted);
    }
    
    /**
     * Ensures that convertTo() throws an exception if an invalid charset is passed.
     */
    public function testConvertToThrowsExceptionIfInvalidCharsetIsRequested()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->create('test')->convertTo('an-invalid-charset');
    }
    
    /**
     * Ensures that inexOf() returns -1 if the string does not contain
     * the needle.
     */
    public function testIndexOfReturnsMinusOneIfStringDoesNotContainNeedle()
    {
        $index = $this->create('abcabc')->indexOf('d');
        $this->assertEquals(-1, $index);
    }
    
    /**
     * Checks if indexOf() returns the correct index.
     */
    public function testIndexOfReturnsCorrectIndex()
    {
        $index = $this->create('abcabc')->indexOf('c');
        $this->assertEquals(2, $index);
    }
    
    /**
     * Ensures that indexOf() starts to search at the provided offset.
     */
    public function testIndexOfDoesNotSearchBeforeProvidedOffset()
    {
        $index = $this->create('abcabc')->indexOf('a', 1);
        $this->assertEquals(3, $index);
    }
    
    /**
     * Ensures that lastIndexOf() returns -1 of the string does not contain the needle.
     */
    public function testLastIndexOfReturnsMinusOneIfStringDoesNotContainNeedle()
    {
        $index = $this->create('abcabc')->lastIndexOf('d');
        $this->assertEquals(-1, $index);
    }
    
    /**
     * Checks if lastIndexOf() returns the correct index.
     */
    public function testLastIndexOfReturnsCorrectIndex()
    {
        $index = $this->create('abcabc')->lastIndexOf('b');
        $this->assertEquals(4, $index);
    }
    
    /**
     * Ensures that lastIndexOf() does not search after the provided offset.
     */
    public function testLastIndexOfDoesNotSearchAfterProvidedOffset()
    {
        $index = $this->create('abcabc')->lastIndexOf('b', 3);
        $this->assertEquals(1, $index);
    }
    
    /**
     * Checks if indexesOf() returns an array.
     */
    public function testIndexesOfReturnsArray()
    {
        $indexes = $this->create('abcabc')->indexesOf('a');
        $this->assertInternalType('array', $indexes);
    }
    
    /**
     * Ensures that indexesOf() returns an array that contains the correct indexes.
     */
    public function testIndexesOfReturnsCorrectIndexes()
    {
        $indexes = $this->create('abcabc')->indexesOf('a');
        $this->assertInternalType('array', $indexes);
        $this->assertContains(0, $indexes);
        $this->assertContains(3, $indexes);
    }
    
    /**
     * Ensures that indexesOf() returns the correct indexes even if the string contains
     * multibyte characters.
     */
    public function testIndexesOfReturnsCorrectIndexesIfStringContainsMultibyteCharacters()
    {
        $indexes = $this->create('äbcäbc')->indexesOf('b');
        $this->assertInternalType('array', $indexes);
        $this->assertContains(1, $indexes);
        $this->assertContains(4, $indexes);
    }
    
    /**
     * Checks if indexesOf() returns the expected number of indexes.
     */
    public function testIndexesOfReturnsCorrectNumberOfIndexes()
    {
        $indexes = $this->create('abcabc')->indexesOf('a');
        $this->assertInternalType('array', $indexes);
        $this->assertEquals(2, count($indexes));
    }
    
    /**
     * Checks if the result of indexesOf() is a sorted integer array.
     */
    public function testIndexesOfReturnsSortedIndexes()
    {
        $indexes = $this->create('abcabc')->indexesOf('a');
        $this->assertInternalType('array', $indexes);
        $sorted = $indexes;
        sort($sorted);
        $this->assertEquals($sorted, $indexes);
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
     * Checks if it is possible to cast the object to a string.
     */
    public function testCastingObjectToStringReturnsCorrectValue()
    {
        
    }
    
    /**
     * Creates a string object.
     *
     * @param string $string
     * @param string $charset
     * @return Mol_DataType_String
     */
    protected function create($string, $charset = Mol_DataType_String::CHARSET_UTF8)
    {
        $object = Mol_DataType_String::create($string, $charset);
        $this->assertStringObject($object);
        return $object;
    }
    
    /**
     * Asserts that the provided value is an instance of Mol_DataType_String.
     *
     * @param mixed $object
     */
    protected function assertStringObject($object)
    {
        $this->assertInstanceOf('Mol_DataType_String', $object);
    }
    
}
