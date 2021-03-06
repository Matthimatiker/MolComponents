<?php

/**
 * Mol_View_Helper_Value_UrlTest
 *
 * @category PHP
 * @package Mol_View
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 21.10.2010
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the Mol_View_Helper_Value_Url class.
 *
 * @category PHP
 * @package Mol_View
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 21.10.2010
 */
class Mol_View_Helper_Value_UrlTest extends PHPUnit_Framework_TestCase
{
    /**
     * System under test.
     *
     * @var Mol_View_Helper_Value_Url
     */
    protected $url = null;

    /**
     * The view that is used by the helper object.
     *
     * @var Zend_View
     */
    protected $view = null;

    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->view = $this->createView();
        $this->url  = new Mol_View_Helper_Value_Url($this->view);
    }

    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->view = null;
        $this->url  = null;
        parent::tearDown();
    }

    /**
     * Creates a pre-configured view object.
     *
     * @return Zend_View
     */
    protected function createView()
    {
        $view = new Zend_View();
        $urlHelper = new Mol_Test_View_Helper_Url();
        $view->registerHelper($urlHelper, 'url');
        return $view;
    }

    /**
     * Tests if withParam() provides a fluent interface.
     */
    public function testWithParamProvidesFluentInterface()
    {
        $this->assertSame($this->url, $this->url->withParam('hello', 'world'));
    }

    /**
     * Tests if withRoute() provides a fluent interface.
     */
    public function testWithRouteProvidesFluentInterface()
    {
        $this->assertSame($this->url, $this->url->withRoute('test'));
    }

    /**
     * Tests if withAnchor() provides a fluent interface.
     */
    public function testWithAnchorProvidesFluentInterface()
    {
        $this->assertSame($this->url, $this->url->withAnchor('test'));
    }

    /**
     * Tests if keepParams() provides a fluent interface.
     */
    public function testKeepParamsProvidesFluentInterface()
    {
        $this->assertSame($this->url, $this->url->keepParams());
    }

    /**
     * Tests if __toString() returns a string.
     */
    public function testToStringReturnsString()
    {
        $this->assertInternalType('string', (string)$this->url);
    }

    /**
     * Tests if the Zend url view helper is called exactly once to
     * generate the url.
     */
    public function testToStringCallsUrlHelperExactlyOnce()
    {
        (string)$this->url;
        $this->assertEquals(1, $this->getNumberOfHelperCalls());
    }

    /**
     * Ensures that the url does not contain a hash ("#") of no anchor
     * was specified.
     */
    public function testUrlDoesNotEndWithHashIfAnchorWasNotSpecified()
    {
        $this->assertStringEndsNotWith('#', (string)$this->url);
    }

    /**
     * Tests if the generated url ends with the provided anchor.
     */
    public function testUrlEndsWithSpecifiedAnchor()
    {
        $this->url->withAnchor('test');
        $this->assertStringEndsWith('#test', (string)$this->url);
    }

    /**
     * Ensures that the last anchor is used if withAnchor() was called
     * multiple times.
     */
    public function testIfWithAnchorIsCalledMoreThanOnceOnlyTheLastAnchorIsUsed()
    {
        $this->url->withAnchor('hello');
        $this->url->withAnchor('world');
        $this->assertStringEndsWith('#world', (string)$this->url);
    }

    /**
     * Ensure that the last parameter is used if the same parameter
     * is specified multiple times via withParam().
     */
    public function testIfSameParamIsAddedMoreThanOnceOnlyTheLastParamIsUsed()
    {
        $this->url->withParam('name', 'foo');
        $this->url->withParam('name', 'bar');
        $url = (string)$this->url;
        $this->assertContains('bar', $url);
        $this->assertNotContains('foo', $url);
    }

    /**
     * Tests if the url contains all provided parameters.
     */
    public function testUrlContainsAllAddedParams()
    {
        $this->url->withParam('firstName', 'Matthias');
        $this->url->withParam('lastName', 'Molitor');
        $url = (string)$this->url;
        // Ensure that the url contains the parameter values.
        $this->assertContains('Matthias', $url);
        $this->assertContains('Molitor', $url);
        // Ensure that the url contains the parameter names.
        $this->assertContains('firstName', $url);
        $this->assertContains('lastName', $url);
    }

    /**
     * Tests if the provided url is passed to the Zend url view helper.
     */
    public function testRouteSpecifiedByWithRouteIsUsed()
    {
        $this->url->withRoute('test');
        (string)$this->url;
        $params = $this->getParamsOfLastHelperCall();
        $this->assertEquals('test', $params['name']);
    }
    
    /**
     * Checks if withRoute() accepts null and passes that value
     * to the url helper.
     */
    public function testNullIsAcceptedAsRoute()
    {
        $this->url->withRoute(null);
        (string)$this->url;
        $params = $this->getParamsOfLastHelperCall();
        $this->assertNull($params['name']);
    }

    /**
     * Ensures that the correct reset flag is passed to the Zend url view helper
     * if keepParams() was called.
     */
    public function testParamsAreNotResettedIfKeepParamsWasCalled()
    {
        $this->url->keepParams();
        (string)$this->url;
        $params = $this->getParamsOfLastHelperCall();
        $this->assertFalse($params['reset']);
    }
    
    /**
     * Checks if withQuery() provides a fluent interface.
     */
    public function testWithQueryProvidesFluentInterface()
    {
        $this->assertSame($this->url, $this->url->withQuery('key', 'value'));
    }
    
    /**
     * Checks if withQuery() adds the given parameters to the url.
     */
    public function testWithQueryAddsParametersToUrl()
    {
        $this->url->withQuery('first', 'alpha');
        $this->url->withQuery('second', 'beta');
        $url = (string)$this->url;
        $this->assertContains('first=alpha', $url);
        $this->assertContains('second=beta', $url);
    }
    
    /**
     * Checks if query parameters are url encoded.
     */
    public function testWithQueryEncodesValue()
    {
        $this->url->withQuery('greeting', 'hello world');
        $this->assertContains(urlencode('hello world'), (string)$this->url);
    }
    
    /**
     * Ensures that the anchor is added after the query parameters.
     */
    public function testAnchorIsAddedAfterQuery()
    {
        $this->url->withQuery('key', 'value');
        $this->url->withAnchor('test');
        $url = (string)$this->url;
        $this->assertGreaterThan(strpos($url, '?'), strpos($url, '#'));
    }
    
    /**
     * Ensures that the query part is omitted if no query parameters
     * were provided.
     */
    public function testQueryPartIsOmittedIfNoQueryParamsWereProvided()
    {
        $this->assertNotContains('?', (string)$this->url);
    }

    /**
     * Returns the mocked url helper.
     *
     * @return Mol_Test_View_Helper_Url
     */
    private function getHelper()
    {
        return $this->view->getHelper('Url');
    }

    /**
     * Returns the number of calls to the url helper.
     *
     * @return integer
     */
    private function getNumberOfHelperCalls()
    {
        return $this->getHelper()->getNumberOfCalls();
    }

    /**
     * Returns the parameters that were passed to the url helper on its last call.
     *
     * @return array(string=>mixed)
     * @throws RuntimeException If the requested call data is not available.
     */
    private function getParamsOfLastHelperCall()
    {
        $calls  = $this->getNumberOfHelperCalls();
        $params = $this->getHelper()->getParamsOfCall($calls - 1);
        if ($params === null) {
            throw new RuntimeException('No params for helper call #' . ($calls - 1) . ' available.');
        }
        return $params;
    }

}

