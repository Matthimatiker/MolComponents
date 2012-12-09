<?php

/**
 * Mol_Validate_Suffix
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 28.06.2012
 */

/**
 * Validator that checks if a value ends with an accepted suffix.
 *
 * # Usage #
 *
 * Multiple allowed suffixes can be passed to the constructor:
 *
 *     $allowed   = array('.txt', '.doc');
 *     $validator = new Mol_Validate_Suffix($allowed);
 *
 * A single suffix is also allowed as constructor arguments:
 *
 *     $validator = new Mol_Validate_Suffix('.txt');
 *
 * The method setSuffixes() may be used to change the allowed
 * suffixes after creation:
 *
 *     $validator = new Mol_Validate_Suffix('.txt');
 *     $validator->setSuffixes('.png', '.jpg');
 *
 * The validator accepts only strings that end with an allowed suffix:
 *
 *     $validator = new Mol_Validate_Suffix('.txt');
 *     // Returns true:
 *     $validator->isValid('test.txt');
 *     // Returns false:
 *     $validator->isValid('test.pdf');
 *
 * The validator will accept any string if the list of allowed
 * suffixes is empty:
 *
 *     $validator = new Mol_Validate_Suffix(array());
 *     // Returns true:
 *     $validator->isValid('test.pdf');
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 28.06.2012
 * @property string $allowedSuffixes Comma-separated list of accepted suffixes.
 */
class Mol_Validate_Suffix extends Zend_Validate_Abstract
{
    
    /**
     * Identifier for failure message if data of invalid type was passed.
     *
     * @var string
     */
    const INVALID_TYPE = 'suffixInvalidType';
    
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
        self::INVALID_TYPE => "Invalid data type provided, expected string",
        self::NO_SUFFIX    => "'%value%' must end with one of the following suffixes: %allowedSuffixes%"
    );
    
    /**
     * Mapping of variables that can be used in failure messages.
     *
     * @var array(string=>string)
     */
    protected $_messageVariables = array(
        'allowedSuffixes' => 'allowedSuffixes'
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
        if (is_string($suffixesOrSuffix)) {
            // Single suffix provided.
            $suffixesOrSuffix = array($suffixesOrSuffix);
        }
        if (!is_array($suffixesOrSuffix)) {
            $message = 'Expected list of suffixes (array) or single suffix (string).';
            throw new InvalidArgumentException($message);
        }
        $this->suffixes = $suffixesOrSuffix;
    }
    
    /**
     * Checks if the value ends with an accepted suffix.
     *
     * @param string $value
     * @return boolean True if the value ends with a valid suffix, false otherwise.
     */
    public function isValid($value)
    {
        $this->_setValue($value);
        if (!is_string($value)) {
            $this->_error(self::INVALID_TYPE);
            return false;
        }
        if (count($this->suffixes) === 0) {
            // We do not have any suffix to check against,
            // therefore we accept any string.
            return true;
        }
        if (!$this->endsWithSuffix($value)) {
            $this->_error(self::NO_SUFFIX);
            return false;
        }
        return true;
    }
    
    /**
     * Checks if the value ends with an allowed suffix.
     *
     * @param string $value
     * @return boolean True if the value ends with a suffix, false otherwise.
     */
    protected function endsWithSuffix($value)
    {
        foreach ($this->suffixes as $suffix) {
            /* @var $suffix string */
            if (Mol_Util_String::endsWith($value, $suffix)) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Returns a list of accepted suffixes.
     *
     * @return array(string)
     */
    public function getSuffixes()
    {
        return $this->suffixes;
    }
    
    /**
     * Sets the accepted suffixes.
     *
     * @param array(string) $suffixes
     * @return Mol_Validate_Suffix Provides a fluent interface.
     */
    public function setSuffixes(array $suffixes)
    {
        $this->suffixes = $suffixes;
        return $this;
    }
    
    /**
     * Provides access to additional magic properties that
     * can be used in failure messages.
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property)
    {
        if ($property === 'allowedSuffixes') {
            return $this->createEnumerationOfSuffixes();
        }
        return parent::__get($property);
    }
    
    /**
     * Creates a comma separated list of allowed suffixes
     * for usage in failure messages.
     *
     * @return string
     */
    protected function createEnumerationOfSuffixes()
    {
        $suffixes = array_map(array($this, 'wrapInQuotes'), $this->suffixes);
        return implode(', ', $suffixes);
    }
    
    /**
     * Wraps the value in single quotes.
     *
     * @param string $value
     * @return string The value in quotes.
     */
    protected function wrapInQuotes($value)
    {
        return "'$value'";
    }
    
}
