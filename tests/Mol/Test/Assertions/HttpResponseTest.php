<?php

/**
 * Mol_Test_Assertions_HttpResponseTest
 *
 * @category PHP
 * @package Mol_Test
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 23.12.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the HttpResponse assertions.
 *
 * @category PHP
 * @package Mol_Test
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 23.12.2012
 */
class Mol_Test_Assertions_HttpResponseTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Test_Assertions_HttpResponse
     */
    protected $assertions = null;
    
    /**
     * The response that is used for testing.
     *
     * @var Zend_Controller_Response_HttpTestCase
     */
    protected $response = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->response   = $this->createResponse();
        $this->assertions = new Mol_Test_Assertions_HttpResponseTest($this->response);
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->assertions = null;
        $this->response   = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that the creation of the assertion object fails if no
     * valid HTTP response object is provided.
     */
    public function testCreatingObjectForNonResponseFails()
    {
        $this->assertFailure();
        new Mol_Test_Assertions_HttpResponse(new stdClass());
    }
    
    /**
     * Ensures that hasCode() fails if the status code of the response
     * does not match the expected one.
     */
    public function testHasCodeFailsIfCodeDiffers()
    {
        
    }
    
    /**
     * Ensures hasCode() succeeds if the response contains the expected
     * status code.
     */
    public function testHasCodeSucceedsIfExpectedCodeIsPresent()
    {
        
    }
    
    /**
     * Ensures that hasHeader() succeeds if the response contains the
     * expected header.
     */
    public function testHasHeaderSucceedsIfExpectedHeaderIsPresent()
    {
        
    }
    
    /**
     * Ensures that hasHeader() succeeds if the response contains the
     * expected header multiple times.
     */
    public function testHasHeaderSucceedsIfExpectedHeaderIsPresentMultipleTimes()
    {
    
    }
    
    /**
     * Ensures that hasHeader() fails if the response does not contain
     * the expected header.
     */
    public function testHasHeaderFailsIfHeaderIsMissing()
    {
        
    }
    
    /**
     * Ensures that notHasHeader() succeeds if the given header is not
     * present in the response.
     */
    public function testNotHasHeaderSucceedsIfHeaderIsNotPresent()
    {
        
    }
    
    /**
     * Ensures that notHasHeader() fails if the response contains the
     * provided header once.
     */
    public function testNotHasHeaderFailsIfHeaderIsPresentOnce()
    {
    
    }
    
    /**
     * Ensures that notHasHeader() fails if the response contains the
     * provided header multiple times.
     */
    public function testNotHasHeaderFailsIfHeaderIsPresentMultipleTimes()
    {
    
    }
    
    /**
     * Ensures that headerEquals() fails if the response does not contain
     * the expected header.
     */
    public function testHeaderEqualsFailsIfHeaderIsNotPresent()
    {
        
    }
    
    /**
     * Ensures that headerEquals() fails if the response contains
     * the provided header multiple times.
     */
    public function testHeaderEqualsFailsIfHeaderIsPresentMultipleTimes()
    {
    
    }
    
    /**
     * Ensures that headerEquals() fails if the response contains the
     * provided header once, but its content differs from the expected
     * value.
     */
    public function testHeaderEqualsFailsIfHeaderIsPresentButNotEqual()
    {
    
    }
    
    /**
     * Ensures that headerEquals() succeeds if the header is present exactly
     * once and it has the expected content.
     */
    public function testHeaderEqualsSucceedsIfHeaderIsPresentOnceAndEqual()
    {
    
    }
    
    /**
     * Ensures that contains() fails if the response body does not contain
     * the expected string.
     */
    public function testContainsFailsIfBodyDoesNotContainTheExpectedString()
    {
        
    }
    
    /**
     * Ensures that contains() succeeds if the response body contains the
     * expected string.
     */
    public function testContainsSucceedsIfBodyContainsTheExpectedString()
    {
    
    }
    
    /**
     * Ensures that notContains() fails if the response body contains
     * the provided string.
     */
    public function testNotContainsFailsIfBodyContainsTheGivenString()
    {
        
    }
    
    /**
     * Ensures that notContains() succeeds if the response body does not
     * contain the provided string.
     */
    public function testNotContainsSucceedsIfBodyDoesNotContainTheGivenString()
    {
        
    }
    
    /**
     * Ensures that containsImage() fails if the response body does not
     * contain a valid image.
     */
    public function testContainsImageFailsIfBodyDoesNotContainImage()
    {
        
    }
    
    /**
     * Ensures that containsImage() fails if no image content type
     * is provided.
     */
    public function testContainsImageFailsIfImageContentTypeIsMissing()
    {
        
    }
    
    /**
     * Ensures that containsImage() fails if the image type in the header and
     * the image data in the response body do not fit together.
     */
    public function testContainsImageFailsIfTypeOfImageAndContentTypeDoNotMatch()
    {
        
    }
    
    /**
     * Ensures that containsImage() succeeds if the response body contains image
     * data and a matching image header is provided.
     */
    public function testContainsImageSucceedsIfBodyContainsImageAndHeaderIsCorrect()
    {
    
    }
    
    /**
     * Ensures that containsJson() fails if the response body does not
     * contain JSON data.
     */
    public function testContainsJsonFailsIfBodyDoesNotContainJsonData()
    {
        
    }
    
    /**
     * Ensures that containsJson() fails if the response body contains JSON data,
     * but the content type header does not indicate JSON.
     */
    public function testContainsJsonFailsIfContentTypeDoesNotIndicateJsonFormat()
    {
        
    }
    
    /**
     * Ensures that containsJson() succeeds if the response body contains JSON data
     * and a corresponding header is provided.
     */
    public function testContainsJsonSucceedsIfBodyContainsJsonAndContentTypeIndicatesFormat()
    {
        
    }
    
    /**
     * Asserts that the current test will fail.
     */
    protected function assertFailure()
    {
        $this->setExpectedException('PHPUnit_Framework_ExpectationFailedException');
    }
    
    /**
     * Creates a pre-configured response for testing.
     *
     * @return Zend_Controller_Response_HttpTestCase
     */
    protected function createResponse()
    {
        $response = new Zend_Controller_Response_HttpTestCase();
        $response->setBody('Hello world!');
        return $response;
    }
    
}
