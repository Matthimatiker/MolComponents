<?php

/**
 * Mol_Validate_Suffix
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 28.06.2012
 */

/**
 * Validator that checks if a value ends with an accepted suffix.
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 28.06.2012
 * @property string $suffixes Comma-separated list of accepted suffixes.
 */
class Mol_Validate_Suffix extends Zend_Validate_Abstract
{
    
    /**
     * Creates a validator that accepts the provided suffixes.
     *
     * @param array(string)|string $suffixesOrSuffix List of suffixes or a single suffix.
     * @throws InvalidArgumentException If an invalid suffix parameter is provided.
     */
    public function __construct($suffixesOrSuffix = array())
    {
        
    }
    
    /**
     * Checks if the value ends with an accepted suffix.
     *
     * @param string $value
     * @return boolean True if the value ends with a valid suffix, false otherwise.
     */
    public function isValid($value)
    {
        
    }
    
    /**
     * Returns a list of accepted suffixes.
     *
     * @return array(string)
     */
    public function getSuffixes()
    {
        
    }
    
    /**
     * Sets the accepted suffixes.
     *
     * @param array(string) $suffixes
     * @return Mol_Validate_Suffix Provides a fluent interface.
     */
    public function setSuffixes(array $suffixes)
    {
        
    }
    
}
