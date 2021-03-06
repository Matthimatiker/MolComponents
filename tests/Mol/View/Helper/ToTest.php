<?php

/**
 * Mol_View_Helper_ToTest
 *
 * @category PHP
 * @package Mol_View
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 21.10.2010
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the To view helper.
 *
 * @category PHP
 * @package Mol_View
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 21.10.2010
 */
class Mol_View_Helper_ToTest extends PHPUnit_Framework_TestCase
{
    /**
     * System under test.
     *
     * @var Mol_View_Helper_To
     */
    protected $helper = null;

    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->helper = new Mol_View_Helper_To();
        $this->helper->setView($this->createView());
    }

    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->helper = null;
        parent::tearDown();
    }

    /**
     * Creates a pre-configured view object.
     *
     * @return Zend_View
     */
    protected function createView()
    {
        $view = new Zend_View();
        $urlHelper = new Mol_Test_View_Helper_Url();
        $view->registerHelper($urlHelper, 'url');
        return $view;
    }

    /**
     * Tests if the helper returns a url object.
     */
    public function testHelperReturnsUrlObject()
    {
        $this->assertInstanceOf('Mol_View_Helper_Value_Url', $this->helper->to('index', 'index', 'default'));
    }

    /**
     * Ensures that the helper creates always a new url object.
     *
     * If the helper reuses the url object parallel url generation would not be possible.
     */
    public function testHelperReturnsAlwaysNewObjects()
    {
        $this->assertNotSame($this->helper->to('index', 'index'), $this->helper->to('index', 'index'));
    }

    /**
     * Checks if the url contains the provided action.
     */
    public function testUrlContainsProvidedAction()
    {
        $url = (string)$this->helper->to('hello', 'world', 'test');
        $this->assertContains('action:hello', $url);
    }

    /**
     * Checks if the url contains the provided controller.
     */
    public function testUrlContainsProvidedController()
    {
        $url = (string)$this->helper->to('hello', 'world', 'test');
        $this->assertContains('controller:world', $url);
    }

    /**
     * Checks if the url contains the provided module.
     */
    public function testUrlContainsProvidedModule()
    {
        $url = (string)$this->helper->to('hello', 'world', 'test');
        $this->assertContains('module:test', $url);
    }

    /**
     * Checks if the default module is used per default.
     */
    public function testHelperUsesModuleDefaultIfNoneWasProvided()
    {
        $url = (string)$this->helper->to('hello', 'world');
        $this->assertContains('module:default', $url);
    }
    
    /**
     * Ensures that the helper returns an url object that uses
     * the "default" route.
     */
    public function testHelperReturnsUrlThatUsesDefaultRoute()
    {
        (string)$this->helper->to('index', 'index');
        /* @var $view Zend_View */
        $view = $this->helper->view;
        /* @var $urlHelper Mol_Test_View_Helper_Url */
        $urlHelper = $view->getHelper('url');
        $urlParams = $urlHelper->getParamsOfCall(0);
        $this->assertNotNull($urlParams);
        $this->assertEquals('default', $urlParams['name']);
    }

}

