<?php

/**
 * Mol_Util_String
 *
 * @category PHP
 * @package Mol_Util
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 21.06.2012
 */

/**
 * Contains helper methods for string handling.
 *
 * This class contains lightweight helper methods that simplify string handling.
 * All operations are independent of the underlying charset of the subject string.
 * If you need to perform actions that depend on the charset, then try to use
 * Mol_DataType_String as it includes charset handling.
 *
 * @category PHP
 * @package Mol_Util
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 21.06.2012
 */
class Mol_Util_String
{
    
    /**
     * Checks if the string starts with the provided prefix.
     *
     * @param string $subject The tested string.
     * @param string $prefix
     * @return boolean True if the string starts with the prefix, false otherwise.
     */
    public static function startsWith($subject, $prefix)
    {
        
    }
    
    /**
     * Checks if the string ends with the provided suffix.
     *
     * @param string $subject The tested string.
     * @param string $suffix
     * @return boolean True if the string ends with the suffix, false otherwise.
     */
    public static function endsWith($subject, $suffix)
    {
        
    }
    
    /**
     * Checks if the string contains the provided needle.
     *
     * @param string $subject The tested string.
     * @param string $needle
     * @return boolean True if the string contains the needle, false otherwise.
     */
    public static function contains($subject, $needle)
    {
        
    }
    
    /**
     * Checks if the string contains any of the provided needles.
     *
     * @param string $subject The tested string.
     * @param array(string) $needles
     * @return boolean True if the string contains a needle, false otherwise.
     */
    public static function containsAny($subject, array $needles)
    {
    }
    
    /**
     * Checks if the string contains all of the provided needles.
     *
     * @param string $subject The tested string.
     * @param array(string) $needles
     * @return boolean True if the string contains all needles, false otherwise.
     */
    public static function containsAll($subject, array $needles)
    {
        
    }
    
    /**
     * Replaces all occurrences of $searchOrMapping by $replace.
     *
     * This method provides 3 signatures:
     *
     * replace(string, string, string):
     * <code>
     * $result = Mol_Util_String::replace('my string', 'search', 'replace');
     * </code>
     * Replaces all occurrences of "search" by "replace".
     *
     * replace(string, array(string), string):
     * <code>
     * $needles = array(
     *     'first',
     *     'seconds'
     * );
     * $result = Mol_Util_String::replace('my string', $needles, 'replace');
     * </code>
     * Replaces all string that are contained in the $needles array by "replace".
     *
     * replace(string, array(string=>string)):
     * <code>
     * $mapping = array(
     *     'first' => 'last',
     *     'hello' => 'world'
     * );
     * $result = Mol_Util_String::replace('my string', $mapping);
     * </code>
     * Expects an associative array that represents a mapping of strings
     * as argument.
     * The keys are replaced by the assigned values.
     * In this example occurences of "first" are replaced by "last" and
     * "hello" is replaced by "world".
     *
     * @param string $subject
     * @param string|array(integer|string=>string) $searchOrMapping
     * @param string $replace
     * @return string The string with applied replacements.
     */
    public static function replace($subject, $searchOrMapping, $replace = null)
    {
        
    }
    
}
