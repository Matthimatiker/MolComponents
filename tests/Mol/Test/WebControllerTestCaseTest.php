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
        $this->assertSame($this->bootstrapper, $this->controller->getInvokeArg('bootstrap'));
    }
    
    /**
     * Checks if a logger is injected into the bootstrapper per default.
     */
    public function testLoggerIsAvailableViaBootstrapper()
    {
        $this->assertInstanceOf('Zend_Log', $this->bootstrapper->getResource('log'));
    }
    
    /**
     * Checks if the view is injected into the bootstrapper per default.
     */
    public function testViewIsAvailableViaBootstrapper()
    {
        $this->assertInstanceOf('Zend_View', $this->bootstrapper->getResource('view'));
    }
    
    /**
     * Checks if the layout is injected into the bootstrapper per default.
     */
    public function testLayoutIsAvailableViaBootstrapper()
    {
        $this->assertInstanceOf('Zend_Layout', $this->bootstrapper->getResource('layout'));
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
        $this->assertEquals('POST', $this->request->getMethod());
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
     * Ensures that parameters that were passed to the request object via
     * setPost() are not overwritten if setPost() is called again.
     */
    public function testParametersFromPreviousSetPostCallsAreNotOverwritten()
    {
        $this->setPost(array('first' => 'here'));
        $this->setPost(array('second' => 'there'));
        $this->assertEquals('here', $this->request->getPost('first'));
    }
    
    /**
     * Ensures that setGet() changes the method in the request.
     */
    public function testSetGetChangesMethodInRequestObject()
    {
        $this->request->setMethod('POST');
        $this->setGet(array('key' => 'value'));
        $this->assertEquals('GET', $this->request->getMethod());
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
     * Ensures that parameters that were passed to the request object via
     * setGet() are not overwritten if setGet() is called again.
     */
    public function testParametersFromPreviousSetGetCallsAreNotOverwritten()
    {
        $this->setGet(array('first' => 'here'));
        $this->setGet(array('second' => 'there'));
        $this->assertEquals('here', $this->request->getQuery('first'));
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
     * Ensures that assertNumberOfLogEntries() fails if the expected number of entries
     * is not correct.
     */
    public function testAssertNumberOfLogEntriesFailsIfUnexpectedNumberOfLogMessagesIsDetected()
    {
        /* @var $logger Zend_Log */
        $logger = $this->bootstrapper->getResource('log');
        $this->assertInstanceOf('Zend_Log', $logger);
        $logger->log('Test', Zend_Log::INFO);
        
        $this->setExpectedException('PHPUnit_Framework_AssertionFailedError');
        $this->assertNumberOfLogEntries(2);
    }
    
    /**
     * Ensures that assertNumberOfLogEntries() succeeds if the provided number of expected
     * entries is correct.
     */
    public function testAssertNumberOfLogEntriesSucceedsIfNumberOfLogEntriesIsCorrect()
    {
        /* @var $logger Zend_Log */
        $logger = $this->bootstrapper->getResource('log');
        $this->assertInstanceOf('Zend_Log', $logger);
        $logger->log('Test', Zend_Log::INFO);
        
        $this->setExpectedException(null);
        $this->assertNumberOfLogEntries(1);
    }
    
    /**
     * Ensures that dispatch() simulates the whole controller life cycle.
     */
    public function testDispatchExecutesTheControllerLifeCycle()
    {
        $this->dispatch('edit-user');
        $this->assertInstanceOf($this->getControllerClass(), $this->controller);
        $expectedCalls = array(
            'init',
            'preDispatch',
            'editUserAction',
            'postDispatch'
        );
        $calledMethods = $this->controller->getCalledMethods();
        $this->assertEquals($expectedCalls, $calledMethods);
    }
    
    /**
     * Ensures that no identity is set per default.
     */
    public function testIdentityIsNotSetPerDefault()
    {
        $this->assertFalse(Zend_Auth::getInstance()->hasIdentity());
    }
    
    /**
     * Checks if the getIdentity() method of the authentication class
     * returns null per default.
     */
    public function testIdentityIsNullPerDefault()
    {
        $this->assertNull(Zend_Auth::getInstance()->getIdentity());
    }
    
    /**
     * Checks if setIdentity() simulates the provided identity.
     */
    public function testSetIdentitySimulatesIdentity()
    {
        $this->setIdentity('my identity');
        $this->assertEquals('my identity', Zend_Auth::getInstance()->getIdentity());
    }
    
    /**
     * Ensures that passing null to setIdentity() removes the previous
     * identity.
     */
    public function testSetIdentityRemovesIdentityIfNullIsPassed()
    {
        $this->setIdentity('first identity');
        $this->setIdentity(null);
        $this->assertFalse(Zend_Auth::getInstance()->hasIdentity());
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
