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
     * Identifier for failure message if data of invalid type was passed.
     *
     * @var string
     */
    const INVALID = 'suffixInvalidType';
    
    /**
     * Identifier for failure message if value does not end with any
     * of the allowed suffixes.
     *
     * @var string
     */
    const NO_SUFFIX = 'suffixNoAllowedSuffix';
    
    /**
     * Failure message templates.
     *
     * @var array(string=>string)
     */
    protected $_messageTemplates = array(
        self::INVALID   => "Invalid data type provided, expected string",
        self::NO_SUFFIX => "'%value%' must end with one of the following suffixes: %suffixes%"
    );
    
    /**
     * Mapping of variables that can be used in failure messages.
     *
     * @var array(string=>string)
     */
    protected $_messageVariables = array(
        'suffixes'  => 'suffixes'
    );
    
    /**
     * A list of accepted suffixes.
     *
     * @var array(string)
     */
    protected $suffixes = null;
    
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
