<?php

/**
 * Mol_Controller_ActionParameterTest
 *
 * @category PHP
 * @package Mol_Controller
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 16.12.2010
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Load mock controller that is used for testing.
 */
require_once(dirname(__FILE__) . '/TestData/MockController.php');

/**
 * Tests the Mol_Controller_ActionParameter controller.
 *
 * @category PHP
 * @package Mol_Controller
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 16.12.2010
 */
class Mol_Controller_ActionParameterTest extends PHPUnit_Framework_TestCase
{
    /**
     * Index for the first argument.
     */
    const FIRST_ARGUMENT = 0;

    /**
     * Index for the second argument.
     */
    const SECOND_ARGUMENT = 1;

    /**
     * Index for the third argument.
     */
    const THIRD_ARGUMENT = 2;

    /**
     * System under test.
     *
     * @var Mol_Controller_ActionParameterTest_MockController
     */
    protected $controller = null;

    /**
     * The request object that is used for testing.
     *
     * @var Zend_Controller_Request_Http
     */
    protected $request = null;

    /**
     * The response object that is used for testing.
     *
     * @var Zend_Controller_Response_HttpTestCase
     */
    protected $response = null;

    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        Zend_Controller_Action_HelperBroker::resetHelpers();
        $this->request    = new Zend_Controller_Request_Http();
        $this->response   = new Zend_Controller_Response_HttpTestCase();
        $this->controller = new Mol_Controller_ActionParameterTest_MockController($this->request, $this->response);
    }

    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->controller = null;
        $this->request    = null;
        $this->response   = null;
        Zend_Controller_Action_HelperBroker::resetHelpers();
        parent::tearDown();
    }

    /**
     * Injects the parameter $name with the value $value into the request object.
     *
     * The parameter value will be casted to a string, because that is the way the
     * controller usally receives the request values.
     *
     * @param string $name
     * @param mixed $value
     */
    protected function simulateParam($name, $value)
    {
        $this->request->setParam($name, $this->convertToString($value));
    }

    /**
     * Converts $value to string to simulate the parameter transfer via
     * GET or POST.
     *
     * @param mixed $param
     * @return string|array(string)
     */
    private function convertToString($param)
    {
        if (is_array($param)) {
            // Convert all elements to string.
            foreach ($param as $key => $value ) {
                $param[$key] = $this->convertToString($value);
            }
            return $param;
        }
        return (string)$param;
    }

    /**
     * Simulates the dispatch process of the action named $action.
     *
     * @param string $action
     */
    protected function dispatch($action)
    {
        $this->request->setDispatched(true);
        $actionMethod = $this->actionNameToMethod($action);
        $this->controller->dispatch($actionMethod);
    }

    /**
     * Ensures that action without parameters are dispatched like before (backward compability).
     */
    public function testDispatchIsBackwardCompatible()
    {
        $this->dispatch('foo');
        $this->assertActionCall('foo');
    }

    /**
     * Ensures that an exception is thrown if a required parameter is missing.
     */
    public function testDispatchThrowsExceptionIfRequiredParameterIsMissing()
    {
        $this->setExpectedException('Mol_Controller_Exception_ParameterMissing');
        // The required parameter "count" was not provided.
        $this->dispatch('required-parameter');
    }

    /**
     * Ensures that an action is executed if the required parameter is
     * provided.
     */
    public function testDispatchCallsActionIfRequiredParameterIsAvailable()
    {
        $this->simulateParam('count', '42');
        $this->dispatch('required-parameter');
        $this->assertActionCall('required-parameter');
    }

    /**
     * Ensures that an exception is thrown if the provided parameter does
     * not match the documented type.
     */
    public function testDispatchThrowsExceptionIfParameterIsNotValid()
    {
        $this->setExpectedException('Mol_Controller_Exception_ParameterNotValid');
        $this->simulateParam('count', 'zweiundvierzig');
        $this->dispatch('required-parameter');
    }

    /**
     * Ensures that the parameter is casted to the type that is doumented
     * in the DocBlock.
     */
    public function testParameterIsConvertedToDocumentedType()
    {
        $this->simulateParam('count', '42');
        $this->dispatch('required-parameter');
        $this->assertActionArgumentHasType('required-parameter', self::FIRST_ARGUMENT, 'integer');
    }

    /**
     * Ensures that the argument passed to the action has the correct value.
     */
    public function testParameterHasProvidedValue()
    {
        $this->simulateParam('count', '42');
        $this->dispatch('required-parameter');
        $this->assertActionArgumentEquals('required-parameter', self::FIRST_ARGUMENT, 42);
    }

    /**
     * Ensures that an action with optional parameter is callable if the parameter
     * is not provided.
     */
    public function testActionWithOptionalParameterIsCalledEvenIfParameterIsNotAvailable()
    {
        $this->dispatch('optional-parameter');
        $this->assertActionCall('optional-parameter');
    }

    /**
     * Ensures that the documented default value is passed to the action if
     * the parameter was not provided.
     */
    public function testDefaultValueIsProvidedIfOptionalParameterIsMissing()
    {
        $this->dispatch('optional-parameter');
        $this->assertActionArgumentEquals('optional-parameter', self::FIRST_ARGUMENT, 'Hello World!');
    }

    /**
     * Ensures that an action with optional parameter is callable if the parameter
     * is provided.
     */
    public function testActionWithOptionalParameterIsCalledWhenParameterIsAvailable()
    {
        $this->simulateParam('text', 'Test first!');
        $this->dispatch('optional-parameter');
        $this->assertActionCall('optional-parameter');
    }

    /**
     * Ensures that an exception is thrown if no validator is available for
     * the documented type.
     */
    public function testControllerThrowsExceptionIfDocumentedTypeIsUnknown()
    {
        $this->setExpectedException('Mol_Controller_Exception_ParameterNotValid');
        $this->simulateParam('unknown', 'Darf ich mich vorstellen?');
        $this->dispatch('unknown-type');
    }

    /**
     * Ensures that calls to undefined actions are handled by __call().
     */
    public function testUndefinedActionsAreHandledByCall()
    {
        $this->dispatch('not-existing');
        $this->assertActionCall('not-existing');
    }

    /**
     * Tests if the most important primitive types are supported.
     */
    public function testDispatchSupportsSimpleTypes()
    {
        $this->simulateParam('flag', 'true');
        $this->simulateParam('number', '5.23');
        $this->simulateParam('mixed', 'Hallo!');

        $this->dispatch('mixed-types');

        $this->assertActionCall('mixed-types');
        $this->assertActionArgumentEquals('mixed-types', self::FIRST_ARGUMENT, true);
        $this->assertActionArgumentEquals('mixed-types', self::SECOND_ARGUMENT, 5.23);
        $this->assertActionArgumentEquals('mixed-types', self::THIRD_ARGUMENT, 'Hallo!');
    }

    /**
     * Ensures that parameter assignment works even if the parameter names
     * in the DocBlock are aligned.
     */
    public function testDispatchSupportsIndentedParameterNames()
    {
        $this->simulateParam('one', 'Hallo!');
        $this->simulateParam('two', 'true');

        $this->dispatch('indented-names');

        $this->assertActionCall('indented-names');
        $this->assertActionArgumentEquals('indented-names', self::FIRST_ARGUMENT, 'Hallo!');
        $this->assertActionArgumentEquals('indented-names', self::SECOND_ARGUMENT, true);
    }

    /**
     * Ensures that parameter assignment works even if addtional parameter
     * comments are present in the DocBlock.
     */
    public function testDispatchSupportsAdditionalParameterComments()
    {
        $this->simulateParam('one', 'Hallo!');
        $this->simulateParam('two', 'true');

        $action = 'additional-parameter-documentation';
        $this->dispatch($action);

        $this->assertActionCall($action);
        $this->assertActionArgumentEquals($action, self::FIRST_ARGUMENT, 'Hallo!');
        $this->assertActionArgumentEquals($action, self::SECOND_ARGUMENT, true);
    }

    /**
     * Ensures that an exception is thrown if the complete action
     * DocBlock is missing.
     */
    public function testDispatchThrowsExceptionIfDocBlockIsMissing()
    {
        $this->setExpectedException('Mol_Controller_Exception_DocBlockMissing');
        $this->simulateParam('flag', '0');
        $this->dispatch('undocumented');
    }

    /**
     * Ensures that an exception is thrown if a declared action parameter is
     * not documented.
     */
    public function testDispatchThrowsExceptionIfParameterIsNotDocumented()
    {
        $this->setExpectedException('Mol_Controller_Exception_ParameterTagMissing');
        $this->simulateParam('flag', '0');
        $this->dispatch('no-parameter-tag');
    }

    /**
     * Tests if arrays are supported as parameters.
     */
    public function testDispatchSupportsArrayParameters()
    {
        $list = array('1', '2', '3' );
        $this->simulateParam('list', $list);
        $this->dispatch('array-parameter');
        $this->assertActionCall('array-parameter');
        $this->assertActionArgumentEquals('array-parameter', self::FIRST_ARGUMENT, array(1, 2, 3 ));
    }

    /**
     * Ensures that an exception is thrown if a required array parameter is missing.
     */
    public function testDispatchThrowsExceptionIfArrayParameterIsMissing()
    {
        $this->setExpectedException('Mol_Controller_Exception_ParameterMissing');
        $this->dispatch('array-parameter');
    }

    /**
     * Ensures that am exception is thrown a parameter is declared as array
     * but another type is provided.
     */
    public function testDispatchThrowsExceptionIfArrayParameterHasInvalidType()
    {
        $this->setExpectedException('Mol_Controller_Exception_ParameterNotValid');
        $this->simulateParam('list', '1,2,3');
        $this->dispatch('array-parameter');
    }

    /**
     * Ensures that an exception is thrown if a parameter is documented
     * without its name in the param tag.
     */
    public function testDispatchThrowsExceptionIfParamNameIsNotDocumented()
    {
        $this->setExpectedException('Mol_Controller_Exception_ParameterTagMissing');
        $this->simulateParam('flag', '1');
        $this->dispatch('doc-block-without-parameter-name');
    }

    /**
     * Tests if registerValidator() provides a fluent interface.
     */
    public function testRegisterValidatorProvidesFluentInterface()
    {
        $validator = new Mol_Validate_True();
        $this->assertSame($this->controller, $this->controller->registerValidator($validator, 'x'));
    }

    /**
     * Tests if registerFilter() provides a fluent interface.
     */
    public function testRegisterFilterProvidesFluentInterface()
    {
         $filter = new Mol_Filter_Null();
        $this->assertSame($this->controller, $this->controller->registerFilter($filter, 'x'));
    }

    /**
     * Asserts that the action named $action was called.
     *
     * @param string $action
     */
    protected function assertActionCall($action)
    {
        $message = 'Action "' . $action . '" was not called.';
        $method  = $this->actionNameToMethod($action);
        $this->assertTrue($this->controller->wasCalled($method), $message);
    }

    /**
     * Asserts that the action argument $argumentIndex was of the type $expectedType.
     *
     * Argument counting starts at 0.
     *
     * @param string $action The action name.
     * @param integer $argumentIndex The index of the argument, starting at 0.
     * @param string $expectedType
     */
    protected function assertActionArgumentHasType($action, $argumentIndex, $expectedType)
    {
        $argument = $this->getArgument($action, $argumentIndex);
        $this->assertInternalType($expectedType, $argument, 'Invalid argument type.');
    }

    /**
     * Asserts that the action argument $argumentIndex equals $expectedValue.
     *
     * Argument counting starts at 0.
     *
     * @param string $action The action name.
     * @param integer $argumentIndex The index of the argument, starting at 0.
     * @param mixed $expectedValue The expected argument value.
     */
    protected function assertActionArgumentEquals($action, $argumentIndex, $expectedValue)
    {
        $argument = $this->getArgument($action, $argumentIndex);
        $this->assertEquals($expectedValue, $argument);
    }

    /**
     * Converts an action name to the name of the corrresponding method.
     *
     * @param string $action The name of the action.
     * @return string The name of the corresponding action method.
     */
    private function actionNameToMethod($action)
    {
        $parts         = explode('-', $action);
        $numberOfParts = count($parts);
        for ($i = 1; $i < $numberOfParts; $i++) {
            $parts[$i] = ucfirst($parts[$i]);
        }
        return implode('', $parts) . 'Action';
    }

    /**
     * Returns the argument $argumentIndex that was passed to the action $action.
     *
     * If the argument does not exist the current test will fail.
     * Argument counting starts at 0.
     *
     * @param string $action
     * @param integer $argumentIndex The index of the argument, starting at 0.
     * @return mixed
     */
    private function getArgument($action, $argumentIndex)
    {
        $method    = $this->actionNameToMethod($action);
        $arguments = $this->controller->getLastArgumentsFrom($method);
        if (!isset($arguments[$argumentIndex])) {
            $this->fail('Missing argument ' . $argumentIndex . ' of action "' . $action . '".');
        }
        return $arguments[$argumentIndex];
    }

}

