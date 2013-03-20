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
        
    }
    
    /**
     * Checks if getAcceptedHostnames() returns the list of hostnames
     * that was provided before.
     */
    public function testGetAcceptedHostnamesReturnsProvidedHostnames()
    {
        
    }
    
    /**
     * Checks if setAcceptedHostnames() overwrites the previously provided
     * list of hostnames.
     */
    public function testSetAcceptedHostnamesOverwritesPreviousHostnames()
    {
        
    }
    
    /**
     * Ensures that the validator rejects a URL with not accepted hostname.
     */
    public function testValidatorRejectsWithNotAcceptedHostname()
    {
        
    }
    
    /**
     * Checks if the validator rejects a URL whose hostname ends with an
     * allowed hostname.
     */
    public function testValidatorRejectsUrlWhoseHostnameEndsWithAllowedHostname()
    {
        
    }
    
    /**
     * Checks if the validator rejects a URL whose hostname starts with an
     * allowed hostname.
     */
    public function testValidatorRejectsUrlWhoseHostnameStartsWithAllowedHostname()
    {
    
    }
    
    /**
     * Checks if the validator rejects a URL whose hostname contains an
     * allowed hostname.
     */
    public function testValidatorRejectsUrlWhoseHostnameContainsAllowedHostname()
    {
    
    }
    
    /**
     * Ensures that the validator accepts an URL with a whitelisted hostname.
     */
    public function testValidatorAcceptsUrlWithAcceptedHostname()
    {
    
    }
    
    /**
     * Ensures that the validator accepts a URL whose hostname matches a
     * provided hostname pattern.
     */
    public function testValidatorAcceptsUrlWhoseHostnameMatchesWildcardPattern()
    {
        
    }
    
    /**
     * Ensures that the wildcard in a hostname pattern does not match a dot.
     */
    public function testWildcardInHostnameDoesNotMatchDot()
    {
        
    }
    
    /**
     * Ensures that the validator provides a failure message if an url is rejected
     * because of its hostname.
     */
    public function testValidatorProvidesMessageIfUrlIsRejectedBecauseOfItsHostname()
    {
        
    }
    
    /**
     * Checks if the acceptedHostnames attribute contains a string with the
     * whitelisted hostnames.
     *
     * This attribute can be referenced in failure messages.
     */
    public function testAcceptedHostnamesAttributeProvidesListOfHostnamesAsString()
    {
        
    }
    
    /**
     * Checks if the default value attribute is still working.
     */
    public function testValueAttributeReturnsTheCheckedValue()
    {
        
    }
    
}
