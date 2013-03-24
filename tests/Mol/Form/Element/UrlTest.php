<?php

/**
 * Mol_Form_Element_UrlTest
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 24.03.2013
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the URL element.
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 24.03.2013
 */
class Mol_Form_Element_UrlTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Form_Element_Url
     */
    protected $element = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->element = new Mol_Form_Element_Url('url');
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
     * Checks if teh element accepts a URL.
     */
    public function testElementAcceptsUrl()
    {
        $this->assertTrue($this->element->isValid('http://www.google.com'));
    }
    
    /**
     * Ensures that the element rejects non-URL values.
     */
    public function testElementRejectsNonUrl()
    {
        $this->assertFalse($this->element->isValid('hello world'));
    }
    
    /**
     * Ensures that hasHostnameRestrictions() returns false if no constraints
     * regarding hostnames were provided.
     */
    public function testHasHostnameRestrictionsReturnsFalseIfNoConstraintsWereDefined()
    {
        $this->assertFalse($this->element->hasHostnameRestrictions());
    }
    
    /**
     * Ensures that hasHostnameRestrictions() returns true if hostname constraints
     * were passed to the element.
     */
    public function testHasHostnameRestrictionsReturnsTrueIfConstraintsWereProvided()
    {
        $this->element->setAllowedHostnames(array('google.com', 'github.com'));
        $this->assertTrue($this->element->hasHostnameRestrictions());
    }
    
    /**
     * Checks if setAllowedHostnames() provides a fluent interface.
     */
    public function testSetAllowedHostnamesProvidesFluentInterface()
    {
        $this->assertSame($this->element, $this->element->setAllowedHostnames(array('github.com')));
    }
    
    /**
     * Checks if getAllowedHostnames() returns the previously provided
     * hostname constraints.
     */
    public function testGetAllowedHostnamesReturnsProvidedHostnameConstraints()
    {
        $this->element->setAllowedHostnames(array('google.com', 'github.com'));
        $allowedHostnames = $this->element->getAllowedHostnames();
        
        $this->assertInternalType('array', $allowedHostnames);
        $this->assertContains('google.com', $allowedHostnames);
        $this->assertContains('github.com', $allowedHostnames);
        $this->assertCount(2, $allowedHostnames);
    }
    
    /**
     * Ensures that the element accepts a URL with an allowed hostname.
     */
    public function testElementAcceptsUrlWithAllowedHostname()
    {
        $this->element->setAllowedHostnames(array('google.com', 'github.com'));
        $this->assertTrue($this->element->isValid('http://google.com?q=test'));
    }
    
    /**
     * Ensures that the element rejects URLs with hostnames that are
     * not allowed.
     */
    public function testElementRejectsUrlWithNotAcceptedHostname()
    {
        $this->element->setAllowedHostnames(array('google.com', 'github.com'));
        $this->assertFalse($this->element->isValid('http://google.de?q=test'));
    }
    
    /**
     * Ensures that the internal URL validator cannot be accessed as attribute.
     */
    public function testInternalValidatorIsNotExposedViaAttribute()
    {
        $this->assertNull($this->element->getAttrib('urlValidator'));
    }
    
}
