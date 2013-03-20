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
     * value is no absolute URL.
     *
     * @var string
     */
    const FAILURE_NO_URL = 'urlNoUrl';
    
    /**
     * Key for failure message which indicates that the hostname
     * of the validated URL was not accepted.
     *
     * @var string
     */
    const FAILURE_HOSTNAME_NOT_ACCEPTED = 'urlHostnameNotAccepted';
    
    /**
     * A list of expected hostnames.
     *
     * The listed hostnams may contain wildcards ("*").
     *
     * @var array(string)
     */
    protected $acceptedHostnames = array();
    
    /**
     * Default failure messages.
     *
     * @var array(string)
     */
    protected $_messageTemplates = array(
        self::FAILURE_INVALID               => "Invalid type given. String expected, but received %value%",
        self::FAILURE_NO_URL                => "'%value%' is no absolute URL",
        self::FAILURE_HOSTNAME_NOT_ACCEPTED => "'%value%' must use an accepted hostname: %acceptedHostnames%"
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
        if (!$this->hasAcceptedHostname($value)) {
            $this->_error(self::FAILURE_HOSTNAME_NOT_ACCEPTED);
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
        $this->acceptedHostnames = $hostnames;
        return $this;
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
        return $this->acceptedHostnames;
    }
    
    /**
     * Checks if hostname restrictions are active.
     *
     * @return boolean True if there are restrictions, false otherwise.
     */
    public function hasHostnameRestrictions()
    {
        return count($this->acceptedHostnames) > 0;
    }
    
    /**
     * Checks if the given URL has an accepted hostname.
     *
     * @param string $url
     * @return boolean
     */
    protected function hasAcceptedHostname($url)
    {
        if (!$this->hasHostnameRestrictions()) {
            return true;
        }
        $hostname = Zend_Uri_Http::fromString($url)->getHost();
        // Transform the hostname to be able to use fnmatch() and to
        // ensure that the wildcard "*" does not match dots (".").
        $hostname = str_replace('.', '/', $hostname);
        foreach ($this->acceptedHostnames as $acceptedHostname) {
            /* @var $acceptedHostname string */
            if (fnmatch(str_replace('.', '/', $acceptedHostname), $hostname, FNM_PATHNAME)) {
                return true;
            }
        }
        return false;
    }
    
}
