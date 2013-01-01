<?php

/**
 * Mol_Test_WebControllerTestCaseTest
 *
 * @category PHP
 * @package Mol_Test
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.01.2013
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Loads the controller class that is used in this test case.
 */
require_once(dirname(__FILE__) . '/TestData/WebControllerTestCase/InternalController.php');

/**
 * Extends the Mol_Test_WebControllerTestCase and checks its functionality
 * from an internal popint of view.
 *
 * @category PHP
 * @package Mol_Test
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.01.2013
 */
class Mol_Test_WebControllerTestCaseTest extends Mol_Test_WebControllerTestCase
{
    
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
     * Defines the controller that is used in the tests.
     *
     * @return string
     */
    public function getControllerClass()
    {
        return 'WebControllerTestCase_InternalController';
    }
    
}
