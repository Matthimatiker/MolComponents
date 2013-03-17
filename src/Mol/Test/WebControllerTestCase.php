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
 * ## Naming and path conventions ##
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
 * ## Customize controller loading behavior ##
 *
 * If the name of the test case and the name of the controller class
 * do not fit together, then ``getControllerClass()`` must be overwritten
 * by the subclass. The method should return the class name of the tested
 * controller:
 *
 *     public function getControllerClass()
 *     {
 *         return 'My_Custom_Controller';
 *     }
 *
 * Most probably the test case is not able to locate the controller
 * if the naming conventions are not fulfilled. If the class loader
 * is not able to load the tested controller, then the subclass also
 * has to overwrite the method  ``getControllerPath()``. It must
 * return the path to the controller file:
 *
 *     public function getControllerPath()
 *     {
 *         return APPLICATION_PATH . '/modules/custom/MyController.php';
 *     }
 *
 * The file must contain the controller class that is provided by
 * getControllerClass(), otherwise an exception will be thrown.
 *
 * # Usage #
 *
 * ## Prepare the environment ##
 *
 * ### Simulate configuration options ###
 *
 * The prepared bootstrapper is used to simulate configuration options.
 * The following configuration...
 *
 *     $options = array('name' => 'Dori', 'mail' => 'dori@demo.com');
 *     $this->bootstrapper->setOptions('demo' => $options);
 *
 * ... is equal to this ini file configuration entries:
 *
 *     demo.name = "Dori"
 *     demo.mail = "dori@demo.com"
 *
 * ### Simulate resources ###
 *
 * Resources (for example database connections) may also be simulated
 * via bootstrapper:
 *
 *     $this->bootstrapper->simulateResource('Locale', new Zend_Locale('en'));
 *
 * The following resources are simulated per default to reduce
 * manual setup work:
 *
 * * Log
 * * Layout
 * * View
 *
 * ### Simulate parameters ###
 *
 * The request parameters are simulated via setGet() and setPost():
 *
 *     $this->setGet(array('page' => '1'));
 *     $this->setPost(array('search' => 'hello'));
 *
 * Multiple calls to setGet() or setPost() will not clear parameters
 * that were provided previously, instead the new paramters will
 * be added:
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
 * ### Simulate identity ###
 *
 * The controller can use Zend_Auth to determine the currently
 * logged in user.
 *
 * Use setIdentity() to simulate that user:
 *
 *     $this->setIdentity('user@example.org');
 *
 * Pass null as argument to simulate a guest (not logged in):
 *
 *     $this->setIdentity(null);
 *
 * This is also the default state after initial setup.
 *
 * Use getIdentity() as a shortcut to retrieve the current identity:
 *
 *     $currentIdentity = $this->getIdentity();
 *
 * ### Simulate invoke args ###
 *
 * The controller is created in the set up phase, therefore changing the
 * invoke args afterwards is not possible.
 *
 * There are several ways to overcome this issue. To change the invoke args
 * for all created controllers, the createInvokeArgs() method can be overwritten:
 *
 *     protected function createInvokeArgs()
 *     {
 *         // Create and returns customized invoke args here.
 *         return array();
 *     }
 *
 * To test a specific invoke arg combination there is also the possibility
 * to re-create the controller within a test method:
 *
 *     $invokeArgs = array();
 *     $this->controller = $this->createController($invokeArgs);
 *
 * Afterwards the new controller can be tested as usual.
 *
 * ## Testing ##
 *
 * ### Single controller methods ###
 *
 * Single controller methods can be executed directly:
 *
 *     $this->controller->myAction();
 *
 * Afterwards, the for example the state of the response
 * can be checked to verify the controller behavior:
 *
 *     $this->assertResponse()->hasHeader('Expires');
 *
 * ### Action tests including lifecycle ###
 *
 * More complex tests might rely on the controller lifecycle.
 * The ``dispatch()`` method helps to to simulate the controller
 * lifecycle as it occurs in the dispatch loop.
 *
 * The lifecycle includes:
 *
 * * calling pre-dispatch hooks of action helpers
 * * calling controller preDispatch()
 * * executing the requested action
 * * calling controller postDispatch()
 * * calling post-dispatch hooks of action helpers
 *
 * To execute an action its name (not the name of the action
 * method) is passed to ``dispatch()``:
 *
 *     $this->dispatch('my-action');
 *
 * Please note: During dispatching the environment is modified and another
 * call to dispatch() will not re-initialize it properly, therefore dispatch()
 * should be called only once per test.
 *
 * After executing an action the provided assertions are used to
 * check the results just like in a single method test.
 *
 * @category PHP
 * @package Mol_Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 21.06.2011
 * @todo add view assertions
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
     * @var Mol_Test_Bootstrap
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
     * The log writer that can be used to check the logging behavior.
     *
     * @var Zend_Log_Writer_Mock
     */
    protected $logWriter = null;
    
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
     * Contains the identity storage that was registered
     * before the test started.
     *
     * @var Zend_Auth_Storage_Interface
     */
    private $previousIdentityStorage = null;

    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->storeIdentity();
        $this->storeActionHelpers();
        $this->request      = $this->createRequest();
        $this->response     = $this->createResponse();
        $this->logWriter    = $this->createLogWriter();
        $this->bootstrapper = $this->createBootstrapper();
        // Initialize the action helpers before creating the controller
        // as its constructor accesses these helpers.
        $this->initActionHelpers();
        $this->controller = $this->createController($this->createInvokeArgs());
    }

    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->controller   = null;
        $this->bootstrapper = null;
        $this->logWriter    = null;
        $this->response     = null;
        $this->request      = null;
        $this->restoreActionHelpers();
        $this->restoreIdentity();
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
        $this->request->setMethod('POST');
        $this->request->setPost($this->toValues($arrayOrForm));
    }

    /**
     * Simulates Query (GET) parameters.
     *
     * Example:
     *
     *     $this->setGet(array('page' => 1));
     *
     * Additionally, it is possible to use a form instance
     * as data source:
     *
     *     $form = new Zend_Form();
     *     $form->populate(array('name' => 'Matthias'));
     *     $this->setGet($form);
     *
     * @param array(string=>string)|Zend_Form $arrayOrForm
     */
    protected function setGet($arrayOrForm)
    {
        $this->request->setMethod('GET');
        $this->request->setQuery($this->toValues($arrayOrForm));
    }
    
    /**
     * Simulates an identity.
     *
     * Set identity to null to simulate a guest.
     *
     * @param mixed|null $identity
     */
    protected function setIdentity($identity)
    {
        Zend_Auth::getInstance()->getStorage()->write($identity);
    }
    
    /**
     * Returns the current identity.
     *
     * Returns null if no identity is available.
     * The identity can also be simulated via setIdentity().
     *
     * @return mixed|null
     */
    protected function getIdentity()
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            return null;
        }
        return $auth->getIdentity();
    }
    
    /**
     * Returns the values from the given Zend_Form instance or array.
     *
     * If an array is provided then this method will do nothing as
     * no conversion is needed.
     *
     * @param array(string=>string)|Zend_Form $arrayOrForm $arrayOrForm
     * @return array(string=>string)
     */
    protected function toValues($arrayOrForm)
    {
        if ($arrayOrForm instanceof Zend_Form) {
            /* @var $form Zend_Form */
            $form = $arrayOrForm;
            return $form->getValues();
        }
        return $arrayOrForm;
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
        $this->assertEquals($expectedNumber, count($this->logWriter->events), $message);
    }
    
    /**
     * Creates the controller that is tested.
     *
     * @param array(string=>mixed) $invokeArgs
     * @return Zend_Controller_Action
     */
    protected function createController(array $invokeArgs = array())
    {
        $class = $this->getControllerClass();
        if (!class_exists($class, true)) {
            $this->loadController();
        }
        $builder   = new Mol_Util_ObjectBuilder('Zend_Controller_Action');
        $arguments = array(
                $this->request,
                $this->response,
                $invokeArgs
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
        $this->injectResources($bootstrapper);
        return $bootstrapper;
    }
    
    /**
     * Creates simulated resources and injects them into the given bootstrapper.
     *
     * @param Mol_Test_Bootstrap $bootstrapper
     */
    protected function injectResources(Mol_Test_Bootstrap $bootstrapper)
    {
        $bootstrapper->simulateResource('log', new Zend_Log($this->logWriter));
        
        $view = $this->createView();
        $bootstrapper->simulateResource('view', $view);
        
        $layout = new Zend_Layout();
        $layout->setView($view);
        $view->getHelper('layout')->setLAyout($layout);
        $bootstrapper->simulateResource('layout', $layout);
    }
    
    /**
     * Creates a log writer mock.
     *
     * @return Zend_Log_Writer_Mock
     */
    protected function createLogWriter()
    {
        return new Zend_Log_Writer_Mock();
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
     * Stores the current identity. Prepares a storage that does not depend
     * on the session for testing.
     */
    protected function storeIdentity()
    {
        $auth = Zend_Auth::getInstance();
        $storageProperty = new ReflectionProperty($auth, '_storage');
        $storageProperty->setAccessible(true);
        if ($storageProperty->getValue($auth) === null) {
            // Storage was not created yet. Do not request it as a session
            // storage will be created otherwise.
            // Instead assume a non persistent storage as adding this one later
            // should not have any side effect.
            $this->previousIdentityStorage = new Zend_Auth_Storage_NonPersistent();
        } else {
            $this->previousIdentityStorage = $auth->getStorage();
        }
        Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_NonPersistent());
    }
    
    /**
     * Restores the previous identity.
     */
    protected function restoreIdentity()
    {
        Zend_Auth::getInstance()->setStorage($this->previousIdentityStorage);
        $this->previousIdentityStorage = null;
    }
    
    /**
     * Sets up the action helpers.
     */
    protected function storeActionHelpers()
    {
        $this->previousActionHelpers = Zend_Controller_Action_HelperBroker::getExistingHelpers();
        Zend_Controller_Action_HelperBroker::resetHelpers();
    }
    
    /**
     * Restores the previous action helpers.
     */
    protected function restoreActionHelpers()
    {
        Zend_Controller_Action_HelperBroker::resetHelpers();
        foreach ($this->previousActionHelpers as $helper) {
            /* @var $helper Zend_Controller_Action_Helper_Abstract */
            Zend_Controller_Action_HelperBroker::addHelper($helper);
        }
        $this->previousActionHelpers = null;
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
        $redirector = new Mol_Test_Controller_Action_Helper_Redirector();
        Zend_Controller_Action_HelperBroker::addHelper($redirector);
    }
    
    /**
     * Creates the simulated view renderer action helper.
     *
     * @return Zend_Controller_Action_Helper_ViewRenderer
     */
    protected function createViewRenderer()
    {
        return new Mol_Test_Controller_Action_Helper_ViewRenderer($this->bootstrapper->getResource('view'));
    }
    
    /**
     * Creates the simulated layout action helper.
     *
     * @return Zend_Layout_Controller_Action_Helper_Layout
     */
    protected function createLayoutHelper()
    {
        return new Zend_Layout_Controller_Action_Helper_Layout($this->bootstrapper->getResource('layout'));
    }
    
    /**
     * Returns a view object that is used for testing.
     *
     * @return Zend_View
     */
    protected function createView()
    {
        // Use a mocked view to ensure that the templates are not really rendered.
        $view = $this->getMock('Zend_View', array('render'));
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
        $this->request->setActionName($action);
        
        $this->controller->dispatch($this->actionNameToMethod($action));
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
        $method = Zend_Filter::filterStatic($name, 'Word_DashToCamelCase');
        $method = lcfirst($method) . 'Action';
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
            throw new RuntimeException($message);
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
        $name = $this->getControllerClass();
        $positionOfLastUnderscore = strrpos($name, '_');
        if ($positionOfLastUnderscore !== false) {
            $name = substr($name, $positionOfLastUnderscore + 1);
        }
        $name = Mol_Util_String::removeSuffix($name, 'Controller');
        $name = Zend_Filter::filterStatic($name, 'Word_CamelCaseToDash');
        return strtolower($name);
    }

    /**
     * Returns the name of the module that the tested controller
     * belongs to.
     *
     * @return string
     */
    protected function getModuleName()
    {
        $positionOfLastUnderscore = strrpos($this->getControllerClass(), '_');
        if ($positionOfLastUnderscore === false) {
            return 'default';
        }
        $module = substr($this->getControllerClass(), 0, $positionOfLastUnderscore);
        $module = Zend_Filter::filterStatic($module, 'Word_UnderscoreToDash');
        $module = Zend_Filter::filterStatic($module, 'Word_CamelCaseToDash');
        return strtolower($module);
    }

}
