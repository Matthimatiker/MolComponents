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
     * Cached list of supported charsets.
     *
     * @var array(string)|null
     */
    protected static $charsets = null;
    
    /**
     * Cached mapping of accepted charset names to charsets.
     *
     * The names are used as key, the charsets as value.
     *
     * @var array(string=>string)|null
     */
    protected static $namesToCharsets = null;
    
    /**
     * The raw string value.
     *
     * @var string
     */
    protected $value = null;
    
    /**
     * The charset of the string.
     *
     * @var string
     */
    protected $charset = null;
    
    /**
     * Creates a string object from the given raw string.
     *
     * It is assumed that the string uses the mentioned charset.
     *
     * @param string $string The raw string.
     * @param string $charset The charset of the string.
     * @return Mol_DataType_String
     */
    public static function create($string, $charset = self::CHARSET_UTF8)
    {
        return new self($string, $charset);
    }
    
    /**
     * Returns all available charsets.
     *
     * @return array(string)
     */
    protected static function getCharsets()
    {
        if (self::$charsets === null) {
            self::$charsets = mb_list_encodings();
        }
        return self::$charsets;
    }
    
    /**
     * Returns a mapping of accepted charset names to charsets.
     *
     * For example "UTF-8" and "utf8" are both valid charset names.
     *
     * @return array(string=>string)
     */
    protected static function getCharsetNameMapping()
    {
        if (self::$namesToCharsets === null) {
            self::$namesToCharsets = array();
            foreach (self::getCharsets() as $charset) {
                self::$namesToCharsets[$charset] = $charset;
                foreach (mb_encoding_aliases($charset) as $alias) {
                    self::$namesToCharsets[$alias] = $charset;
                }
            }
        }
        return self::$namesToCharsets;
    }
    
    /**
     * Creates a string object
     *
     * @param string $string The raw string.
     * @param string $charset The charset of the string.
     */
    protected function __construct($string, $charset)
    {
        $this->assertCharset($charset);
        $this->assertUsesCharset($string, $charset);
        $this->value   = $string;
        $this->charset = $this->unifyCharset($charset);
    }
    
    /**
     * Returns the current charset of the string.
     *
     * @return string
     */
    public function getCharset()
    {
        return $this->charset;
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
        if ($this->charset === $charset) {
            // No conversion required.
            return $this;
        }
        $this->assertCharset($charset);
        $converted = iconv($this->charset, $charset . '//TRANSLIT', $this->value);
        return $this->createString($converted, $charset);
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
        $position = mb_strpos($this->value, $needle, $fromIndex, $this->charset);
        if ($position === false) {
            return -1;
        }
        return $position;
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
        $search = $this->value;
        if ($fromIndex !== null) {
            // Per default mb_strrpos() searches from left to right and starts at the given offset.
            // We cut of the end of the string starting at ($fromIndex + 1) to simulate searching backwards.
            $search = $this->rawSubString(0, $fromIndex + 1);
        }
        $position = mb_strrpos($search, $needle, null, $this->charset);
        if ($position === false) {
            return -1;
        }
        return $position;
    }
    
    /**
     * Returns the indexes of all occurrences of $needle.
     *
     * @param string $needle
     * @return array(integer)
     */
    public function indexesOf($needle)
    {
        $offset  = 0;
        $indexes = array();
        while (($position = $this->indexOf($needle, $offset)) !== -1) {
            $indexes[] = $position;
            // Search after current match in next iteration.
            $offset = $position + 1;
        }
        return $indexes;
    }
    
    /**
     * Checks if the string starts with the provided prefix.
     *
     * @param string $prefix
     * @return boolean True if the string starts with the prefix, false otherwise.
     */
    public function startsWith($prefix)
    {
        return strpos($this->value, $prefix) === 0;
    }
    
    /**
     * Checks if the string ends with the provided suffix.
     *
     * @param string $suffix
     * @return boolean True if the string ends with the suffix, false otherwise.
     */
    public function endsWith($suffix)
    {
        $expectedPosition = $this->lengthInBytes() - $this->getLengthInBytes($suffix);
        return strrpos($this->value, $suffix) === $expectedPosition;
    }
    
    /**
     * Checks if the string contains the provided needle.
     *
     * If an array of strings is provided then contains() will check
     * if the string contains at least one of the needles.
     *
     * @param string|array(string) $needle A single or multiple needles.
     * @return boolean True if the string contains the needle, false otherwise.
     */
    public function contains($needle)
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
        if (!$this->startsWith($prefix)) {
            // Nothing to remove.
            return $this;
        }
        $withoutPrefix = substr($this->value, $this->getLengthInBytes($prefix));
        return $this->createString($withoutPrefix);
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
        if (!$this->endsWith($suffix)) {
            // Nothing to remove.
            return $this;
        }
        $withoutSuffix = substr($this->value, 0, $this->lengthInBytes() - $this->getLengthInBytes($suffix));
        return $this->createString($withoutSuffix);
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
        $search = $searchOrMapping;
        if ($replace === null && is_array($searchOrMapping)) {
            // Mapping provided.
            $search  = array_keys($searchOrMapping);
            $replace = array_values($searchOrMapping);
        }
        $replaced = str_replace($search, $replace, $this->value);
        return $this->createString($replaced);
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
        $subString = $this->rawSubString($startIndex, $length);
        return $this->createString($subString);
    }
    
    /**
     * Extracts the requested substring.
     *
     * Returns the result as simple string, not as object.
     *
     * @param integer $startIndex The start index.
     * @param integer|null $length The length in characters.
     * @return string The substring.
     */
    protected function rawSubString($startIndex, $length = null)
    {
        if ($length === null) {
            // Use a length that cannot be reached by the substring to
            // ensure that it is extended to the end of the original
            // string.
            $length = $this->lengthInBytes();
        }
        return mb_substr($this->value, $startIndex, $length, $this->charset);
    }
    
    /**
     * Converts all characters in the string to upper case.
     *
     * @return Mol_DataType_String The string with upper case characters.
     */
    public function toUpperCase()
    {
        $upper = mb_strtoupper($this->value, $this->charset);
        return $this->createString($upper);
    }
    
    /**
     * Converts all characters in the string to lower case.
     *
     * @return Mol_DataType_String The string with lower case characters.
     */
    public function toLowerCase()
    {
        $lower = mb_strtolower($this->value, $this->charset);
        return $this->createString($lower);
    }
    
    /**
     * Removes the provided characters from start and end of the string.
     *
     * @param string $characters
     * @return Mol_DataType_String The string without leading and trailing characters.
     */
    public function trim($characters = null)
    {
        $trimmed = $this->applyTrim('trim', $characters);
        return $this->createString($trimmed);
    }
    
    /**
     * Removes the provided characters from the start of the string.
     *
     * @param string $characters
     * @return Mol_DataType_String The string without leading characters.
     */
    public function trimLeft($characters = null)
    {
        $trimmed = $this->applyTrim('ltrim', $characters);
        return $this->createString($trimmed);
    }
    
    /**
     * Removes the provided characters from the end of the string.
     *
     * @param string $characters
     * @return Mol_DataType_String The string without trailing characters.
     */
    public function trimRight($characters = null)
    {
        $trimmed = $this->applyTrim('rtrim', $characters);
        return $this->createString($trimmed);
    }
    
    /**
     * Returns the reversed string.
     *
     * @return Mol_DataType_String
     */
    public function reverse()
    {
    
    }
    
    /**
     * Splits the string by using the provided delimiter.
     *
     * @param string $delimiter
     * @param integer|null $limit Maximal number of parts.
     * @return array(string)
     */
    public function splitAt($delimiter, $limit = null)
    {
        
    }
    
    /**
     * Converts the string into an array of characters.
     *
     * @return array(string) The characters in order of occurrence in the string.
     */
    public function toCharacters()
    {
        $characters = array();
        $length     = $this->length();
        for ($i = 0; $i < $length; $i++) {
            $characters[] = $this->rawSubString($i, 1);
        }
        return $characters;
    }
    
    /**
     * Allows iterating through the characters of the string.
     *
     * @return Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->toCharacters());
    }
    
    /**
     * Checks if the strings are equal.
     *
     * @param string $string
     * @return boolean True if the strings are equal, false otherwise.
     */
    public function equals($string)
    {
        return $this->value === $string;
    }
    
    /**
     * Returns the length of the string in characters.
     *
     * @return integer
     */
    public function length()
    {
        return mb_strlen($this->value, $this->charset);
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
        return $this->getLengthInBytes($this->value);
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
        return $this->length();
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
        return trim($this->value) === '';
    }
    
    /**
     * Compares this string with $other.
     *
     * @param string $other
     * @return integer
     */
    public function compareTo($other)
    {
        
    }
    
    /**
     * Returns the raw string (no string object).
     *
     * @return string
     */
    public function toString()
    {
        return $this->value;
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
        return $this->toString();
    }
    
    /**
     * Creates a new string object with the provided charset.
     *
     * If the charset is omitted then the current charset will be used.
     *
     * @param string $string
     * @param string|null $charset
     * @return Mol_DataType_String
     */
    protected function createString($string, $charset = null)
    {
        if ($charset === null) {
            $charset = $this->charset;
        }
        return self::create($string, $charset);
    }
    
    /**
     * Returns the length in bytes of the provided string.
     *
     * @param string $string
     * @return integer The length in bytes.
     */
    protected function getLengthInBytes($string)
    {
        return strlen($string);
    }
    
    /**
     * Applies a trim function (trim(), rtrim() or ltrim()) to the raw
     * string value and returns the result.
     *
     * Example:
     * <code>
     * $trimFunction = $this->applyTrim('rtrim', 'a');
     * </code>
     *
     * If $characters is null then whitespace will be trimmed.
     *
     * @param string $trimFunction The name of the trim function.
     * @param string|null $characters The characters that will be trimmed.
     */
    protected function applyTrim($trimFunction, $characters)
    {
        $arguments = array($this->value);
        if ($characters !== null) {
            $arguments[] = $characters;
        }
        return call_user_func_array($trimFunction, $arguments);
    }
    
    /**
     * Asserts that $charset is an available charset.
     *
     * @param string $charset
     * @throws InvalidArgumentException If an invalid charset is provided.
     */
    protected function assertCharset($charset)
    {
        $namesToCharsets = self::getCharsetNameMapping();
        if (isset($namesToCharsets[$charset])) {
            // Charset is valid.
            return;
        }
        $format  = '"%s" is not a valid charset. The following charsets are supported: %s';
        $message = sprintf($format, $charset, implode(', ', self::getCharsets()));
        throw new InvalidArgumentException($message);
    }
    
    /**
     * Maps charset aliases to charset names.
     *
     * The provided charset name must be valid.
     *
     * @param string $charset
     * @return string
     */
    protected function unifyCharset($charset)
    {
        $namesToCharsets = self::getCharsetNameMapping();
        return $namesToCharsets[$charset];
    }
    
    /**
     * Asserts that the string uses the given charset.
     *
     * Please note:
     * It is only checked if the provided string is a valid byte sequence
     * in the provided encoding.
     *
     * @param string $string
     * @param string $charset
     * @throws InvalidArgumentException If the string cannot be represented in the provided charset.
     */
    protected function assertUsesCharset($string, $charset)
    {
        if (mb_detect_encoding($string, $charset, true) === false) {
            $message = 'String is not encoded as "' . $charset . '".';
            throw new InvalidArgumentException($message);
        }
    }
    
}
