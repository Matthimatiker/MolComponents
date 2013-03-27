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
 * # Usage #
 *
 * This element can be added to any Zend_Form instance without further
 * configuration:
 *
 *     $url = new Mol_Form_Element_Url('website');
 *     $url->setLabel('Website');
 *     $form->addElement($url);
 *
 * The element accepts only absolute URLs:
 *
 *     // Returns true:
 *     $element->isValid('https://github.com/Matthimatiker/MolComponents');
 *     // Returns false:
 *     $element->isValid('/Matthimatiker/MolComponents');
 *
 * ## Hostname Restrictions ##
 *
 * Optionally the accepted hostnames can be restricted via setAllowedHostnames():
 *
 *     $element->setAllowedHostnames(array('github.com'));
 *     // Returns true:
 *     $element->isValid('https://github.com/Matthimatiker/MolComponents');
 *     // Returns false:
 *     $element->isValid('http://google.de?q=demo');
 *
 * Subdomains are not automatically accepted. Therefore, subdomains must be
 * whitelisted explicitly. Alternatively "*" can be used as wildcard:
 *
 *     $element->setAllowedHostnames(array('github.com', 'www.github.com', '*.google.com'));
 *     // Accepted:
 *     $element->isValid('https://www.github.com');
 *     $element->isValid('https://www.google.com');
 *     // Rejected:
 *     $element->isValid('https://blog.github.com');
 *     $element->isValid('https://google.com');
 *     $element->isValid('https://my.personal.google.com');
 *
 * As seen above the wilcard does not match dots, therefore deeper subdomain
 * levels must be listed explicitly:
 *
 *     $element->setAllowedHostnames(array('*.*.google.com'));
 *
 * If at least one hostname constraint is defined, then the rendered element
 * contains a data attribute that holds a comma-separated list of the allowed
 * hostnames:
 *
 *     <input type="text" name="url" id="url" value="" data-allowed-hostnames="www.github.com,*.google.com" />"
 *
 * This information may be used for additional client-side validation via JavaScript.
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
