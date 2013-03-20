<?php

/**
 * Mol_Validate_Url
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 11.03.2013
 */

/**
 * Validator that checks URLs.
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 11.03.2013
 */
class Mol_Validate_Url extends Zend_Validate_Abstract
{
    
    /**
     * Key for failure message which indicates that a non-string
     * value was provided.
     *
     * @var string
     */
    const FAILURE_INVALID = 'urlInvalid';
    
    /**
     * Key for failure message which indicates that the validated
     * value is no absolute url.
     *
     * @var string
     */
    const FAILURE_NO_URL = 'urlNoUrl';
    
    /**
     * Default failure messages.
     *
     * @var array(string)
     */
    protected $_messageTemplates = array(
        self::FAILURE_INVALID => "Invalid type given. String expected, but received %value%",
        self::FAILURE_NO_URL  => "'%value%' is no absolute URL"
    );
    
    /**
     * Checks if $value is an absolute URL.
     *
     * @param mixed $value
     * @return boolean
     */
    public function isValid($value)
    {
        $this->_setValue($value);
        if (!is_string($value)) {
            $this->_error(self::FAILURE_INVALID, Mol_Util_Stringifier::stringify($value));
            return false;
        }
        if (!Zend_Uri_Http::check($value)) {
            $this->_error(self::FAILURE_NO_URL);
            return false;
        }
        return true;
    }
    
    /**
     * Sets a list of accepted hostnames.
     *
     * The url is only valid if its hostname is listed in this whitelist.
     * The "*" character can be used as wildcard:
     *
     *     $validHostnames = array(
     *         'github.com',
     *         'gist.github.com',
     *         '*.matthimatiker.de'
     *     );
     *     $validator->setAcceptedHostnames($validHostnames).
     *
     * Per default every hostnam is accepted.
     *
     * @param array(string) $hostnames
     * @return Mol_Validate_Url Provides a fluent interface.
     */
    public function setAcceptedHostnames(array $hostnames)
    {
        
    }
    
    /**
     * Returns a list of accepted hostnames.
     *
     * Hostnames may contain wildcards ("*").
     *
     * @return array(string)
     */
    public function getAcceptedHostnames()
    {
        
    }
    
}
