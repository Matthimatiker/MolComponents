<?php

/**
 * Mol_Form_Element_Url
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 24.03.2013
 */

/**
 * Form element that accepts a URL as input.
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 24.03.2013
 */
class Mol_Form_Element_Url extends Zend_Form_Element_Text
{
    
    /**
     * Names of the attribute that contains a list of allowed
     * hostnames if available.
     *
     * @var string
     */
    const HOSTNAMES_ATTRIBUTE = 'data-allowed-hostnames';
    
    /**
     * The validator that is used to check URLs.
     *
     * An underscore for variable declaration must be used to avoid collisions
     * with the getAttribs() method of Zend_Form_Element.
     *
     * @var Mol_Validate_Url
     */
    protected $_urlValidator = null;
    
    /**
     * Initializes filters and validators for this element.
     */
    public function init()
    {
        parent::init();
        
        $this->addFilter('StringTrim');
        
        $this->_urlValidator = new Mol_Validate_Url();
        $this->addValidator($this->_urlValidator, true);
    }
    
    /**
     * Sets hostnames that are allowed in the url.
     *
     * @param array(string) $hostnames
     * @return Mol_Form_Element_Url Provides a fluent interface.
     */
    public function setAllowedHostnames(array $hostnames)
    {
        $this->_urlValidator->setAllowedHostnames($hostnames);
        $this->setAttrib(self::HOSTNAMES_ATTRIBUTE, $this->toHostnamesAttribute($hostnames));
        return $this;
    }
    
    /**
     * Returns a list of allowed hostnames.
     *
     * @return array(string)
     */
    public function getAllowedHostnames()
    {
        return $this->_urlValidator->getAllowedHostnames();
    }
    
    /**
     * Checks if hostname restrictions are active.
     *
     * @return boolean True if the hostname is restricted, false otherwise.
     */
    public function hasHostnameRestrictions()
    {
        return $this->_urlValidator->hasHostnameRestrictions();
    }
    
    /**
     * Uses the given list of hostnames to create the value
     * of the hostnames attribute.
     *
     * @param array(string) $hostnames
     * @return string|null
     */
    protected function toHostnamesAttribute(array $hostnames)
    {
        if (count($hostnames) === 0) {
            // No hostnames available, therefore no attribute is required.
            return null;
        }
        return implode(',', $hostnames);
    }
    
}
