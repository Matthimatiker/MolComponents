<?php

/**
 * Mol_DataType_String
 *
 * @category PHP
 * @package Mol_DataType
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 14.06.2012
 */

/**
 * Class that simplifies string handling.
 *
 * @category PHP
 * @package Mol_DataType
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 14.06.2012
 */
class Mol_DataType_String implements IteratorAggregate, Countable
{
    
    /**
     * Constant for the name of the UTF-8 charset.
     *
     * @var string
     */
    const CHARSET_UTF8 = 'UTF-8';
    
    /**
     * Constant for the name of the ISO-8859-1 charset.
     *
     * @var string
     */
    const CHARSET_LATIN1 = 'ISO-8859-1';
    
    /**
     * Creates a string object from the given raw string.
     *
     * It is assumed that the string uses the mentioned charset.
     *
     * @param string $string The raw string.
     * @param string $charset The charset of the string.
     * @return Mol_DataType_String
     */
    public static function create($string, $charset = 'UTF-8')
    {
        
    }
    
    /**
     * Creates a string object
     *
     * @param string $string The raw string.
     * @param string $charset The charset of the string.
     */
    protected function __construct($string, $charset)
    {
        
    }
    
    /**
     * Returns the current charset of the string.
     *
     * @return string
     */
    public function getCharset()
    {
    
    }
    
    /**
     * Converts the string into the requested charset.
     *
     * The current string object is not modified, but a new one
     * that uses the requested charset is created.
     *
     * @param string $charset
     * @return Mol_DataType_String The string in the requested charset.
     */
    public function convertTo($charset)
    {
    
    }
    
    /**
     * Returns the index of the first occurrence of $needle.
     *
     * If $needle was not found then -1 will be returned.
     * If provided as second argument then the search will
     * begin at the given index.
     *
     * @param string $needle
     * @param integer $fromIndex
     * @return integer Index or -1 if $needle was not found.
     */
    public function indexOf($needle, $fromIndex = 0)
    {
        
    }
    
    /**
     * Returns the index of the last occurrence of $needle.
     *
     * If $needle was not found then -1 will be returned.
     * The search is performed from right to left.
     * If $fromIndex is provided then the search will begin at that index.
     *
     * @param string $needle
     * @param integer|null $fromIndex
     * @return integer Index or -1 if $needle was not found.
     */
    public function lastIndexOf($needle, $fromIndex = null)
    {
        
    }
    
    /**
     * Returns the indexes of all occurrences of $needle.
     *
     * @param string $needle
     * @return array(integer)
     */
    public function indexesOf($needle)
    {
        
    }
    
    /**
     * Checks if the string starts with the provided prefix.
     *
     * @param string $prefix
     * @return boolean True if the string starts with the prefix, false otherwise.
     */
    public function startsWith($prefix)
    {
    
    }
    
    /**
     * Checks if the string ends with the provided suffix.
     *
     * @param string $suffix
     * @return boolean True if the string ends with the suffix, false otherwise.
     */
    public function endsWith($suffix)
    {
    
    }
    
    /**
     * Removes the given prefix from the string.
     *
     * This method has no effect if the string does not start with $prefix.
     *
     * @param string $prefix
     * @return Mol_DataType_String String without prefix.
     */
    public function removePrefix($prefix)
    {
    
    }
    
    /**
     * Removes the given suffix from the string.
     *
     * This method has no effect if the string does not end with $suffix.
     *
     * @param string $suffix
     * @return Mol_DataType_String String without suffix.
     */
    public function removeSuffix($suffix)
    {
    
    }
    
