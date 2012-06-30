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
     * System under test.
     *
     * @var Mol_Form_Element_EmailAddress
     */
    protected $element = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->element = new Mol_Form_Element_EmailAddress('email');
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->element = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that the element rejects invalid mail adresses.
     */
    public function testElementRejectsInvalidMail()
    {
        $this->assertFalse($this->element->isValid('invalid'));
    }
    
    /**
     * Checks if the element accepts valid mail addresses.
     */
    public function testElementAcceptsValidMail()
    {
        $this->assertTrue($this->element->isValid('matthias@matthimatiker.de'));
    }
    
    /**
     * Checks if setAllowedHostnames() provides a fluent interface.
     */
    public function testSetAllowedHostnamesProvidesFluentInterface()
    {
        $this->assertSame($this->element, $this->element->setAllowedHostnames(array('example.org')));
    }
    
    /**
     * Ensures that setAllowedHostnames() overwrites the previous hostname
     * whitelist.
     */
    public function testSetAllowedHostnamesOverwritesPreviousRestrictions()
    {
        $this->element->setAllowedHostnames(array('example.org'));
        $this->element->setAllowedHostnames(array('example.com'));
        $this->assertEquals(array('example.com'), $this->element->getAllowedHostnames());
    }
    
    /**
     * Ensures that setAllowedHostnames() removes the current hostname restrictions
     * if an empty array is provided.
     */
    public function testSetAllowedHostnamesRemovesRestrictionsIfEmptyArrayIsProvided()
    {
        $this->element->setAllowedHostnames(array('example.org'));
        $this->element->setAllowedHostnames(array());
        $this->assertEquals(array(), $this->element->getAllowedHostnames());
    }
    
    /**
     * Checks if setAllowedHostnames() removes leading "@" characters from
     * provided hostnames.
     */
    public function testSetAllowedHostnamesRemovesLeadingAtCharacter()
    {
        $this->element->setAllowedHostnames(array('@example.org'));
        $this->assertEquals(array('example.org'), $this->element->getAllowedHostnames());
    }
    
    /**
     * Checks if getAllowedHostnames() returns an array.
     */
    public function testGetAllowedHostnamesReturnsArray()
    {
        $this->assertInternalType('array', $this->element->getAllowedHostnames());
    }
    
    /**
     * Checks if getAllowedHostnames() returns the correct number of hostnames.
     */
    public function testGetAllowedHostnamesReturnsExpectedNumberOfItems()
    {
        $this->element->setAllowedHostnames(array('example.org', 'example.com'));
        $allowed = $this->element->getAllowedHostnames();
        $this->assertInternalType('array', $allowed);
        $this->assertEquals(2, count($allowed));
    }
    
    /**
     * Ensures that getAllowedHostnames() returns the correct hostnames.
     */
    public function testGetAllowedHostnamesReturnsCorrectItems()
    {
        $this->element->setAllowedHostnames(array('example.org', 'example.com'));
        $allowed = $this->element->getAllowedHostnames();
        $this->assertInternalType('array', $allowed);
        $this->assertContains('example.org', $allowed);
        $this->assertContains('example.com', $allowed);
    }
    
    /**
     * Ensures that getAllowedHostnames() returns an empty array after element creation
     * as the hostname is not restricted per default.
     */
    public function testGetAllowedHostnamesInitiallyReturnsEmptyArray()
    {
        $allowed = $this->element->getAllowedHostnames();
        $this->assertEquals(array(), $allowed);
    }
    
    /**
     * Ensures that hasHostnameRestrictions() returns initially false as the
     * hostnames are not restricted per default.
     */
    public function testHasHostnameRestrictionsInitiallyReturnsFalse()
    {
        $this->assertFalse($this->element->hasHostnameRestrictions());
    }
    
    /**
     * Ensures that hasHostnameRestrictions() returns true if a hostname whitelist
     * was provided.
     */
    public function testHasHostnameRestrictionsReturnsTrueIfListOfHostnamesWasProvided()
    {
        $this->element->setAllowedHostnames(array('example.org'));
        $this->assertTrue($this->element->hasHostnameRestrictions());
    }
    
    /**
     * Ensures that hasHostnameRestrictions() returns false if a hostname whitelist
     * was provided, but the restrictions were removed afterwards.
     */
    public function testHasHostnameRestrictionsReturnsFalseIfRestrictionsWereRemoved()
    {
        $this->element->setAllowedHostnames(array('example.org'));
        $this->element->setAllowedHostnames(array());
        $this->assertFalse($this->element->hasHostnameRestrictions());
    }
    
    /**
     * Ensures that the element accepts mail addresses with allowed hostname.
     */
    public function testElementAcceptsMailWithAllowedHostname()
    {
        $this->element->setAllowedHostnames(array('example.org', 'example.com'));
        $this->assertTrue($this->element->isValid('user@example.org'));
    }
    
    /**
     * Ensures that the element rejects addresses whose hostname is not in
     * the list of allowed hostnames.
     */
    public function testElementRejectsMailWithNotWhitelistedHostname()
    {
        $this->element->setAllowedHostnames(array('example.org', 'example.com'));
        $this->assertFalse($this->element->isValid('user@another-domain.com'));
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
        $this->element->setAllowedHostnames(array('example.org'));
        $this->assertFalse($this->element->isValid('info@not-example.org'));
    }
    
    /**
     * Ensures that getEmailAddress() returns null if no address was provided.
     */
    public function testGetEmailAddressReturnsNullIfNoAdressWasProvided()
    {
        $this->assertNull($this->element->getEmailAddress());
    }
    
    /**
     * Checks if getEmailAddress() returns the provided address.
     */
    public function testGetEmailAddressReturnsProvidedAddress()
    {
        $this->element->setValue('matthias@matthimatiker.de');
        $this->assertEquals('matthias@matthimatiker.de', $this->element->getEmailAddress());
    }
    
    /**
     * Ensures that getEmailAddress() returns null if the provided address is not valid.
     */
    public function testGetEmailAddressReturnsNullIfProvidedAddressIsNotValid()
    {
        $this->element->setValue('invalid');
        $this->assertNull($this->element->getEmailAddress());
    }
    
    /**
     * Checks if the element removes leading and/or trailing whitespace
     * automatically.
     */
    public function testElementRemovesWhitespaceAutomatically()
    {
        $this->element->setValue(' matthias@matthimatiker.de ');
        $this->assertEquals('matthias@matthimatiker.de', $this->element->getValue());
    }
    
    /**
     * Ensures that the element accepts mail addresses with leading or
     * trailing whitespace.
     */
    public function testElementAcceptsMailWithLeadingOrTrailingWhitespace()
    {
        $this->assertTrue($this->element->isValid(' matthias@matthimatiker.de '));
    }
    
    /**
     * Ensures that getEmailAddress() returns the address without leading or
     * trailing whitespace.
     */
    public function testGetEmailAddressReturnsAddressWithoutWhitespace()
    {
        $this->element->setValue(' matthias@matthimatiker.de ');
        $this->assertEquals('matthias@matthimatiker.de', $this->element->getEmailAddress());
    }
    
    /**
     * Checks if it is possible to render the element.
     */
    public function testElementIsRenderable()
    {
        $markup = $this->element->render(new Zend_View());
        $this->assertInternalType('string', $markup);
        $this->assertNotEmpty($markup);
    }
    
    /**
     * Checks if the element provides an attribute that contains the allowed hostnames.
     */
    public function testElementContainsAttributeWithAllowedHostnames()
    {
        
    }
    
    /**
     * Ensures that the element does not contain a hostnames attribute if no hostname
     * whitelist is available.
     */
    public function testElementDoesNotContainHostnamesAttributeIfNoWhitelistWasProvided()
    {
        
    }
    
}
