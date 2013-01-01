<?php

/**
 * Mol_Test_WebControllerTestCase
 *
 * @category PHP
 * @package Mol_Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 21.06.2011
 */

/**
 * Base class for web controller tests.
 *
 * # Requirements #
 *
 * The WebControllerTestCase detects and loads the tested class automatically.
 * Therefore it is important to name and place the TestCase correctly.
 *
 * The name of the test class must equal the name of the tested controller class
 * plus the suffix "Test":
 * Controller class: IndexController
 * Test class: IndexControllerTest
 *
 * Also the PHP file with the test class must be placed analog to the
 * controller file:
 * Controller file: /application/controllers/IndexController.php
 * Test file: /tests/application/controllers/IndexControllerTest.php
 *
 * # Usage #
 *
 * ## Prepare the environment ##
 *
 * Configuration options are simulated via simulateOption().
 * The following configuration...
 *
 *     $options = array('name' => 'Dori', 'mail' => 'dori@demo.com');
 *     $this->simulateOption('demo' => $options);
 *
 * ... equals this ini file configuration entries:
 *
 *     demo.name = "Dori"
 *     demo.mail = "dori@demo.com"
 *
 * Resources (for example database connections) may be simulated via
 * simulateResource():
 *
 *     $this->simulateResource('Locale', new Zend_Locale('en'));
 *
 * The following resources are simulated per default to reduce
 * dependencies:
 *
 * * Log
 *
 * Front controller parameters and invoke args that are passed to
 * the constructor of the controller are simulated via setInvokeArgs():
 *
 *     $this->setInvokeArgs(array('displayExceptions' => true));
 *
 * A mocked bootstrapper is injected as invoke arg per default.
 *
 * The request parameters are simulated via setGet() and setPost():
 *
 *     $this->setGet(array('page' => '1'));
 *     $this->setPost(array('search' => 'hello'));
 *
 * Multiple calls to setGet() or setPost() will not clear parameters
 * that were provided previously:
 *
 *     $this->setGet(array('page' => '1'));
 *     $this->setGet(array('name' => 'Al'));
 *
 * In this example the controller will receive the GET parameters
 * "page" and "name".
 *
 * User parameters may be simulated via setUserParams():
 *
 *     $this->setUserParams(array('target' => 'stats'));
 *
 * Usually user parameters are passed via forwarding.
 *
 *
 * ## Execute and test ##
 *
 * For testing specific actions may be executed via dispatch():
 *
 *     $this->dispatch('my-action');
 *
 * The method dispatch() takes name of the action (not the name of
 * the action method) as argument.
 * During dispatching the environment is modified and another call to
 * dispatch() will not re-initialize it, therefore dispatch() should
 * be called only once per test.
 *
 * After executing an action the provided assertions are used to
 * check the results.
 * The assertions regarding the response object are accessed via
 * assertResponse():
 *
 *     $this->assertReponse()->contains('Test!');
 *
 *
 * ## Modify class loading behavior ##
 *
 * If the test class does not fulfill the requirements for autoloading
 * the tested controller, then the loading behavior may be modified
 * via overridung getControllerClass() and/or getControllerPath().
 *
 * The method getControllerClass() returns the name of the tested controller:
 *
 *     protected function getControllerClass() {
 *         return 'MyController';
 *     }
 *
 * The method getControllerPath() returns the path to the file that is loaded
 * if the controller class is not available yet. The file must contain the
 * controller class that is provided by getControllerClass(), otherwise an
 * exception will be thrown:
 *
 *     protected function getControllerPath() {
 *         return APPLICATION_PATH . '/My/Controllers/Controller.php';
 *     }
 *
 * @category PHP
 * @package Mol_Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 21.06.2011
 */
