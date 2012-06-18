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
        $latin1String = iconv(Mol_DataType_String::CHARSET_UTF8, Mol_DataType_String::CHARSET_LATIN1, 'täääst');
        Mol_DataType_String::create($latin1String, Mol_DataType_String::CHARSET_UTF8);
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
     * Checks if create() accepts alias names of charsets.
     */
    public function testCreateSupportsCharsetAliases()
    {
        $this->setExpectedException(null);
        Mol_DataType_String::create('test', 'latin1');
    }
    
    /**
     * Ensures that create() unifies charset names.
     *
     * If an alias is used to construct the string then the real charset names
     * should be used by the string object afterwards.
     */
    public function testCreateUnifiesCharset()
    {
        $object = $this->create('test', 'latin1');
        $this->assertEquals(Mol_DataType_String::CHARSET_LATIN1, $object->getCharset());
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
     * Checks if convertTo() uses character transliteration (using similar
     * characters if the characters cannot be converted to the requested
     * charset).
     */
    public function testConvertToUsesCharacterTransliteration()
    {
        $object = $this->create('one test for 10€');
        // The € sign is not available in Latin1.
        $converted = $object->convertTo(Mol_DataType_String::CHARSET_LATIN1);
        $this->assertStringObject($converted);
        // The string must not end with "10", otherwise the € sign was silently discarded.
        $this->assertStringEndsNotWith('10', $converted->toString());
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
     * Ensures that indexOf() returns -1 if the haystack string is empty.
     */
    public function testIndexOfReturnsMinusOneIfStringIsEmpty()
    {
        $index = $this->create('')->indexOf('d');
        $this->assertEquals(-1, $index);
    }
    
    /**
     * Ensures that indexOf() returns -1 if the provided start index exceeds
     * the length of the string.
     */
    public function testIndexOfReturnsMinusOneIfOffsetExceedsStringLength()
    {
        $index = $this->create('abc')->indexOf('c', 3);
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
     * Ensures that indexOf() returns the correct index even if the string contains
     * multi-byte chracters.
     */
    public function testIndexOfReturnsCorrectIndexIfStringContainsMultiByteCharacters()
    {
        $index = $this->create('äbcäbc')->indexOf('c');
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
     * Ensures that lastIndexOf() returns the correct index even if the string contains
     * multi-byte chracters.
     */
    public function testLastIndexOfReturnsCorrectIndexIfStringContainsMultibyteCharacters()
    {
        $index = $this->create('äbcäbc')->lastIndexOf('b');
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
     * Ensures that searching via lastIndexOf() includes the character
     * at the provided $fromIndex position.
     */
    public function testLastIndexOfIncludesCharacterAtFromIndex()
    {
        $index = $this->create('abcabc')->lastIndexOf('a', 3);
        $this->assertEquals(3, $index);
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
        $result = $this->create('this is a test string')->startsWith('this');
        $this->assertTrue($result);
    }
    
    /**
     * Ensures that startsWith() returns false if the string does not start with
     * the prefix but contains it.
     */
    public function testStartsWithReturnsFalseIfTheStringOnlyContainsThePrefix()
    {
        $result = $this->create('this is a test string')->startsWith('test');
        $this->assertFalse($result);
    }
    
    /**
     * Ensures that startsWith() returns false if the string does not even contain the prefix.
     */
    public function testStartsWithReturnsFalseIfTheStringDoesNotContainThePrefix()
    {
        $result = $this->create('this is a test string')->startsWith('demo');
        $this->assertFalse($result);
    }
    
    /**
     * Ensures that startsWith() returns false if the string is shorter than the
     * prefix and equals the first part of the prefix.
     */
    public function testStartsWithReturnsFalseIfStringEqualsFirstPartOfPrefix()
    {
        $result = $this->create('test')->startsWith('testprefix');
        $this->assertFalse($result);
    }
    
    /**
     * Ensures that endsWith() returns true if the string ends with the given suffix.
     */
    public function testEndsWithReturnsTrueIfTheStringEndsWithTheProvidedSuffix()
    {
        $result = $this->create('this is a test string')->endsWith('string');
        $this->assertTrue($result);
    }
    
    /**
     * Ensures that endsWith() returns false if the string does not end with the
     * given suffix but contains it.
     */
    public function testEndsWithReturnsFalseIfTheStringOnlyContainsTheSuffix()
    {
        $result = $this->create('this is a test string')->endsWith('test');
        $this->assertFalse($result);
    }
    
    /**
     * Ensures that endsWith() returns false if the string does not even contain
     * the given suffix.
     */
    public function testEndsWithReturnsFalseIfTheStringDoesNotContainTheSuffix()
    {
        $result = $this->create('this is a test string')->endsWith('demo');
        $this->assertFalse($result);
    }
    
    /**
     * Checks if removePrefix() removes the given prefix from the string.
     */
    public function testRemovePrefixRemovesProvidedPrefix()
    {
        $object = $this->create('this is a test string')->removePrefix('this ');
        $this->assertStringObject($object);
        $this->assertEquals('is a test string', $object->toString());
    }
    
    /**
     * Ensures that removePrefix() removes the prefix only once.
     */
    public function testRemovePrefixRemovesPrefixOnlyOnce()
    {
        $object = $this->create('testtestdemo')->removePrefix('test');
        $this->assertStringObject($object);
        $this->assertEquals('testdemo', $object->toString());
    }
    
    /**
     * Ensures that removePrefix() does not modify the string if it does not
     * start with the prefix but contains it.
     */
    public function testRemovePrefixDoesNotModifyStringIfItOnlyContainsPrefix()
    {
        $object = $this->create('this is a test string')->removePrefix('test');
        $this->assertStringObject($object);
        $this->assertEquals('this is a test string', $object->toString());
    }
    
    /**
     * Checks if removeSuffix() removes the provided suffix from the string.
     */
    public function testRemoveSuffixRemovesProvidedSuffix()
    {
        $object = $this->create('this is a test string')->removeSuffix(' string');
        $this->assertStringObject($object);
        $this->assertEquals('this is a test', $object->toString());
    }
    
    /**
     * Ensures that removeSuffix() removes the suffix only once.
     */
    public function testRemoveSuffixRemovesSuffixOnlyOnce()
    {
        $object = $this->create('demotesttest')->removeSuffix('test');
        $this->assertStringObject($object);
        $this->assertEquals('demotest', $object->toString());
    }
    
    /**
     * Ensures that removeSuffix() does not modify the string if it does not
     * end with the suffix but contains it.
     */
    public function testRemoveSuffixDoesNotModifyStringIfItOnlyContainsSuffix()
    {
        $object = $this->create('this is a test string')->removeSuffix('test');
        $this->assertStringObject($object);
        $this->assertEquals('this is a test string', $object->toString());
    }
    
    /**
     * Ensures that replace() does not modify the string if it does not contain
     * the search value.
     */
    public function testReplaceDoesNotModifyStringIfItDoesNotContainSearchString()
    {
        $object = $this->create('hello world')->replace('foo', 'bar');
        $this->assertStringObject($object);
        $this->assertEquals('hello world', $object->toString());
    }
    
    /**
     * Tests signature replace(string, string):
     * Checks if replace() replaces the search string by the provided values.
     */
    public function testReplaceReplacesSingleSearchStringByReplaceValue()
    {
        $object = $this->create('hello world')->replace('hello', 'bye');
        $this->assertStringObject($object);
        $this->assertEquals('bye world', $object->toString());
    }
    
    /**
     * Tests signature replace(array(string), string):
     * Checks if replace() replaces all search strings by the provided value.
     */
    public function testReplaceReplacesListOfSearchStringsByReplaceValue()
    {
        $object = $this->create('hello world')->replace(array('hello', 'world'), 'dummy');
        $this->assertStringObject($object);
        $this->assertEquals('dummy dummy', $object->toString());
    }
    
    /**
     * Tests signature replace(array(string=>string)):
     * Checks if replace() applies the mapping of search/replace pairs to the string.
     */
    public function testReplaceAppliesMappingIfAssociativeArrayIsProvided()
    {
        $mapping = array(
            'hello' => 'welcome',
            'world' => 'home'
        );
        $object  = $this->create('hello world')->replace($mapping);
        $this->assertStringObject($object);
        $this->assertEquals('welcome home', $object->toString());
    }
    
    /**
     * Checks if subString() extracts the correct part of the string.
     */
    public function testSubStringExtractsRequestedPartOfString()
    {
        $subString = $this->create('the brown dog digs')->subString(4, 5);
        $this->assertStringObject($subString);
        $this->assertEquals('brown', $subString->toString());
    }
    
    /**
     * Ensures that the stubString() is extended to end of the original string if no
     * length parameter is provided.
     */
    public function testSubStringExtendsSubStringToEndOfOriginalStringIfLengthIsNotProvided()
    {
        $subString = $this->create('the brown dog digs')->subString(10);
        $this->assertStringObject($subString);
        $this->assertEquals('dog digs', $subString->toString());
    }
    
    /**
     * Ensures that the stubString() is extended to end of the original string if the provided
     * length exceeds the length of the original string.
     */
    public function testSubStringExtendsSubStringToEndOfOriginalStringIfLengthExceedsOriginalString()
    {
        $subString = $this->create('the brown dog digs')->subString(10, 20);
        $this->assertStringObject($subString);
        $this->assertEquals('dog digs', $subString->toString());
    }
    
    /**
     * Checks if subString() handles multi-byte characters (for example umlauts) correctly.
     */
    public function testSubStringWorksWithUmlauts()
    {
        $subString = $this->create('täst täst')->subString(5);
        $this->assertStringObject($subString);
        $this->assertEquals('täst', $subString->toString());
    }
    
    /**
     * Checks if toUpperCase() returns the correct string.
     */
    public function testToUpperCaseReturnsCorrectValue()
    {
        $object = $this->create('aBc')->toUpperCase();
        $this->assertStringObject($object);
        $this->assertEquals('ABC', $object->toString());
    }
    
    /**
     * Checks if toUpperCase() treats umlauts correctly.
     */
    public function testToUpperCaseWorksWithUmlauts()
    {
        $object = $this->create('äÖü')->toUpperCase();
        $this->assertStringObject($object);
        $this->assertEquals('ÄÖÜ', $object->toString());
    }
    
    /**
     * Checks if toLowerCase() returns the correct string.
     */
    public function testToLowerCaseReturnsCorrectValue()
    {
        $object = $this->create('AbC')->toLowerCase();
        $this->assertStringObject($object);
        $this->assertEquals('abc', $object->toString());
    }
    
    /**
     * Checks if toLowerCase() treats umlauts correctly.
     */
    public function testToLowerCaseWorksWithUmlauts()
    {
        $object = $this->create('ÄöÜ')->toLowerCase();
        $this->assertStringObject($object);
        $this->assertEquals('äöü', $object->toString());
    }
    
    /**
     * Checks if trim() removes whitespace from the start of the string.
     */
    public function testTrimRemovesWhitespaceFromStart()
    {
        $object = $this->create(' abc')->trim();
        $this->assertStringObject($object);
        $this->assertEquals('abc', $object->toString());
    }
    
    /**
     * Checks if trim() removes whitespace from the end of the string.
     */
    public function testTrimRemovesWhitespaceFromEnd()
    {
        $object = $this->create('abc ')->trim();
        $this->assertStringObject($object);
        $this->assertEquals('abc', $object->toString());
    }
    
    /**
     * Checks if trim() removes the provided characters from the start of the string.
     */
    public function testTrimRemovesProvidedCharactersFromStart()
    {
        $object = $this->create('abc')->trim('ba');
        $this->assertStringObject($object);
        $this->assertEquals('c', $object->toString());
    }
    
    /**
     * Checks if trim() removes the provided characters from the end of the string.
     */
    public function testTrimRemovesProvidedCharactersFromEnd()
    {
        $object = $this->create('abc')->trim('cb');
        $this->assertStringObject($object);
        $this->assertEquals('a', $object->toString());
    }
    
    /**
     * Checks if trimLeft() removes whitespace from the start of the string.
     */
    public function testTrimLeftRemovesWhitespaceFromStart()
    {
        $object = $this->create(' abc')->trimLeft();
        $this->assertStringObject($object);
        $this->assertEquals('abc', $object->toString());
    }
    
    /**
     * Ensures that trimLeft() does not touch whitespace at the end of the string.
     */
    public function testTrimLeftDoesNotTouchWhitespaceAtTheEndOfTheString()
    {
        $object = $this->create('abc ')->trimLeft();
        $this->assertStringObject($object);
        $this->assertEquals('abc ', $object->toString());
    }
    
    /**
     * Checks if trimLeft() removes the provided characters from the start of the string.
     */
    public function testTrimLeftRemovesProvidedCharactersFromStart()
    {
        $object = $this->create('abc')->trimLeft('ba');
        $this->assertStringObject($object);
        $this->assertEquals('c', $object->toString());
    }
    
    /**
     * Ensures that trimLeft() does not touch the characters at the end of the string.
     */
    public function testTrimLeftDoesNotTouchProvidedCharactersAtTheEndOfTheString()
    {
        $object = $this->create('abc')->trimLeft('c');
        $this->assertStringObject($object);
        $this->assertEquals('abc', $object->toString());
    }
    
    /**
     * Checks if trimRight() removes whitespace from the end of the string.
     */
    public function testTrimRightRemovesWhitespaceFromEnd()
    {
        $object = $this->create('abc ')->trimRight();
        $this->assertStringObject($object);
        $this->assertEquals('abc', $object->toString());
    }
    
    /**
     * Ensures that trimRight() does not touch whitespace at the start of the string.
     */
    public function testTrimRightDoesNotTouchWhitespaceAtTheStartOfTheString()
    {
        $object = $this->create(' abc')->trimRight();
        $this->assertStringObject($object);
        $this->assertEquals(' abc', $object->toString());
    }
    
    /**
     * Checks if trimRight() removes the provided characters from the end of the string.
     */
    public function testTrimRightRemovesProvidedCharactersFromEnd()
    {
        $object = $this->create('abc')->trimRight('cb');
        $this->assertStringObject($object);
        $this->assertEquals('a', $object->toString());
    }
    
    /**
     * Ensures that trimRight() does not touch characters at the start of the string.
     */
    public function testTrimRightDoesNotTouchProvidedCharactersAtTheStartOfTheString()
    {
        $object = $this->create('abc')->trimRight('a');
        $this->assertStringObject($object);
        $this->assertEquals('abc', $object->toString());
    }
    
    /**
     * Checks if toCharacters() returns an array.
     */
    public function testToCharactersReturnsArray()
    {
        $characters = $this->create('abcde')->toCharacters();
        $this->assertInternalType('array', $characters);
    }
    
    /**
     * Checks if toCharacters() returns the expected number of characters.
     */
    public function testToCharactersReturnsExpectedNumberOfCharacters()
    {
        $characters = $this->create('abcde')->toCharacters();
        $this->assertInternalType('array', $characters);
        $this->assertEquals(5, count($characters));
    }
    
    /**
     * Ensures that toCharacters() returns the correct characters.
     */
    public function testToCharactersReturnsCorrectCharacters()
    {
        $characters = $this->create('abcde')->toCharacters();
        $this->assertInternalType('array', $characters);
        $this->assertContains('a', $characters);
        $this->assertContains('b', $characters);
        $this->assertContains('c', $characters);
        $this->assertContains('d', $characters);
        $this->assertContains('e', $characters);
    }
    
    /**
     * Checks if toCharacters() returns the characters in correct order.
     */
    public function testToCharactersReturnsCharactersInCorrectOrder()
    {
        $characters = $this->create('edcba')->toCharacters();
        $this->assertInternalType('array', $characters);
        $expected = array(
            'e',
            'd',
            'c',
            'b',
            'a'
        );
        $this->assertEquals($expected, $characters);
    }
    
    /**
     * Checks if toCharacters() handles multi-byte characters (for example
     * umlauts) correctly.
     */
    public function testToCharactersWorksWithUmlauts()
    {
        $characters = $this->create('äbcü')->toCharacters();
        $this->assertInternalType('array', $characters);
        $expected = array(
            'ä',
            'b',
            'c',
            'ü'
        );
        $this->assertEquals($expected, $characters);
    }
    
    /**
     * Checks if the string object is traverable.
     */
    public function testStringIsTraversable()
    {
        $object = $this->create('test');
        $this->assertInstanceOf('Traversable', $object);
    }
    
    /**
     * Ensures that getIterator() returns an instance of Traversable.
     */
    public function testGetIteratorReturnsTraversable()
    {
        $iterator = $this->create('test')->getIterator();
        $this->assertInstanceOf('Traversable', $iterator);
    }
    
    /**
     * Checks if the iteration loops through the characters of the string.
     */
    public function testIterationLoopsThroughCharacters()
    {
        $object     = $this->create('abc');
        $characters = array();
        foreach ($object as $character) {
            /* @var $character string */
            $this->assertInternalType('string', $character);
            $characters[] = $character;
        }
        $this->assertEquals('abc', implode('', $characters));
    }
    
    /**
     * Ensures that equals() returns true if the string are equal.
     */
    public function testEqualsReturnsTrueIfStringsAreEqual()
    {
        $equal = $this->create('abc')->equals('abc');
        $this->assertTrue($equal);
    }
    
    /**
     * Ensures that equals() returns false if the compared strings
     * have different lengths.
     */
    public function testEqualsReturnsFalseIfStringLengthIsNotEqual()
    {
        $equal = $this->create('abcde')->equals('abc');
        $this->assertFalse($equal);
    }
    
    /**
     * Ensures that equals() returns false if teh compared string have the
     * same length, but their content differs.
     */
    public function testEqualsReturnsFalseIfStringContentDiffers()
    {
        $equal = $this->create('abc')->equals('cba');
        $this->assertFalse($equal);
    }
    
    /**
     * Checks if length() returns an integer.
     */
    public function testLengthReturnsInteger()
    {
        $length = $this->create('abcde')->length();
        $this->assertInternalType('integer', $length);
    }
    
    /**
     * Checks if length() returns the number of characters.
     */
    public function testLengthReturnsCorrectValue()
    {
        $length = $this->create('abcde')->length();
        $this->assertEquals(5, $length);
    }
    
    /**
     * Ensures that length() returns the correct number of characters even
     * if the string contains multi-byte characters.
     */
    public function testLengthReturnsCorrectValueIfStringContainsUmlauts()
    {
        $length = $this->create('äbcöü')->length();
        $this->assertEquals(5, $length);
    }
    
    /**
     * Ensures that lengthInBytes() returns an integer.
     */
    public function testLengthInBytesReturnsInteger()
    {
        $bytes = $this->create('abc')->lengthInBytes();
        $this->assertInternalType('integer', $bytes);
    }
    
    /**
     * Checks if lengthInBytes() returns the correct number of bytes.
     */
    public function testLengthInBytesReturnsCorrectValue()
    {
        $bytes = $this->create('abc')->lengthInBytes();
        $this->assertEquals(3, $bytes);
    }
    
    /**
     * Ensures that lengthInBytes() returns the correct value if the string
     * contains multi-byte characters.
     */
    public function testLengthInBytesReturnsCorrectValueIfStringContainsUmlauts()
    {
        $bytes = $this->create('äbc')->lengthInBytes();
        $this->assertEquals(4, $bytes);
    }
    
    /**
     * Checks if the string is countable.
     */
    public function testStringIsCountable()
    {
        $object = $this->create('abc');
        $this->assertInstanceOf('Countable', $object);
    }
    
    /**
     * Ensures that count() returns the same value as length().
     */
    public function testCountReturnsSameValueAsLength()
    {
        $object = $this->create('äbc');
        $this->assertEquals($object->length(), $object->count());
    }
    
    /**
     * Ensures that isEmpty() returns true if the length of the string is 0.
     */
    public function testIsEmptyReturnsTrueIfStringLengthIsZero()
    {
        $empty = $this->create('')->isEmpty();
        $this->assertTrue($empty);
    }
    
    /**
     * Ensures that isEmpty() returns true if the string contains only whitespace.
     */
    public function testIsEmptyReturnsTrueIfStringContainsOnlyWhitespace()
    {
        $empty = $this->create('   ')->isEmpty();
        $this->assertTrue($empty);
    }
    
    /**
     * Ensures that isEmpty() returns false if the string contains non-whitespace
     * characters.
     */
    public function testIsEmptyReturnsFalseIfStringContainsNonWhitespaceCharacters()
    {
        $empty = $this->create('abc ')->isEmpty();
        $this->assertFalse($empty);
    }
    
    /**
     * Checks if it is possible to cast the object to a string.
     */
    public function testCastingObjectToStringReturnsCorrectValue()
    {
        $object = $this->create('abc');
        $this->assertEquals($object->toString(), (string)$object);
    }
    
    /**
     * Ensures that contains() returns false if the string does not contain
     * the needle.
     */
    public function testContainsReturnsFalseIfStringDoesNotContainNeedle()
    {
        $result = $this->create('abc')->contains('d');
        $this->assertFalse($result);
    }
    
    /**
     * Ensures that contains() returns true if the string contains the needle.
     */
    public function testContainsReturnsTrueIfStringContainsNeedle()
    {
        $result = $this->create('abc')->contains('b');
        $this->assertTrue($result);
    }
    
    /**
     * Ensures that contains() returns true if string and needle are equal.
     */
    public function testContainsReturnsTrueIfStringEqualsNeedle()
    {
        $result = $this->create('abc')->contains('abc');
        $this->assertTrue($result);
    }
    
    /**
     * Ensures that contains() returns true if a list of needles is provided and
     * the string contains at least one needle in the list.
     */
    public function testContainsReturnsTrueIfStringContainsAtLeastOneOfTheNeedles()
    {
        $result = $this->create('abc')->contains(array('d', 'a'));
        $this->assertTrue($result);
    }
    
    /**
     * Ensures that contains() returns false if a list of needles is provided
     * and the string does not contain any of the needles.
     */
    public function testContainsReturnsFalseIfStringContainsNoneOfTheNeedles()
    {
        $result = $this->create('abc')->contains(array('d', 'f'));
        $this->assertFalse($result);
    }
    
    /**
     * Checks if reverse() inverts the order of characters.
     */
    public function testReverseInvertsCharacterOrder()
    {
        $inverted = $this->create('abc')->reverse();
        $this->assertStringObject($inverted);
        $this->assertEquals('cba', $inverted->toString());
    }
    
    /**
     * Checks if reverse() can handle multi-byte characters.
     */
    public function testReverseSupportsMultiByteCharacters()
    {
        $inverted = $this->create('äöü')->reverse();
        $this->assertStringObject($inverted);
        $this->assertEquals('üöä', $inverted->toString());
    }
    
    /**
     * Checks if splitAt() returns an array.
     */
    public function testSplitAtReturnsArray()
    {
        $parts = $this->create('hello splitted world')->splitAt(' ');
        $this->assertInternalType('array', $parts);
    }
    
    /**
     * Ensures that splitAt() returns the correct parts of the string.
     */
    public function testSplitAtReturnsCorrectPartsOfString()
    {
        $parts = $this->create('hello splitted world')->splitAt(' ');
        $this->assertInternalType('array', $parts);
        $this->assertContains('hello', $parts);
        $this->assertContains('splitted', $parts);
        $this->assertContains('world', $parts);
    }
    
    /**
     * Checks if splitAt() returns the expected number of string parts.
     */
    public function testSplitAtReturnsExpectedNumberOfParts()
    {
        $parts = $this->create('hello splitted world')->splitAt(' ');
        $this->assertInternalType('array', $parts);
        $this->assertEquals(3, count($parts));
    }
    
    /**
     * Checks if splitAt() respected the provided limit.
     */
    public function testSplitAtRespectsLimit()
    {
        $parts = $this->create('hello splitted world')->splitAt(' ', 2);
        $this->assertInternalType('array', $parts);
        $this->assertEquals(2, count($parts));
    }
    
    /**
     * Ensures that the last part in the list that is returned by splitAt()
     * contains the rest of the string if a limit was provided as second
     * argument.
     */
    public function testSplitAtReturnsRestOfStringAsLastPartIfLimitIsProvided()
    {
        $parts = $this->create('hello splitted world')->splitAt(' ', 2);
        $this->assertInternalType('array', $parts);
        $last = array_pop($parts);
        $this->assertEquals('splitted world', $last);
    }
    
    /**
     * Ensures that compareTo() returns -1 if the string is less than the provided string.
     */
    public function testCompareToReturnsMinusOneIfStringIsLessThanComparedString()
    {
        $result = $this->create('a')->compareTo('c');
        $this->assertEquals(-1, $result);
    }
    
    /**
     * Ensures that compareTo() returns 0 if the compared strings are equal.
     */
    public function testCompareToReturnsZeroIfStringsAreEqual()
    {
        $result = $this->create('a')->compareTo('a');
        $this->assertEquals(0, $result);
    }
    
    /**
     * Ensures that compareTo() returns 1 if the string is greater than the provided string.
     */
    public function testCompareToReturnsOneIfStringIsGreaterThanComparedString()
    {
        $result = $this->create('c')->compareTo('a');
        $this->assertEquals(1, $result);
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
