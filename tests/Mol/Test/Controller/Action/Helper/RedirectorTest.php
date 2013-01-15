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
        
    }
    
    /**
     * Ensures that it is not possible to enable calls to exit().
     */
    public function testExitCannotBeEnabled()
    {
        
    }
    
    /**
     * Checks if setGotoSimple() uses the controller name from the request
     * if it is omitted.
     */
    public function testSetGotoSimpleUsesControllerFromRequestIfNotProvided()
    {
        
    }
    
    /**
     * Checks if setGotoSimple() uses the module name from the request
     * if it is omitted.
     */
    public function testSetGotoSimpleUsesModuleFromRequestIfNotProvided()
    {
    
    }
    
    /**
     * Checks if setGotoSimple() generates a simple url.
     */
    public function testSetGotSimpleGeneratesSimpleUrl()
    {
        
    }
    
    /**
     * Ensures that setGotoSimple() orders the given parameters by key.
     *
     * This ensures that the generated url does not depend on the order
     * in which the parameters are passed.
     */
    public function testSetGotoSimpleOrdersParametersInUrlByKey()
    {
        
    }
    
    /**
     * Checks if setGotoRoute() generates a simple url.
     */
    public function testSetGotoRouteGeneratesSimpleUrl()
    {
        
    }
    
    /**
     * Ensures that access to the front controller is rejected as it
     * iis a global dependency.
     */
    public function testHelperDoesNotAllowAccessToFrontController()
    {
        
    }
    
    /**
     * Ensures that it is not possible to call redirectAndExit() as it
     * would terminate the whole test run.
     */
    public function testHelperDoesNotAllowCallsToRedirectAndExit()
    {
        
    }
    
    /**
     * Creates a controller for testing.
     *
     * @return Zend_Controller_Action
     */
    protected function createController()
    {
        $request  = new Zend_Controller_Request_HttpTestCase();
        $response = new Zend_Controller_Response_HttpTestCase();
        return $this->getMock('Zend_Controller_Action', null, array($request, $response));
    }
    
}
