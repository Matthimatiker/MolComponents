<?php

/**
 * Mol_Form_Element_EmailAddressTest
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 29.06.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the EmailAddress form element.
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 29.06.2012
 */
class Mol_Form_Element_EmailAddressTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Ensures that the element rejects invalid mail adresses.
     */
    public function testElementRejectsInvalidMail()
    {
    
    }
    
    /**
     * Checks if the element accepts valid mail addresses.
     */
    public function testElementAcceptsValidMail()
    {
        
    }
    
    /**
     * Checks if setHostnames() provides a fluent interface.
     */
    public function testSetHostnamesProvidesFluentInterface()
    {
        
    }
    
    /**
     * Checks if getHostnames() returns an array.
     */
    public function testGetHostnamesReturnsArray()
    {
        
    }
    
    /**
     * Checks if getHostnames() returns the correct number of hostnames.
     */
    public function testGetHostnamesReturnsExpectedNumberOfItems()
    {
        
    }
    
    /**
     * Ensures that getHostnames() returns the correct hostnames.
     */
    public function testGetHostnamesReturnsCorrectItems()
    {
        
    }
    
    /**
     * Ensures that the element accepts mail addresses with allowed hostname.
     */
    public function testElementAcceptsMailWithAllowedHostname()
    {
        
    }
    
    /**
     * Ensures that the element rejects addresses whose hostname is not in
     * the list of allowed hostnames.
     */
    public function testElementRejectsMailWithNotWhitelistedHostname()
    {
        
    }
    
    /**
     * Ensures that the element rejects addresses whose hostname contains an allowed
     * hostname as suffix.
     *
     * Example:
     * Accepted hostname: example.org
     * Provided address: info@not-example.org
     */
    public function testElementRejectsMailWhoseHostnameContainsAllowedHostnameAsSuffix()
    {
        
    }
    
    /**
     * Ensures that getEmailAddress() returns null if no address was provided.
     */
    public function testGetEmailAddressReturnsNullIfNoAdressWasProvided()
    {
        
    }
    
    /**
     * Checks if getEmailAddress() returns the provided address.
     */
    public function testGetEmailAddressReturnsProvidedAddress()
    {
        
    }
    
    /**
     * Ensures that getEmailAddress() returns null if the provided address is not valid.
     */
    public function testGetEmailAddressReturnsNullIfProvidedAddressIsNotValid()
    {
        
    }
    
}