abstract class Mol_Test_WebControllerTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Ensure that globals ($_GET, $_POST, ...) are stored.
     *
     * Otherwise changing the request data may influence following tests.
     *
     * @var boolean
     */
    protected $backupGlobals = true;
    
    /**
     * System under test.
     *
     * @var Zend_Controller_Action
     */
    protected $controller = null;
    
    /**
     * The bootstrapper that is injected into the controller.
     *
     * @var Mol_Test_BootstrapTest
     */
    protected $bootstrapper = null;
    
    /**
     * The request that is used in the tests.
     *
     * @var Zend_Controller_Request_HttpTestCase
     */
    protected $request = null;
    
    /**
     * The response that is used in the tests.
     *
     * @var Zend_Controller_Response_HttpTestCase
     */
    protected $response = null;
    
    /**
     * Contains the action helpers that were registered
     * before the test started.
     *
     * The helpers will be restored after each test.
     *
     * @var array(string=>Zend_Controller_Action_Helper_Abstract)
     */
    private $previousActionHelpers = null;

    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->setUpHelpers();
        $this->request      = $this->createRequest();
        $this->response     = $this->createResponse();
        $this->bootstrapper = $this->createBootstrapper();
        $this->controller   = $this->createController();
    }

    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->controller   = null;
        $this->bootstrapper = null;
        $this->response     = null;
        $this->request      = null;
        $this->tearDownHelpers();
        parent::tearDown();
    }

    /**
     * Simulates POST parameters.
     *
     * The parameters may be passed as array...
     *
     *     $this->setPost(array('name' => 'Matthias'));
     *
     * ... or as Zend_Form object:
     *
     *     $form = new Zend_Form();
     *     $form->populate(array('name' => 'Matthias'));
     *     $this->setPost($form);
     *
     * @param array(string=>string)|Zend_Form $arrayOrForm
     */
    protected function setPost($arrayOrForm)
    {
        if ($arrayOrForm instanceof Zend_Form) {
            /* @var $form Zend_Form */
            $form        = $arrayOrForm;
            $arrayOrForm = $form->getValues();
        }
        $this->request->setMethod('POST');
        $this->request->setPost($arrayOrForm);
    }

    /**
     * Simulates Query (GET) parameters.
     *
     * Example:
     *
     *     $this->setGet(array('page' => 1));
     *
     * @param array(string=>string) $parameters
     */
    protected function setGet(array $parameters)
    {
        $this->request->setQuery($parameters);
    }

    /**
     * Simulates user parameters.
     *
     * Normally user parameters are passed per forwarding.
     *
     * Example:
     *
     *     $this->setUserParams(array('from' => 'previous-action'));
     *
     * @param array(string=>string) $parameters
     */
    protected function setUserParams(array $parameters)
    {
        $this->request->setParams($parameters);
    }

    /**
     * Returns an accessor for response assertions.
     *
     * The returned object is used to access all assertions regarding
     * the response object.
     * Example:
     *
     *     $this->assertResponse()->contains('test');
     *
     * @return Mol_Test_Assertions_HttpResponse
     */
    protected function assertResponse()
    {
        return new Mol_Test_Assertions_HttpResponse($this->response);
    }

    /**
     * Asserts that $expectedNumber messages were logged.
     *
     * @param integer $expectedNumber
     */
    protected function assertNumberOfLogEntries($expectedNumber)
    {
        $message = 'Unexpected number of log entries.';
        $this->assertEquals($expectedNumber, count($this->logger->events), $message);
    }
    
    /**
     * Creates the controller that is tested.
     *
     * @return Zend_Controller_Action
     */
    protected function createController()
    {
        $class = $this->getControllerClass();
        if (!class_exists($class, true)) {
            $this->loadController();
        }
        $builder   = new Mol_Util_ObjectBuilder('Zend_Controller_Action');
        $arguments = array(
                $this->request,
                $this->response,
                $this->createInvokeArgs()
        );
        return $builder->create($class, $arguments);
    }

    /**
     * Creates the request object that is used for testing.
     *
     * @return Zend_Controller_Request_HttpTestCase
     */
    protected function createRequest()
    {
        $request = new Zend_Controller_Request_HttpTestCase();
        $request->setDispatched(true);
        $request->setModuleName($this->getModuleName());
        $request->setControllerName($this->getControllerName());
        return $request;
    }

    /**
     * Creates the response object that is used for testing.
     *
     * @return Zend_Controller_Response_HttpTestCase
     */
    protected function createResponse()
    {
        return new Zend_Controller_Response_HttpTestCase();
    }

    /**
     * Creates the bootstrapper that will be injected into the controller.
     *
     * @return Mol_Test_Bootstrap
     */
    protected function createBootstrapper()
    {
        $bootstrapper = Mol_Test_Bootstrap::create();
        $bootstrapper->simulateResource('log', new Zend_Log_Writer_Mock());
        return $bootstrapper;
    }
    
    /**
     * Returns the arguments that are used to create the tested controller.
     *
     * @return array(string=>mixed)
     */
    protected function createInvokeArgs()
    {
        $args = array(
            'bootstrap' => $this->bootstrapper
        );
        return $args;
    }
    
    /**
     * Sets up the action helpers.
     */
    protected function setUpHelpers()
    {
        $this->previousActionHelpers = Zend_Controller_Action_HelperBroker::getExistingHelpers();
        Zend_Controller_Action_HelperBroker::resetHelpers();
        $this->initActionHelpers();
    }
    
    /**
     * Restores the previous action helpers.
     */
    protected function tearDownHelpers()
    {
        Zend_Controller_Action_HelperBroker::resetHelpers();
        foreach ($this->previousActionHelpers as $helper) {
            /* @var $helper Zend_Controller_Action_Helper_Abstract */
            Zend_Controller_Action_HelperBroker::addHelper($helper);
        }
    }
    
    /**
     * Initializes the action helpers for testing.
     */
    protected function initActionHelpers()
    {
        $viewRenderer = $this->createViewRenderer();
        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
        $layoutHelper = $this->createLayoutHelper();
        Zend_Controller_Action_HelperBroker::addHelper($layoutHelper);
    }
    
    /**
     * Creates the simulated view renderer action helper.
     *
     * @return Zend_Controller_Action_Helper_ViewRenderer
     */
    protected function createViewRenderer()
    {
        return new Zend_Controller_Action_Helper_ViewRenderer($this->createView());
    }
    
    /**
     * Creates the simulated layout action helper.
     *
     * @return Zend_Layout_Controller_Action_Helper_Layout
     */
    protected function createLayoutHelper()
    {
        $layout = new Zend_Layout();
        return new Zend_Layout_Controller_Action_Helper_Layout($layout);
    }
    
    /**
     * Returns a view object that is used for testing.
     *
     * @return Zend_View
     */
    protected function createView()
    {
        $view = new Zend_View();
        $view->registerHelper(new Mol_Test_View_Helper_Url(), 'url');
        return $view;
    }
    
    /**
     * Dispatches the action with the given name:
     *
     * Example:
     *
     *     $this->dispatch('my-action');
     *
     * @param string $action
     */
    protected function dispatch($action)
    {
        $this->request->setDispatched(true);
        $this->request->setActionName($action);
        $this->request->setControllerName($this->getControllerName());
        $this->request->setModuleName($this->getModuleName());
    
        $controller = $this->createController();
        $controller->dispatch($this->actionNameToMethod($action));
    }
    
    /**
     * Converts the given action name to the name of the
     * corresponding action method.
     *
     * Example:
     *
     *     // Returns "myTestAction".
     *     $method = $this->actioNameToMethod('my-test');
     *
     * @param string $name
     * @return string
     */
    private function actionNameToMethod($name)
    {
        $method = str_replace('-', ' ', $name);
        $method = ucwords($method);
        $method = str_replace(' ', '', $method);
        $method = strtolower(substr($method, 0, 1)) . substr($method, 1);
        $method = $method . 'Action';
        return $method;
    }

    /**
     * Loads the controller class.
     *
     * @throws RuntimeException If the controller file does not exist or if the file does notr contain the class.
     */
    private function loadController()
    {
        $class       = $this->getControllerClass();
        $pathToClass = $this->getControllerPath();
        if (!is_file($pathToClass)) {
            $template = 'Expected controller "%s" in "%s", but the file does not exist.';
            $message  = sprintf($template, $class, $pathToClass);
            throw new RuntimeException($message);
        }
        require_once($pathToClass);
        if (!class_exists($class, false)) {
            $template = 'Controller class "%s" not found in "%s".';
            $message  = sprintf($template, $class, $pathToClass);
            throw new RuntimeException();
        }
    }
    
    /**
     * Returns the classname of the tested controller.
     *
     * The classname equals the classname of the testcase without
     * the Test suffix.
     * For example the name of the class that is tested by "ErrorControllerTest"
     * is "ErrorController".
     *
     * @return string
     */
    public function getControllerClass()
    {
        $class = get_class($this);
        return substr($class, 0, -strlen('Test'));
    }

    /**
     * Returns the path to the file that contains the controller class.
     *
     * The tests directory structure mimics the structure of the application directory.
     * Therefore the path to the file with the tested controller equals the path to
     * the test class without the "tests" directory and without the "Tests" suffix.
     *
     * @return string
     */
    protected function getControllerPath()
    {
        $info = new ReflectionClass(get_class($this));
        $path = $info->getFileName();
        $path = str_replace('Test.php', '.php', $path);
        $path = str_replace('/tests/', '/', $path);
        $path = str_replace('\\tests\\', '/', $path);
        return $path;
    }

    /**
     * Returns the name of the controller.
     *
     * @return string
     */
    protected function getControllerName()
    {
        $parts = explode('_', $this->getControllerClass());
        $name  = array_pop($parts);
        $name  = substr($name, 0, -strlen('Controller'));
        return $name;
    }

    /**
     * Returns the name of the module that the tested controller
     * belongs to.
     *
     * @return string
     */
    protected function getModuleName()
    {
        $parts = explode('_', $this->getControllerClass(), 2);
        if (count($parts) === 1) {
            // No module prefix found.
            return 'default';
        }
        return strtolower($parts[0]);
    }

}

