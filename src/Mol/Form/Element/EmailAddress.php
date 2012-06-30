<?php

/**
 * Mol_Form_Element_EmailAddress
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 29.06.2012
 */

/**
 * Pre-configured form element that accepts email addresses.
 *
 * == Usage ==
 *
 * The element can simply be added to any Zend_Form, no further configuration
 * is required:
 * <code>
 * $email = new Mol_Form_Element_EmailAddress('email');
 * $email->setLabel('Email address');
 * $form->addElement($email);
 * </code>
 *
 * Without further configuration the element will accept only
 * valid email addresses:
 * <code>
 * // Returns true:
 * $element->isValid('matthias@matthimatiker.de');
 * // Returns false:
 * $element->isValid('hello');
 * </code>
 *
 * Optionally the accepted hostnames can be restricted by providing
 * a whitelist:
 * <code>
 * $element->setAcceptedHostnames(array('matthimatiker.de'));
 * // Returns true:
 * $element->isValid('matthias@matthimatiker.de');
 * // Returns false:
 * $element->isValid('matthias@another-hostname.org');
 * </code>
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 29.06.2012
 */
class Mol_Form_Element_EmailAddress extends Zend_Form_Element_Text
{
    
    /**
     * Validator that is used to check against a list of allowed hostnames.
     *
     * We have to use a underscore for attribute declaration to avoid collisions
     * with the getAttribs() method of Zend_Form_Element.
     *
     * @var Mol_Validate_Suffix
     */
    protected $_hostnameValidator = null;
    
    /**
     * Initializes the filters and validators for this element.
     */
    public function init()
    {
        $this->addFilter('StringTrim');
        $this->addValidator('EmailAddress', true);
        $this->_hostnameValidator = new Mol_Validate_Suffix();
        $this->addValidator($this->_hostnameValidator, true);
    }
    
    /**
     * Sets the allowed hostnames.
     *
     * Example:
     * <code>
     * $element->setHostnames(array('example.com', 'example.org));
     * </code>
     *
     * If an empty array is provided then the current hostname
     * restrictions are removed.
     *
     * @param array(string) $hostnames
     * @return Mol_Form_Element_EmailAddress Provides a fluent interface.
     */
    public function setAllowedHostnames(array $hostnames)
    {
        $suffixes = $this->toSuffixes($hostnames);
        $this->_hostnameValidator->setSuffixes($suffixes);
        return $this;
    }
    
    /**
     * Returns the allowed hostnames.
     *
     * An empty array the hostname is not restricted.
     *
     * @return array(string)
     */
    public function getAllowedHostnames()
    {
        $suffixes = $this->_hostnameValidator->getSuffixes();
        return $this->toHostnames($suffixes);
    }
    
    /**
     * Checks if hostname restrictions are applied.
     *
     * @return boolean True if hostname restrictions are active, false otherwise.
     */
    public function hasHostnameRestrictions()
    {
        return count($this->getAllowedHostnames()) > 0;
    }
    
    /**
     * Returns the provided email address.
     *
     * Returns null if no address was provided.
     *
     * @return string|null A valid email address or null.
     */
    public function getEmailAddress()
    {
        $value = $this->getValue();
        if (empty($value)) {
            return null;
        }
        if (!$this->isValidEmailAddress($value)) {
            return null;
        }
        return $value;
    }
    
    /**
     * Checks if the provided value is a valid email address.
     *
     * An address is valid if it fulfills all validation rules of the element.
     * The state of the element itself is not changed by this method.
     *
     * @param string $value
     * @return boolean True if a valid address is provided, false otherwise.
     */
    protected function isValidEmailAddress($value)
    {
        $rules = new Zend_Validate();
        foreach ($this->getValidators() as $validator) {
            /* @var $validator Zend_Validate_Interface */
            $rules->addValidator($validator, true);
        }
        return $rules->isValid($value);
    }
    
    /**
     * Converts the provided suffixes to hostnames by removing
     * the leading "@" characters.
     *
     * @param array(string) $suffixes
     * @return array(string) The hostnames.
     */
    protected function toHostnames(array $suffixes)
    {
        return array_map(array($this, 'removeLeadingAtCharacter'), $suffixes);
    }
    
    /**
     * Converts the provided hostnames to suffixes that may be used
     * for validation by adding a leading "@" character.
     *
     * @param array(string) $hostnames
     * @return array(string) The suffixes.
     */
    protected function toSuffixes(array $hostnames)
    {
        // Unify provided hostnames...
        $hostnames = $this->toHostnames($hostnames);
        // ... and convert them to valid suffixes.
        return array_map(array($this, 'addLeadingAtCharacter'), $hostnames);
    }
    
    /**
     * Removes leading "@" characters from the provided string.
     *
     * @param string $value
     * @return string The value without leading "@" character.
     */
    protected function removeLeadingAtCharacter($value)
    {
        return ltrim($value, '@');
    }
    
    /**
     * Adds an "@" character to the start of the provided string.
     *
     * @param string $value
     * @return string The value with leading "@" character.
     */
    protected function addLeadingAtCharacter($value)
    {
        return '@' .  $value;
    }
    
}
