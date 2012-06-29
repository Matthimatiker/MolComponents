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
     * Sets the allowed hostnames.
     *
     * Example:
     * <code>
     * $element->setHostnames(array('example.com', 'example.org));
     * </code>
     *
     * @param array(string) $hosts
     * @return Mol_Form_Element_EmailAddress Provides a fluent interface.
     */
    public function setAllowedHostnames(array $hosts)
    {
    
    }
    
    /**
     * Returns the allowed hostnames.
     *
     * @return array(string)
     */
    public function getAllowedHostnames()
    {
    
    }
    
    /**
     * Returns the provided email address.
     *
     * Returns null if no address was provided.
     *
     * @return string|null
     */
    public function getEmailAddress()
    {
        
    }
    
}
