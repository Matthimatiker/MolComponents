<?php

/**
 * Mol_Test_View_MockTest
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Test
 * @subpackage Tests
 * @copyright Matthias Molitor 2011
 * @version $Rev: 438 $
 * @since 29.04.2011
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the functions of view mock object.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Test
 * @subpackage Tests
 * @copyright Matthias Molitor 2011
 * @version $Rev: 438 $
 * @since 29.04.2011
 */
class Mol_Test_View_MockTest extends PHPUnit_Framework_TestCase {
    
    /**
     * System under test.
     *
     * @var Mol_Test_View_Mock
     */
    protected $view = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp() {
        parent::setUp();
        $this->view = new Mol_Test_View_Mock();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown() {
        $this->view = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that an exception is thrown if a non object is passed to setHelper().
     */
    public function testSetHelperThrowsExceptionIfProvidedArgumentIsNotAnObject() {
        $this->setExpectedException('Zend_View_Exception');
        $this->view->setHelper('test', 'Hello World!');
    }
    
    /**
     * Ensures that setHelper() calls setView() if the helper provides that method.
     */
    public function testSetHelperCallsSetViewIfHelperProvidesThatMethod() {
        $helper = $this->getMock('stdClass', array('setView', 'test'));
        $helper->expects($this->once())
               ->method('setView')
               ->withAnyParameters();
        $this->view->setHelper('test', $helper);
    }
    
    /**
     * Ensures that setHelper() injects the view to the helper object if it
     * implements a setView() method.
     */
    public function testSetHelperInjectsViewIfTheHelperProvidesImplementsSetViewMethod() {
        $helper = $this->getMock('Zend_View_Helper_Abstract', array('test'));
        $this->view->setHelper('test', $helper);
        $this->assertSame($this->view, $helper->view);
    }
    
    /**
     * Tests if getHelper() returns a previously injected helper.
     */
    public function testGetHelperReturnsInjectedHelper() {
        $helper = $this->getMock('stdClass', array('test'));
        $this->view->setHelper('test', $helper);
        $this->assertSame($helper, $this->view->getHelper('test'));
    }
    
    /**
     * Ensures that getHelper() returns the default Zend helper if no helper
     * object was registered for the given name.
     */
    public function testGetHelperReturnsDefaultHelperIfNoMockHelperWasInjected() {
        $titleHelper = $this->view->getHelper('HeadTitle');
        $this->assertType('Zend_View_Helper_HeadTitle', $titleHelper);
    }
    
    /**
     * Ensures that getHelper() throws an exception if the requested helper
     * was neither injected nor is a Zend helper.
     */
    public function testGetHelperThrowsExceptionIfRequestedHelperDoesNotExist() {
        $this->setExpectedException('Zend_Loader_Exception');
        $this->view->getHelper('DoesNotExist');
    }
    
    /**
     * Checks if getHelpers() returns an array.
     */
    public function testGetHelpersReturnsArray() {
        $helpers = $this->view->getHelpers();
        $this->assertType('array', $helpers);
    }
    
    /**
     * Checks if the result of getHelpers() contains the injected helper.
     */
    public function testResultOfGetHelpersContainsInjectedHelperObjects() {
        $helper = $this->getMock('stdClass', array('test'));
        $this->view->setHelper('test', $helper);
        $helpers = $this->view->getHelpers();
        $this->assertContains($helper, $helpers);
    }
    
    /**
     * Checks if the result of getHelpers() contains the default Zend
     * view helpers that were already created.
     */
    public function testResultOfGetHelpersContainsCreatedDefaultHelpers() {
        $titleHelper = $this->view->getHelper('HeadTitle');
        $helpers     = $this->view->getHelpers();
        $this->assertContains($titleHelper, $helpers);
    }
    
    /**
     * Tests if calling the magic helper method on the view returns the
     * result of the entry method that is provided by the injected helper.
     */
    public function testCallingMagicMethodReturnsTheResultOfTheHelpersEntryMethod() {
        $helper = $this->getMock('stdClass', array('test'));
        $helper->expects($this->once())
               ->method('test')
               ->will($this->returnValue('Hello World!'));
        $this->view->setHelper('test', $helper);
        $this->assertEquals('Hello World!', $this->view->test());
    }
    
}

?>