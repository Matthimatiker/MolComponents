<?php

/**
 * Mol_Test_View_Helper_UrlTest
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Test
 * @subpackage Tests
 * @copyright Matthias Molitor 2011
 * @version $Rev: 440 $
 * @since 29.04.2011
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the url helper mock object.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Test
 * @subpackage Tests
 * @copyright Matthias Molitor 2011
 * @version $Rev: 440 $
 * @since 29.04.2011
 */
class Mol_Test_View_Helper_UrlTest extends PHPUnit_Framework_TestCase {
    
    /**
     * System under test.
     *
     * @var Mol_Test_View_Helper_Url
     */
    protected $helper = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp() {
        parent::setUp();
        $this->helper = new Mol_Test_View_Helper_Url();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown() {
        $this->helper = null;
        parent::tearDown();
    }
    
    /**
     * Checks if the generated url contains the option keys.
     */
    public function testGeneratedUrlContainsOptionKeys() {
        $url = $this->helper->url(array('a' => 'b', 'c' => 'd'));
        $this->assertContains('a', $url);
        $this->assertContains('c', $url);
    }
    
    /**
     * Checks if the generated url contains the option values.
     */
    public function testGeneratedUrlContainsOptionValues() {
        $url = $this->helper->url(array('a' => 'b', 'c' => 'd'));
        $this->assertContains('b', $url);
        $this->assertContains('d', $url);
    }
    
    /**
     * Ensures that the generated url contains the options in the same
     * order as they were provided.
     */
    public function testGeneratedUrlContainsOptionsInCorrectOrder() {
        $url = $this->helper->url(array('a' => 'b', 'c' => 'd'));
        $firstOptionPosition  = strpos($url, 'b');
        $secondOptionPosition = strpos($url, 'd');
        $this->assertType('integer', $firstOptionPosition, 'First option not found.');
        $this->assertType('integer', $secondOptionPosition, 'Second option not found.');
        $message = 'Url contains options in incorrect order.';
        $this->assertGreaterThan($firstOptionPosition, $secondOptionPosition, $message);
    }
    
    /**
     * Tests if getNumberOfCalls() returns the number of calls to the
     * entry method of the helper.
     */
    public function testGetNumberOfCallsReturnsTheNumberOfCallsToTheEntryMethod() {
        $this->helper->url();
        $this->helper->url();
        $this->assertEquals(2, $this->helper->getNumberOfCalls());
    }
    
    /**
     * Ensures that getParams() returns null if no data is available for
     * the requested helper call.
     */
    public function testGetParamsOfCallReturnsNullIfTheRequestedCallIsNotAvailable() {
        $this->assertNull($this->helper->getParamsOfCall(0));
    }
    
    /**
     * Tests if getParams() returns an array.
     */
    public function testGetParamsOfCallReturnsArray() {
        $this->helper->url();
        $this->assertType('array', $this->helper->getParamsOfCall(0));
    }
    
    /**
     * Ensures that the result of getParams() contains the options that
     * were used to call the helper.
     */
    public function testResultOfGetParamsOfCallContainsOptions() {
        $options = array('a' => 'b');
        $this->helper->url($options);
        $this->assertHelperParamEquals('urlOptions', $options);
    }
    
    /**
     * Ensures that the result of getParams() contains the name of the
     * route that was used to call the helper.
     */
    public function testResultOfGetParamsOfCallContainsRouteName() {
        $this->helper->url(array(), 'test');
        $this->assertHelperParamEquals('name', 'test');
    }
    
    /**
     * Ensures that the result of getParams() contains the reset flag
     * that was used to call the helper.
     */
    public function testResultOfGetParamsOfCallContainsResetFlag() {
        $this->helper->url(array(), null, true);
        $this->assertHelperParamEquals('reset', true);
    }
    
    /**
     * Ensures that the result of getParams() contains the encode flag
     * that was used to call the helper.
     */
    public function testResultOfGetParamsOfCallContainsEncodeFlag() {
        $this->helper->url(array(), null, true, false);
        $this->assertHelperParamEquals('encode', false);
    }
    
    /**
     * Asserts that the parameter list of the *first* helper call
     * contains $expected as value for the key $key.
     *
     * @param string $key
     * @param mixed $expected
     */
    protected function assertHelperParamEquals($key, $expected) {
        $params = $this->helper->getParamsOfCall(0);
        $this->assertType('array', $params);
        $this->assertArrayHasKey($key, $params);
        $this->assertEquals($expected, $params[$key]);
    }
    
}

?>