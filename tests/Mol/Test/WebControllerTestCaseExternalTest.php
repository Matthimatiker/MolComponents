<?php

/**
 * Mol_Test_WebControllerTestCaseExternalTest
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
 * Tests the functionality of the WebControllerTestCase externally.
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
class Mol_Test_WebControllerTestCaseExternalTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Names of helpers that must be removed in tear down.
     *
     * @var array(string)
     */
    protected $helpersToRemove = array();
    
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
        foreach ($this->helpersToRemove as $name) {
            /* @var $name string */
            Zend_Controller_Action_HelperBroker::removeHelper($name);
        }
        parent::tearDown();
    }
    
    /**
     * Ensures that global variables ($_POST, $_GET, ...) are resetted.
     */
    public function testGlobalsFromRequestAreRemoved()
    {
        $test   = $this->createTestCase('testManipulateGlobalVariables');
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
        
        $test   = $this->createTestCase('testAddActionHelper');
        $result = $test->run();
        $this->assertSuccessful($result);
        
        $currentHelpers = Zend_Controller_Action_HelperBroker::getExistingHelpers();
        $this->assertEquals($previousHelpers, $currentHelpers);
    }
    
    /**
     * Ensures that previously added action helpers are not removed.
     */
    public function testPreviousActionHelpersAreNotRemoved()
    {
        $helper = $this->createActionHelper('TestHelper');
        $this->addActionHelper($helper);
        
        $test   = $this->createTestCase('testNothing');
        $result = $test->run();
        $this->assertSuccessful($result);
        
        $message = 'Helper "' . $helper->getName() . '" was removed.';
        $this->assertTrue(Zend_Controller_Action_HelperBroker::hasHelper($helper->getName()), $message);
    }
    
    /**
     * Checks if getControllerClass() returns the correct value.
     */
    public function testGetControllerClassReturnsCorrectValue()
    {
        $test = $this->createTestCase('testNothing');
        $this->assertEquals('Mol_Test_TestData_WebControllerTestCase_GlobalsController', $test->getControllerClass());
    }
    
    /**
     * Ensures that the test initialization fails if the controller class does not exist
     * and is not loadable.
     */
    public function testInitializationFailsIfControllerClassDoesNotExist()
    {
        $test   = $this->createTestCase('testNothing', 'Missing_Controller_Class');
        $result = $test->run();
        $this->assertFailed($result);
    }
    
    /**
     * Ensures that the test initialization fails if the controller class does not extend
     * Zend_Controller_Action.
     */
    public function testInitializationFailsIfControllerClassDoesNotExtendZendBaseClass()
    {
        $test   = $this->createTestCase('testNothing', 'stdClass');
        $result = $test->run();
        $this->assertFailed($result);
    }
    
    /**
     * Ensures that the test initialization fails if the file that is provided
     * by getControllerPath() does not contain the expected controller class.
     */
    public function testInitializationFailsIfProvidedFileDoesNotContainExpectedControllerClass()
    {
        $path   = dirname(__FILE__) . '/TestData/WebControllerTestCase/GlobalsController.php';
        $test   = $this->createTestCase('testNothing', 'Missing_Controller_Class', $path);
        $result = $test->run();
        $this->assertFailed($result);
    }
    
    /**
     * Ensures that the test case removes identities that were changed
     * during test execution.
     */
    public function testChangedIdentityIsRemoved()
    {
        $test   = $this->createTestCase('testChangeIdentity');
        $result = $test->run();
        $this->assertSuccessful($result);
        $this->assertNotEquals('another identity', Zend_Auth::getInstance()->getIdentity());
    }
    
    /**
     * Creates a test case for the provided controller class.
     *
     * @param string $testName The name of the test that will be executed.
     * @param string|null $controllerClass
     * @param string|null $controllerPath
     * @return Mol_Test_TestData_WebControllerTestCase_GlobalsControllerTest
     */
    protected function createTestCase($testName, $controllerClass = null, $controllerPath = null)
    {
        // Determine methods that must be mocked.
        $methodsToReturnValue = array();
        if ($controllerClass !== null) {
            $methodsToReturnValue['getControllerClass'] = $controllerClass;
        }
        if ($controllerPath !== null) {
            $methodsToReturnValue['getControllerPath'] = $controllerPath;
        }
        
        // Finish early if no mock object is required.
        if (count($methodsToReturnValue) === 0) {
            return new Mol_Test_TestData_WebControllerTestCase_GlobalsControllerTest($testName);
        }
        
        // Create mocked test case.
        $testClass = 'Mol_Test_TestData_WebControllerTestCase_GlobalsControllerTest';
        $arguments = array($testName);
        $test      = $this->getMock($testClass, array_keys($methodsToReturnValue), $arguments);
        
        // Define behavior of mocked method.
        foreach ($methodsToReturnValue as $method => $returnValue) {
            /* @var $method string */
            /* @var $returnValue string */
            $test->expects($this->any())
                 ->method($method)
                 ->will($this->returnValue($returnValue));
        }
        
        return $test;
    }
    
    /**
     * Creates a mocked action helper with the provided name.
     *
     * @param string $name
     * @return Zend_Controller_Action_Helper_Abstract
     */
    protected function createActionHelper($name)
    {
        $helper = $this->getMock('Zend_Controller_Action_Helper_Abstract', array('getName'));
        $helper->expects($this->any())
               ->method('getName')
               ->will($this->returnValue($name));
        return $helper;
    }
    
    /**
     * Adds the given action  helper to the broker.
     *
     * @param Zend_Controller_Action_Helper_Abstract $helper
     */
    protected function addActionHelper(Zend_Controller_Action_Helper_Abstract $helper)
    {
        $this->helpersToRemove[] = $helper->getName();
        Zend_Controller_Action_HelperBroker::addHelper($helper);
        $message = 'Helper "' . $helper->getName() . '" was not added.';
        $this->assertTrue(Zend_Controller_Action_HelperBroker::hasHelper($helper->getName()), $message);
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
     * Asserts that the given result belongs to a test that failed.
     *
     * @param PHPUnit_Framework_TestResult $result
     */
    protected function assertFailed(PHPUnit_Framework_TestResult $result)
    {
        $message = 'Test was expected to fail, but it was executed successfully.';
        $this->assertFalse($result->wasSuccessful(), $message);
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
