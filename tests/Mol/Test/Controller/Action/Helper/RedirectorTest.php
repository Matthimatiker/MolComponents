<?php

/**
 * Mol_Test_Controller_Action_Helper_RedirectorTest
 *
 * @category PHP
 * @package Mol_Test
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 14.01.2013
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the Redirector action helper that is used in controller tests.
 *
 * @category PHP
 * @package Mol_Test
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 14.01.2013
 */
class Mol_Test_Controller_Action_Helper_RedirectorTest extends PHPUnit_Framework_TestCase
{

    /**
     * Backup globals as these might be changed by the used
     * request and response objects.
     *
     * @var boolean
     */
    protected $backupGlobals = true;
    
    /**
     * System under test.
     *
     * @var Mol_Test_Controller_Action_Helper_Redirector
     */
    protected $redirector = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->redirector = new Mol_Test_Controller_Action_Helper_Redirector();
        $this->redirector->setActionController($this->createController());
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->redirector = null;
        parent::tearDown();
    }
    
    /**
     * Checks if getName() returns the expected value.
     */
    public function testGetNameReturnsCorrectValue()
    {
        $this->assertEquals('Redirector', $this->redirector->getName());
    }
    
    /**
     * Checks if calling exit() is disabled per default, as it
     * would stop the whole test run.
     */
    public function testExitIsDisabledPerDefault()
    {
        $this->assertFalse($this->redirector->getExit());
    }
    
    /**
     * Ensures that it is not possible to enable calls to exit().
     */
    public function testExitCannotBeEnabled()
    {
        $this->setExpectedException('Mol_Test_Exception');
        $this->redirector->setExit(true);
    }
    
    /**
     * Checks if setGotoSimple() uses the controller name from the request
     * if it is omitted.
     */
    public function testSetGotoSimpleUsesControllerFromRequestIfNotProvided()
    {
        $this->redirector->setGotoSimple('target-action');
        $url = $this->redirector->getRedirectUrl();
        $this->assertContains('my-controller', $url);
    }
    
    /**
     * Checks if setGotoSimple() uses the module name from the request
     * if it is omitted.
     */
    public function testSetGotoSimpleUsesModuleFromRequestIfNotProvided()
    {
        $this->redirector->setGotoSimple('target-action');
        $url = $this->redirector->getRedirectUrl();
        $this->assertContains('my-module', $url);
    }
    
    /**
     * Checks if setGotoSimple() generates a simple url.
     */
    public function testSetGotSimpleGeneratesSimpleUrl()
    {
        $params = array('key' => 'value');
        $this->redirector->setGotoSimple('target-action', 'target-controller', 'target-module', $params);
        $url = $this->redirector->getRedirectUrl();
        $this->assertEquals('/target-module/target-controller/target-action/key/value', $url);
    }
    
    /**
     * Ensures that setGotoSimple() orders the given parameters by key.
     *
     * This ensures that the generated url does not depend on the order
     * in which the parameters are passed.
     */
    public function testSetGotoSimpleOrdersParametersInUrlByKey()
    {
        $params = array('key-beta' => 'x', 'key-alpha' => 'y');
        $this->redirector->setGotoSimple('target-action', 'target-controller', 'target-module', $params);
        $url = $this->redirector->getRedirectUrl();
        $keyAlphaPosition = strpos($url, 'key-alpha');
        $keyBetaPosition  = strpos($url, 'key-beta');
        $this->assertGreaterThan($keyAlphaPosition, $keyBetaPosition, 'Key beta found before key alpha.');
    }
    
    /**
     * Checks if setGotoRoute() generates a simple url.
     */
    public function testSetGotoRouteGeneratesSimpleUrl()
    {
        $params = array(
            'module'     => 'target-module',
            'controller' => 'target-controller',
            'action'     => 'target-action',
            'key'        => 'value'
        );
        $this->redirector->setGotoRoute($params);
        $url = $this->redirector->getRedirectUrl();
        $this->assertEquals('/target-module/target-controller/target-action/key/value', $url);
    }
    
    /**
     * Ensures that access to the front controller is rejected as it
     * iis a global dependency.
     */
    public function testHelperDoesNotAllowAccessToFrontController()
    {
        $this->setExpectedException('Mol_Test_Exception');
        $this->redirector->getFrontController();
    }
    
    /**
     * Ensures that it is not possible to call redirectAndExit() as it
     * would terminate the whole test run.
     */
    public function testHelperDoesNotAllowCallsToRedirectAndExit()
    {
        $this->setExpectedException('Mol_Test_Exception');
        $this->redirector->redirectAndExit();
    }
    
    /**
     * Creates a controller for testing.
     *
     * @return Zend_Controller_Action
     */
    protected function createController()
    {
        $request = new Zend_Controller_Request_HttpTestCase();
        $request->setModuleName('my-module');
        $request->setControllerName('my-controller');
        $request->setActionName('my-action');
        $response = new Zend_Controller_Response_HttpTestCase();
        return $this->getMock('Zend_Controller_Action', null, array($request, $response));
    }
    
}
