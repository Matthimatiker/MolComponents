<?php

/**
 * Mol_Test_WebControllerTestCaseTest
 *
 * @category PHP
 * @package Mol_Test
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 25.12.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the functionality of the WebControllerTestCase.
 *
 * @category PHP
 * @package Mol_Test
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 25.12.2012
 */
class Mol_Test_WebControllerTestCaseTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->loadAllSampleTestCases();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        
        parent::tearDown();
    }
    
    /**
     * Ensures that global variables ($_POST, $_GET, ...) are resetted.
     */
    public function testGlobalsFromRequestAreRemoved()
    {
        $test   = new Mol_Test_TestData_WebControllerTestCase_Globals('testManipulateGlobalVariables');
        $result = $test->run();
        $this->assertSuccessful($result);
        $this->assertArrayNotHasKey('global_get_variable', $_GET);
        $this->assertArrayNotHasKey('global_post_variable', $_POST);
    }
    
    /**
     * Checks if the action helpers are cleaned up correctly after
     * each test.
     */
    public function testActionHelpersAreResetted()
    {
        $previousHelpers = Zend_Controller_Action_HelperBroker::getExistingHelpers();
        
        $test   = new Mol_Test_TestData_WebControllerTestCase_Globals('testAddActionHelper');
        $result = $test->run();
        $this->assertSuccessful($result);
        
        $currentHelpers = Zend_Controller_Action_HelperBroker::getExistingHelpers();
        $this->assertEquals($previousHelpers, $currentHelpers);
    }
    
    /**
     * Checks if getControllerClass() returns the correct value.
     */
    public function testGetControllerClassReturnsCorrectValue()
    {
    
    }
    
    /**
     * Checks if getControllerName() returns the correct value.
     */
    public function testGetControllerNameReturnsCorrectValue()
    {
    
    }
    
    /**
     * Ensures that getModuleName() returns the correct value.
     */
    public function testGetModuleNameReturnsCorrectValue()
    {
    
    }
    
    /**
     * Checks if assertResponse() provides access to response related
     * assertions.
     */
    public function testAssertResponseProvidesResponseAssertions()
    {
        
    }
    
    /**
     * Ensures that the controller instance is directly available
     * after setup.
     */
    public function testControllerIsCreatedDuringSetup()
    {
        
    }
    
    /**
     * Checks if the bootstrapper is injected into the controller.
     */
    public function testBootstrapperIsInjectedIntoController()
    {
        
    }
    
    /**
     * Checks if a logger is injected into the bootstrapper per default.
     */
    public function testLoggerIsAvailableViaBootstrapper()
    {
        
    }
    
    /**
     * Ensures that the request object is initially marked as dispatched.
     */
    public function testRequestObjectIsInitiallyMarkedAsDispatched()
    {
        
    }
    
    /**
     * Checks if the request object contains the correct controller name.
     */
    public function testRequestObjectContainsCorrectControllerName()
    {
        
    }
    
    /**
     * Checks if the request object contains the correct module name.
     */
    public function testRequestObjectContainsCorrectModuleName()
    {
    
    }
    
    /**
     * Ensures that setPost() changes the method in the request object.
     */
    public function testSetPostChangesMethodInRequestObject()
    {
        
    }
    
    /**
     * Checks if setPost() injects the provided variables into the request.
     */
    public function testSetPostInjectsVariablesIntoRequestObject()
    {
        
    }
    
    /**
     * Checks if setPost() extracts variables from a provided form and
     * injects these values into the request.
     */
    public function testSetPostInjectsFormVariablesIntoRequestObject()
    {
        
    }
    
    /**
     * Ensures that setGet() changes the method in the request.
     */
    public function testSetGetChangesMethodInRequestObject()
    {
    
    }
    
    /**
     * Checks if setGet() injects the provided variables into the request.
     */
    public function testSetGetInjectsVariablesIntoRequestObject()
    {
    
    }
    
    /**
     * Checks if setUserParams() injects the provided variables correctly
     * into the request.
     */
    public function testSetUserParamsInjectsVariablesIntoRequestObject()
    {
        
    }
    
    /**
     * Asserts that the given result belongs to a test that was
     * executed successfully.
     *
     * @param PHPUnit_Framework_TestResult $result
     */
    protected function assertSuccessful(PHPUnit_Framework_TestResult $result)
    {
        $message = '';
        foreach ($result->errors() as $error) {
            /* @var $error PHPUnit_Framework_TestFailure */
            $message .= $error->getExceptionAsString() . PHP_EOL;
        }
        foreach ($result->failures() as $failure) {
            /* @var $failure PHPUnit_Framework_TestFailure */
            $message .= $failure->getExceptionAsString() . PHP_EOL;
        }
        $this->assertTrue($result->wasSuccessful(), $message);
    }
    
    /**
     * Loads all prepared test cases that are used to check the
     * WebControllerTestCase class.
     */
    protected function loadAllSampleTestCases()
    {
        $path = dirname(__FILE__) . '/TestData/WebControllerTestCase';
        foreach (glob($path . '/*.php') as $file) {
            require_once($file);
        }
    }
    
}
