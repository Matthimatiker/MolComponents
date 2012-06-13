<?php

/**
 * Mol_Test_Http_Client_AdapterTest
 *
 * @package Mol_Test
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @version $Rev: 416 $
 * @since 12.03.2011
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the functionality of the HTTP test adapter.
 *
 * @package Mol_Test
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @version $Rev: 416 $
 * @since 12.03.2011
 */
class Mol_Test_Http_Client_AdapterTest extends PHPUnit_Framework_TestCase
{
    /**
     * System under test.
     *
     * @var Mol_Test_Http_Client_Adapter
     */
    protected $adapter = null;

    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->adapter = new Mol_Test_Http_Client_Adapter();
    }

    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->adapter = null;
        parent::tearDown();
    }

    /**
     * Ensures that the adapter return the preconfigured response per default.
     */
    public function testAdapterReturnsInitialConfiguredResponse()
    {
        $response = $this->request('http://www.matthimatiker.de');
        $this->assertType('Zend_Http_Response', $response);
    }

    /**
     * Ensures that the adapter returns the configured response.
     */
    public function testAdapterReturnsConfiguredResponse()
    {
        $this->adapter->setResponse($this->createResponse('Test'));
        $this->assertRequestedResponseContains('Test', 'http://www.matthimatiker.de');
    }

    /**
     * Tests if the adapter returns default responses in correct order.
     */
    public function testAdapterReturnsDefaultResponsesInOrder()
    {
        $this->adapter->setResponse(array());
        $this->adapter->addResponse($this->createResponse('First'));
        $this->adapter->addResponse($this->createResponse('Second'));
        $this->assertRequestedResponseContains('First', 'http://www.matthimatiker.de');
        $this->assertRequestedResponseContains('Second', 'http://www.matthimatiker.de');
    }

    /**
     * Ensures that the adapter cycles through the default responses.
     */
    public function testAdapterCyclesThroughDefaultResponses()
    {
        $this->adapter->setResponse(array());
        $this->adapter->addResponse($this->createResponse('First'));
        $this->adapter->addResponse($this->createResponse('Second'));
        $this->request('http://www.matthimatiker.de');
        $this->request('http://www.matthimatiker.de');
        // There is no third reponse, therefore the adapter has to
        // deliver the first again.
        $this->assertRequestedResponseContains('First', 'http://www.matthimatiker.de');
    }

    /**
     * Tests if the adapter prefers responses whose pattern matches the requested url.
     */
    public function testAdapterPrefersResponsesThatMatchThePattern()
    {
        $this->adapter->setResponse(array());
        $this->adapter->addResponse($this->createResponse('Default'));
        $this->adapter->addResponse($this->createResponse('Pattern'), 'http://www.matthimatiker.de');
        $this->assertRequestedResponseContains('Pattern', 'http://www.matthimatiker.de');
    }

    /**
     * Ensures that the adapter returns responses that are registered for
     * a url pattern in correct order.
     */
    public function testAdapterReturnsResponsesThatMatchThePatternInOrder()
    {
        $this->adapter->setResponse(array());
        $this->adapter->addResponse($this->createResponse('Default'));
        $this->adapter->addResponse($this->createResponse('First'), 'http://www.matthimatiker.de');
        $this->adapter->addResponse($this->createResponse('Second'), 'http://www.matthimatiker.de');
        $this->assertRequestedResponseContains('First', 'http://www.matthimatiker.de');
        $this->assertRequestedResponseContains('Second', 'http://www.matthimatiker.de');
    }

    /**
     * Ensures that the adapter cycles through the responses that are registered
     * for a specific pattern.
     */
    public function testAdaterCyclesThroughResponsesThatMatchThePattern()
    {
        $this->adapter->setResponse(array());
        $this->adapter->addResponse($this->createResponse('Default'));
        $this->adapter->addResponse($this->createResponse('First'), 'http://www.matthimatiker.de');
        $this->adapter->addResponse($this->createResponse('Second'), 'http://www.matthimatiker.de');
        $this->request('http://www.matthimatiker.de');
        $this->request('http://www.matthimatiker.de');
        $this->assertRequestedResponseContains('First', 'http://www.matthimatiker.de');
    }

    /**
     * Tests if the adapter supports wildcards ("*") in url patterns.
     */
    public function testUrlPatternSupportsWildCards()
    {
        $this->adapter->setResponse(array());
        $this->adapter->addResponse($this->createResponse('Default'));
        $this->adapter->addResponse($this->createResponse('Pattern'), 'http://www.matthimatiker.de/*.html');
        $this->assertRequestedResponseContains('Pattern', 'http://www.matthimatiker.de/demo.html');
    }

    /**
     * Ensures that the dot (".") is not interpreted as part of a regular expression.
     */
    public function testAdapterDoesNotInterpretDotAsPartOfRegularExpression()
    {
        $this->adapter->setResponse(array());
        $this->adapter->addResponse($this->createResponse('Default'));
        $this->adapter->addResponse($this->createResponse('Pattern'), 'http://www.matthimatiker.de/demo.html');
        // Normalerweise steht der Punkt in regulären Ausdrücken für ein beliebiges Zeichen.
        $this->assertRequestedResponseContains('Default', 'http://www.matthimatiker.de/demoxhtml');
    }

    /**
     * Ensures that the adapter returns the response that was registered first,
     * if their url patterns are competing for the requested url.
     */
    public function testAdapterReturnsFirstMatchingResponse()
    {
        $this->adapter->setResponse(array());
        $this->adapter->addResponse($this->createResponse('Default'));
        $this->adapter->addResponse($this->createResponse('First Pattern'), 'http://www.matthimatiker.de/*.html');
        $this->adapter->addResponse($this->createResponse('Second Pattern'), 'http://www.matthimatiker.de/demo.*');
        $this->assertRequestedResponseContains('First Pattern', 'http://www.matthimatiker.de/demo.html');
    }

    /**
     * Ensures that getNumberOfRequests() returns the correct number of
     * all requests.
     */
    public function testGetNumberOfRequestsReturnsCorrectValue()
    {
        $this->request('http://www.matthimatiker.de');
        $this->request('http://www.matthimatiker.de');
        $this->request('http://www.matthimatiker.de');
        $this->assertEquals(3, $this->adapter->getNumberOfRequests());
    }

    /**
     * Ensures that getNumberOfRequestsFor() returns the correct number
     * of requests for a specific url pattern.
     */
    public function testGetNumberOfRequestsForReturnsCorrectValue()
    {
        $this->adapter->addResponse($this->createResponse('Pattern'), 'http://www.matthimatiker.de');
        $this->request('http://www.matthimatiker.de');
        $this->request('http://www.matthimatiker.de');
        $this->request('http://www.google.de');
        $this->assertEquals(2, $this->adapter->getNumberOfRequestsFor('http://www.matthimatiker.de'));
    }

    /**
     * Tests if getNumberOfRequestsFor() return 0 if there was no request for
     * the given pattern.
     */
    public function testGetNumberOfRequestsForReturnsZerofNoRequestForThatPatternWasReceived()
    {
        $this->adapter->addResponse($this->createResponse('Pattern'), 'http://www.matthimatiker.de');
        $this->assertEquals(0, $this->adapter->getNumberOfRequestsFor('http://www.matthimatiker.de'));
    }

    /**
     * Ensures that getNumberOfRequestsFor() throws an exception if the given
     * url pattern is unknown.
     */
    public function testGetNumberOfRequestsForThrowsExceptionIfPatternIsUnknown()
    {
        $this->setExpectedException('RuntimeException');
        $this->adapter->getNumberOfRequestsFor('http://www.matthimatiker.de');
    }

    /**
     * Ensures that an exception is thrown if no preconfigured response is available.
     */
    public function testAdapterThrowsExceptionIfNoResponseIsAvailable()
    {
        $this->setExpectedException('RuntimeException');
        $this->adapter->setResponse(array());
        $this->request('http://localhost');
    }

    /**
     * Ensures that the adapter returns teh correct response even if the default
     * port was provided explicitly.
     */
    public function testAdapterReturnsCorrectResponseEvenIfDefaultPortIsProvidedExplicitly()
    {
        $this->adapter->addResponse($this->createResponse('Valid'), 'http://www.matthimatiker.de');
        $this->assertRequestedResponseContains('Valid', 'http://www.matthimatiker.de:80');
    }

    /**
     * Uses the adapter to request $url and asserts that the response
     * contains $expected.
     *
     * @param string $expected
     * @param string $url
     */
    protected function assertRequestedResponseContains( $expected, $url )
    {
        $response = $this->request($url);
        $this->assertType('Zend_Http_Response', $response);
        $this->assertContains($expected, $response->getBody());
    }

    /**
     * Uses the adapter to request the given url and returns
     * its response.
     *
     * Example:
     * <code>
     * $this->request('http://www.example.com/test.html');
     * </code>
     *
     * @param string $url
     * @return Zend_Http_Response
     */
    protected function request( $url )
    {
        $this->adapter->connect('');
        $this->adapter->write('GET', Zend_Uri_Http::fromString($url));
        $response = $this->adapter->read();
        $this->adapter->close();
        return Zend_Http_Response::fromString($response);
    }

    /**
     * Creates a response object with the provided body and http code.
     *
     * @param string $body
     * @param integer $code
     * @return Zend_Http_Response
     */
    protected function createResponse( $body, $code = 200 )
    {
        return new Zend_Http_Response($code, array(), $body);
    }

}

