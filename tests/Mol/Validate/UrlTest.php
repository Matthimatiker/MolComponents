<?php

/**
 * Mol_Validate_UrlTest
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 11.03.2013
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the URL validator.
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 11.03.2013
 */
class Mol_Validate_UrlTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Validate_Url
     */
    protected $validator = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->validator = new Mol_Validate_Url();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->validator = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that the validator rejects non-string values.
     */
    public function testValidatorRejectsNonStringValue()
    {
        $this->assertFalse($this->validator->isValid(new stdClass()));
    }
    
    /**
     * Checks if the validator rejects a string that does not
     * contrain an URL.
     */
    public function testValidatorRejectsNonUrlString()
    {
        $this->assertFalse($this->validator->isValid('Hello world!'));
    }
    
    /**
     * Ensures that the validator rejects relative URLs.
     */
    public function testValidatorRejectsRelativeUrl()
    {
        $this->assertFalse($this->validator->isValid('/relative/path'));
    }
    
    /**
     * Checks if the validator accepts absolute URLs.
     */
    public function testValidatorAcceptsAbsoluteUrl()
    {
        $this->assertTrue($this->validator->isValid('http://www.example.org/path/'));
    }
    
    /**
     * Ensures that the validator provides a failure message when a validated
     * value was not accepted.
     */
    public function testValidatorProvidesMessageAfterValidationOfNonUrlString()
    {
        $this->validator->isValid('Hello world!');
        $messages = $this->validator->getMessages();
        $this->assertInternalType('array', $messages);
        $this->assertGreaterThan(0, count($messages));
    }
    
    /**
     * Checks if setAcceptedHostnames() provides a fluent interface.
     */
    public function testSetAcceptedHostnamesProvidesFluentInterface()
    {
        $this->assertSame($this->validator, $this->validator->setAcceptedHostnames(array('github.com')));
    }
    
    /**
     * Checks if getAcceptedHostnames() returns the list of hostnames
     * that was provided before.
     */
    public function testGetAcceptedHostnamesReturnsProvidedHostnames()
    {
        $hostnames = array('github.com', 'google.de');
        $this->validator->setAcceptedHostnames($hostnames);
        $this->assertEquals($hostnames, $this->validator->getAcceptedHostnames());
    }
    
    /**
     * Checks if setAcceptedHostnames() overwrites the previously provided
     * list of hostnames.
     */
    public function testSetAcceptedHostnamesOverwritesPreviousHostnames()
    {
        $this->validator->setAcceptedHostnames(array('github.com'));
        $this->validator->setAcceptedHostnames(array('google.de'));
        $this->assertEquals(array('google.de'), $this->validator->getAcceptedHostnames());
    }
    
    /**
     * Ensures that the validator rejects a URL with not accepted hostname.
     */
    public function testValidatorRejectsWithNotAcceptedHostname()
    {
        $this->validator->setAcceptedHostnames(array('github.com'));
        $this->assertFalse($this->validator->isValid('http://google.com'));
    }
    
    /**
     * Checks if the validator rejects a URL whose hostname ends with an
     * allowed hostname.
     */
    public function testValidatorRejectsUrlWhoseHostnameEndsWithAllowedHostname()
    {
        $this->validator->setAcceptedHostnames(array('github.com'));
        $this->assertFalse($this->validator->isValid('http://not-github.com'));
    }
    
    /**
     * Checks if the validator rejects a URL whose hostname starts with an
     * allowed hostname.
     */
    public function testValidatorRejectsUrlWhoseHostnameStartsWithAllowedHostname()
    {
        $this->validator->setAcceptedHostnames(array('github.com'));
        $this->assertFalse($this->validator->isValid('http://github.com.another-host.org'));
    }
    
    /**
     * Checks if the validator rejects a URL whose hostname contains an
     * allowed hostname.
     */
    public function testValidatorRejectsUrlWhoseHostnameContainsAllowedHostname()
    {
        $this->validator->setAcceptedHostnames(array('github.com'));
        $this->assertFalse($this->validator->isValid('http://not.github.com.host.org'));
    }
    
    /**
     * Ensures that the validator accepts an URL with a whitelisted hostname.
     */
    public function testValidatorAcceptsUrlWithAcceptedHostname()
    {
        $this->validator->setAcceptedHostnames(array('github.com'));
        $this->assertTrue($this->validator->isValid('http://github.com/matthimatiker/molcomponents'));
    }
    
    /**
     * Ensures that the validator accepts a URL if multiple accepted hostnames were
     * provided and the url's hostname matches any of these.
     */
    public function testValidatorAcceptsUrlWhoseHostnameMatchesAnyOfTheAcceptedHostnames()
    {
        $this->validator->setAcceptedHostnames(array('github.com', 'google.de'));
        $this->assertTrue($this->validator->isValid('http://google.de'));
    }
    
    /**
     * Ensures that the validator accepts a URL whose hostname matches a
     * provided hostname pattern.
     */
    public function testValidatorAcceptsUrlWhoseHostnameMatchesWildcardPattern()
    {
        $this->validator->setAcceptedHostnames(array('*.github.com'));
        $this->assertTrue($this->validator->isValid('http://blog.github.com'));
    }
    
    /**
     * Ensures that the validator rejects a URL whose hostname does not match
     * the provided wildcard pattern.
     */
    public function testValidatorRejectsUrlWhoseHostnameDoesNotMatchWildcard()
    {
        $this->validator->setAcceptedHostnames(array('*.github.com'));
        $this->assertFalse($this->validator->isValid('http://blog.google.com'));
    }
    
    /**
     * Ensures that the wildcard in a hostname pattern does not match a dot.
     */
    public function testWildcardInHostnameDoesNotMatchDot()
    {
        $this->validator->setAcceptedHostnames(array('*.github.com'));
        $this->assertFalse($this->validator->isValid('http://sub.blog.github.com'));
    }
    
    /**
     * Ensures that the validator provides a failure message if an url is rejected
     * because of its hostname.
     */
    public function testValidatorProvidesMessageIfUrlIsRejectedBecauseOfItsHostname()
    {
        $this->validator->setAcceptedHostnames(array('github.com'));
        $this->validator->isValid('http://google.com');
        $messages = $this->validator->getMessages();
        $this->assertInternalType('array', $messages);
        $this->assertGreaterThan(0, count($messages));
    }
    
    /**
     * Checks if the acceptedHostnames attribute contains a string with the
     * whitelisted hostnames.
     *
     * This attribute can be referenced in failure messages.
     */
    public function testAcceptedHostnamesAttributeProvidesListOfHostnamesAsString()
    {
        $this->validator->setAcceptedHostnames(array('github.com', 'google.de'));
        $list = $this->validator->acceptedHostnames;
        $this->assertInternalType('string', $list);
        $this->assertContains('github.com', $list);
        $this->assertContains('google.de', $list);
    }
    
    /**
     * Checks if the default value attribute is still working.
     */
    public function testValueAttributeReturnsTheCheckedValue()
    {
        $this->validator->isValid('test');
        $this->assertEquals('test', $this->validator->value);
    }
    
}