    /**
     * Replaces all occurrences of $search by $replace.
     *
     * This method provides 3 signatures:
     *
     * replace(string, string):
     * <code>
     * $result = $myString->replace('search', 'replace');
     * </code>
     * Replaces all occurrences of "search" by "replace".
     *
     * replace(array(string), string):
     * <code>
     * $needles = array(
     *     'first',
     *     'seconds'
     * );
     * $result = $myString->replace($needles, 'replace');
     * </code>
     * Replaces all string that are contained in the $needles array by "replace".
     *
     * replace(array(string=>string)):
     * <code>
     * $mapping = array(
     *     'first' => 'last',
     *     'hello' => 'world'
     * );
     * $result = $myString->replace($mapping);
     * </code>
     * Expects an associative array that represents a mapping of strings
     * as argument.
     * The keys are replaced by the assigned values.
     * In this example occurences of "first" are replaced by "last" and
     * "hello" is replaced by "world".
     *
     * @param string|array(string)|array(string|string) $searchOrMapping
     * @param string $replace
     * @return Mol_DataType_String The string with applied replacements.
     */
    public function replace($searchOrMapping, $replace = null)
    {
    
    }
    
    /**
     * Extracts the requested substring.
     *
     * Starts at $startIndex and extracts $length characters.
     * If $length is not provided then the substring will
     * extend to the end of the string.
     *
     * @param integer $startIndex The start index.
     * @param integer|null $length The length in characters.
     * @return Mol_DataType_String The substring.
     */
    public function subString($startIndex, $length = null)
    {
    
    }
    
    /**
     * Converts all characters in the string to upper case.
     *
     * @return Mol_DataType_String The string with upper case characters.
     */
    public function toUpperCase()
    {
        
    }
    
    /**
     * Converts all characters in the string to lower case.
     *
     * @return Mol_DataType_String The string with lower case characters.
     */
    public function toLowerCase()
    {
        
    }
    
    /**
     * Removes the provided characters from start and end of the string.
     *
     * @param string $characters
     * @return Mol_DataType_String The string without leading and trailing characters.
     */
    public function trim($characters = null)
    {
        
    }
    
    /**
     * Removes the provided characters from the start of the string.
     *
     * @param string $characters
     * @return Mol_DataType_String The string without leading characters.
     */
    public function trimLeft($characters = null)
    {
        
    }
    
    /**
     * Removes the provided characters from the end of the string.
     *
     * @param string $characters
     * @return Mol_DataType_String The string without trailing characters.
     */
    public function trimRight($characters = null)
    {
        
    }
    
    /**
     * Converts the string into an array of characters.
     *
     * @return array(string) The characters in order of occurrence in the string.
     */
    public function toCharacters()
    {
    
    }
    
    /**
     * Allows iterating through the characters of the string.
     *
     * @return Traversable
     */
    public function getIterator()
    {
        
    }
    
    /**
     * Checks if the strings are equal.
     *
     * @param string $string
     * @return boolean True if the strings are equal, false otherwise.
     */
    public function equals($string)
    {
        
    }
    
    /**
     * Returns the length of the string in characters.
     *
     * @return integer
     */
    public function length()
    {
    
    }
    
    /**
     * Returns the length of the string in bytes.
     *
     * Some charsets require more than 1 byte to store a character,
     * therefore length() and lengthInBytes() do not have to be equal.
     *
     * @return integer
     */
    public function lengthInBytes()
    {
    
    }
    
    /**
     * Alias of length().
     *
     * Allows to obtain the string length by using count():
     * <code>
     * $length = count($myStringObject);
     * </code>
     *
     * @return integer
     */
    public function count()
    {
        
    }
    
    /**
     * Checks if the string is empty.
     *
     * A string is empty if its length is 0 or it contains only whitespace.
     *
     * @return boolean True if the string is empty, false otherwise.
     */
    public function isEmpty()
    {
    
    }
    
    /**
     * Returns the raw string (no string object).
     *
     * @return string
     */
    public function toString()
    {
    
    }
    
    /**
     * Alias of toString().
     *
     * Allows for outputting string objects directly:
     * <code>
     * echo $myStringObject;
     * </code>
     *
     * @return string
     */
    public function __toString()
    {
        
    }
    
}