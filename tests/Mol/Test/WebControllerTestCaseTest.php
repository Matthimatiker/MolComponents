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
        $this->assertEquals('internal', $this->getControllerName());
    }
    
    /**
     * Ensures that getModuleName() returns the correct value.
     */
    public function testGetModuleNameReturnsCorrectValue()
    {
        $this->assertEquals('web-controller-test-case', $this->getModuleName());
    }
    
    /**
     * Checks if assertResponse() provides access to response related
     * assertions.
     */
    public function testAssertResponseProvidesResponseAssertions()
    {
        $this->assertInstanceOf('Mol_Test_Assertions_HttpResponse', $this->assertResponse());
    }
    
    /**
     * Ensures that the controller instance is directly available
     * after setup.
     */
    public function testControllerIsCreatedDuringSetup()
    {
        $this->assertNotNull($this->controller);
    }
    
    /**
     * Checks if the test case creates a controller of the type that is
     * provided via getControllerClass().
     */
    public function testTestCaseCreatesControllerOfCorrectType()
    {
        $this->assertInstanceOf($this->getControllerClass(), $this->controller);
    }
    
    /**
     * Checks if the bootstrapper is injected into the controller.
     */
    public function testBootstrapperIsInjectedIntoController()
    {
        $this->assertNotNull($this->controller);
        $this->assertSame($this->bootstrapper, $this->controller->getInvokeArg('bootstrap'));
    }
    
    /**
     * Checks if a logger is injected into the bootstrapper per default.
     */
    public function testLoggerIsAvailableViaBootstrapper()
    {
        $this->assertNotNull($this->bootstrapper);
        $this->assertInstanceOf('Zend_Log', $this->bootstrapper->getResource('logger'));
    }
    
    /**
     * Ensures that the request object is initially marked as dispatched.
     */
    public function testRequestObjectIsInitiallyMarkedAsDispatched()
    {
        $this->assertTrue($this->request->isDispatched());
    }
    
    /**
     * Checks if the request object contains the correct controller name.
     */
    public function testRequestObjectContainsCorrectControllerName()
    {
        $this->assertEquals($this->getControllerName(), $this->request->getControllerName());
    }
    
    /**
     * Checks if the request object contains the correct module name.
     */
    public function testRequestObjectContainsCorrectModuleName()
    {
        $this->assertEquals($this->getModuleName(), $this->request->getModuleName());
    }
    
    /**
     * Ensures that setPost() changes the method in the request object.
     */
    public function testSetPostChangesMethodInRequestObject()
    {
        $this->request->setMethod('GET');
        $this->setPost(array('key' => 'value'));
        $this->assertTrue($this->request->isPost());
    }
    
    /**
     * Checks if setPost() injects the provided variables into the request.
     */
    public function testSetPostInjectsVariablesIntoRequestObject()
    {
        $this->setPost(array('key' => 'value'));
        $this->assertEquals('value', $this->request->getPost('key'));
    }
    
    /**
     * Checks if setPost() extracts variables from a provided form and
     * injects these values into the request.
     */
    public function testSetPostInjectsFormVariablesIntoRequestObject()
    {
        $this->setPost($this->createForm());
        $this->assertEquals('value', $this->request->getPost('key'));
    }
    
    /**
     * Ensures that setGet() changes the method in the request.
     */
    public function testSetGetChangesMethodInRequestObject()
    {
        $this->request->setMethod('POST');
        $this->setGet(array('key' => 'value'));
        $this->assertTrue($this->request->isGet());
    }
    
    /**
     * Checks if setGet() injects the provided variables into the request.
     */
    public function testSetGetInjectsVariablesIntoRequestObject()
    {
        $this->setGet(array('key' => 'value'));
        $this->assertEquals('value', $this->request->getQuery('key'));
    }
    
    /**
     * Checks if setGet() extracts variables from a provided form and
     * injects these values into the request.
     */
    public function testSetGetInjectsFormVariablesIntoRequestObject()
    {
        $this->setGet($this->createForm());
        $this->assertEquals('value', $this->request->getQuery('key'));
    }
    
    /**
     * Checks if setUserParams() injects the provided variables correctly
     * into the request.
     */
    public function testSetUserParamsInjectsVariablesIntoRequestObject()
    {
        $this->setUserParams(array('key' => 'value'));
        $this->assertEquals('value', $this->request->getUserParam('key'));
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
    
    /**
     * Creates a form for testing.
     *
     * The form contains a text element named "key" whose
     * value is set to "value".
     *
     * @return Zend_Form
     */
    protected function createForm()
    {
        $form = new Zend_Form();
        $form->addElement('text', 'key');
        $form->addElement('submit', 'send');
        $form->setDefaults(array('key' => 'value'));
        return $form;
    }
    
}
