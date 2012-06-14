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
class Mol_DataType_String implements Countable
{
    
    /**
     * Creates a string object from the given raw string.
     *
     * It is assumed that the string uses the mentioned charset.
     *
     * @param string $string The raw string.
     * @param string $charset The charset of the string.
     * @return Mol_DataType_String
     */
    public static function createFrom($string, $charset)
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
     * @return Mol_DataType_String
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
    
    public function lastIndexOf($needle, $fromIndex = null)
    {
        
    }
    
    public function indexesOf($needle)
    {
        
    }
    
    public function startsWith($string)
    {
    
    }
    
    public function endsWith($string)
    {
    
    }
    
    public function removeFromStart($string)
    {
    
    }
    
    public function removeFromEnd($string)
    {
    
    }
    
    public function replace($search, $replace)
    {
    
    }
    
    public function substring($start, $length)
    {
    
    }
    
    public function toUpperCase()
    {
        
    }
    
    public function toLowerCase()
    {
        
    }
    
    public function trim($chars)
    {
        
    }
    
    public function trimLeft($chars)
    {
        
    }
    
    public function trimRight($chars)
    {
        
    }
    
    public function toCharacters()
    {
    
    }
    
    public function equals($string)
    {
        
    }
    
    public function length()
    {
    
    }
    
    public function lengthInBytes()
    {
    
    }
    
    public function count()
    {
        
    }
    
    public function isEmpty()
    {
    
    }
    
    public function toString()
    {
    
    }
    
    public function __toString()
    {
        
    }
    
}