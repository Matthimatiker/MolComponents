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
        $this->assertions = new Mol_Test_Assertions_HttpResponse($this->response);
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
        $this->assertFailure();
        $this->assertions->hasCode(400);
    }
    
    /**
     * Ensures hasCode() succeeds if the response contains the expected
     * status code.
     */
    public function testHasCodeSucceedsIfExpectedCodeIsPresent()
    {
        $this->assertSuccess();
        $this->assertions->hasCode(200);
    }
    
    /**
     * Ensures that hasHeader() succeeds if the response contains the
     * expected header.
     */
    public function testHasHeaderSucceedsIfExpectedHeaderIsPresent()
    {
        $this->assertSuccess();
        $this->assertions->hasHeader('Content-Type');
    }
    
    /**
     * Ensures that hasHeader() succeeds if the response contains the
     * expected header multiple times.
     */
    public function testHasHeaderSucceedsIfExpectedHeaderIsPresentMultipleTimes()
    {
        $this->assertSuccess();
        $this->assertions->hasHeader('X-Multiple-Times');
    }
    
    /**
     * Ensures that hasHeader() fails if the response does not contain
     * the expected header.
     */
    public function testHasHeaderFailsIfHeaderIsMissing()
    {
        $this->assertFailure();
        $this->assertions->hasHeader('X-Missing');
    }
    
    /**
     * Ensures that notHasHeader() succeeds if the given header is not
     * present in the response.
     */
    public function testNotHasHeaderSucceedsIfHeaderIsNotPresent()
    {
        $this->assertSuccess();
        $this->assertions->notHasHeader('X-Missing');
    }
    
    /**
     * Ensures that notHasHeader() fails if the response contains the
     * provided header once.
     */
    public function testNotHasHeaderFailsIfHeaderIsPresentOnce()
    {
        $this->assertFailure();
        $this->assertions->notHasHeader('Content-Type');
    }
    
    /**
     * Ensures that notHasHeader() fails if the response contains the
     * provided header multiple times.
     */
    public function testNotHasHeaderFailsIfHeaderIsPresentMultipleTimes()
    {
        $this->assertFailure();
        $this->assertions->notHasHeader('X-Multiple-Times');
    }
    
    /**
     * Ensures that headerEquals() fails if the response does not contain
     * the expected header.
     */
    public function testHeaderEqualsFailsIfHeaderIsNotPresent()
    {
        $this->assertFailure();
        $this->assertions->headerEquals('X-Missing', 'expected content');
    }
    
    /**
     * Ensures that headerEquals() fails if the response contains
     * the provided header multiple times.
     */
    public function testHeaderEqualsFailsIfHeaderIsPresentMultipleTimes()
    {
        $this->assertFailure();
        $this->assertions->headerEquals('X-Multiple-Times', 'expected content');
    }
    
    /**
     * Ensures that headerEquals() fails if the response contains the
     * provided header once, but its content differs from the expected
     * value.
     */
    public function testHeaderEqualsFailsIfHeaderIsPresentButNotEqual()
    {
        $this->assertFailure();
        $this->assertions->headerEquals('Content-Type', 'text/xml');
    }
    
    /**
     * Ensures that headerEquals() succeeds if the header is present exactly
     * once and it has the expected content.
     */
    public function testHeaderEqualsSucceedsIfHeaderIsPresentOnceAndEqual()
    {
        $this->assertSuccess();
        $this->assertions->headerEquals('Content-Type', 'text/html');
    }
    
    /**
     * Ensures that contains() fails if the response body does not contain
     * the expected string.
     */
    public function testContainsFailsIfBodyDoesNotContainTheExpectedString()
    {
        $this->assertFailure();
        $this->assertions->contains('universe');
    }
    
    /**
     * Ensures that contains() succeeds if the response body contains the
     * expected string.
     */
    public function testContainsSucceedsIfBodyContainsTheExpectedString()
    {
        $this->assertSuccess();
        $this->assertions->contains('world');
    }
    
    /**
     * Ensures that notContains() fails if the response body contains
     * the provided string.
     */
    public function testNotContainsFailsIfBodyContainsTheGivenString()
    {
        $this->assertFailure();
        $this->assertions->notContains('world');
    }
    
    /**
     * Ensures that notContains() succeeds if the response body does not
     * contain the provided string.
     */
    public function testNotContainsSucceedsIfBodyDoesNotContainTheGivenString()
    {
        $this->assertSuccess();
        $this->assertions->notContains('universe');
    }
    
    /**
     * Ensures that containsImage() fails if the response body does not
     * contain a valid image.
     */
    public function testContainsImageFailsIfBodyDoesNotContainImage()
    {
        $this->assertFailure();
        $this->response->setHeader('Content-Type', 'image/png', true);
        $this->assertions->containsImage();
    }
    
    /**
     * Ensures that containsImage() fails if no image content type
     * is provided.
     */
    public function testContainsImageFailsIfImageContentTypeIsMissing()
    {
        $this->assertFailure();
        $this->insertImageInto($this->response);
        $this->assertions->containsImage();
    }
    
    /**
     * Ensures that containsImage() fails if the image type in the header and
     * the image data in the response body do not fit together.
     */
    public function testContainsImageFailsIfTypeOfImageAndContentTypeDoNotMatch()
    {
        $this->assertFailure();
        $this->response->setHeader('Content-Type', 'image/gif', true);
        $this->insertImageInto($this->response);
        $this->assertions->containsImage();
    }
    
    /**
     * Ensures that containsImage() succeeds if the response body contains image
     * data and a matching image header is provided.
     */
    public function testContainsImageSucceedsIfBodyContainsImageAndHeaderIsCorrect()
    {
        $this->assertSuccess();
        $this->response->setHeader('Content-Type', 'image/png', true);
        $this->insertImageInto($this->response);
        $this->assertions->containsImage();
    }
    
    /**
     * Ensures that containsJson() fails if the response body does not
     * contain JSON data.
     */
    public function testContainsJsonFailsIfBodyDoesNotContainJsonData()
    {
        $this->assertFailure();
        $this->response->setHeader('Content-Type', 'application/json', true);
        $this->assertions->containsJson();
    }
    
    /**
     * Ensures that containsJson() fails if the response body contains JSON data,
     * but the content type header does not indicate JSON.
     */
    public function testContainsJsonFailsIfContentTypeDoesNotIndicateJsonFormat()
    {
        $this->assertFailure();
        $this->insertJsonInto($this->response);
        $this->assertions->containsJson();
    }
    
    /**
     * Ensures that containsJson() succeeds if the response body contains JSON data
     * and a corresponding header is provided.
     */
    public function testContainsJsonSucceedsIfBodyContainsJsonAndContentTypeIndicatesFormat()
    {
        $this->assertSuccess();
        $this->response->setHeader('Content-Type', 'application/json', true);
        $this->insertJsonInto($this->response);
        $this->assertions->containsJson();
    }
    
    public function testIsRedirectSucceedsIfResponseRedirectsToAnyUrl()
    {
        
    }
    
    public function testIsRedirectFailsIfResponseDoesNotRedirect()
    {
        
    }
    
    public function testRedirectsToSucceedsIfResponseRedirectsToProvidedUrl()
    {
        
    }
    
    public function testRedirectsToFailsIfResponseDoesNotRedirect()
    {
        
    }
    
    public function testRedirectsToFailsIfResponseRedirectsToUnexpectedUrl()
    {
        
    }
    
    /**
     * Asserts that the current test will fail.
     */
    protected function assertFailure()
    {
        $this->setExpectedException('PHPUnit_Framework_AssertionFailedError');
    }
    
    /**
     * Asserts that the current test will succeed.
     */
    protected function assertSuccess()
    {
        $this->setExpectedException(null);
    }
    
    /**
     * Inserts a PNG test image into the given response.
     *
     * @param Zend_Controller_Response_Http $response
     */
    protected function insertImageInto(Zend_Controller_Response_Http $response)
    {
        $path    = dirname(__FILE__) . '/TestData/test.png';
        $content = file_get_contents($path);
        $response->setBody($content);
    }
    
    /**
     * Inserts JSON data into the given response.
     *
     * @param Zend_Controller_Response_Http $response
     */
    protected function insertJsonInto(Zend_Controller_Response_Http $response)
    {
        $data = new stdClass();
        $data->a = 'b';
        $data->c = 'd';
        $response->setBody(json_encode($data));
    }
    
    /**
     * Creates a pre-configured response for testing.
     *
     * @return Zend_Controller_Response_HttpTestCase
     */
    protected function createResponse()
    {
        $response = new Zend_Controller_Response_HttpTestCase();
        $response->setHttpResponseCode(200);
        $response->setHeader('Content-Type', 'text/html', true);
        $response->setHeader('X-Multiple-Times', 'a', false);
        $response->setHeader('X-Multiple-Times', 'b', false);
        $response->setHeader('X-Multiple-Times', 'c', false);
        $response->setBody('Hello world!');
        return $response;
    }
    
}
