<?php

/**
 * WebControllerTestCase_InternalController
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
 * Controller that is used for the internal tests in Mol_Test_WebControllerTestCaseTest.
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
class WebControllerTestCase_InternalController extends Zend_Controller_Action
{
    
    /**
     * The view object as it was available during
     * execution of the init() method.
     *
     * @var Zend_View|null
     */
    public $viewDuringInit = null;
    
    /**
     * A list of controller methods that were executed.
     *
     * @var array(string)
     */
    protected $calledMethods = array();
    
    /**
     * Registers init() calls.
     */
    public function init()
    {
        parent::init();
        $this->registerCall(__FUNCTION__);
        $this->viewDuringInit = $this->view;
    }
    
    /**
     * Registers calls to preDispatch().
     */
    public function preDispatch()
    {
        parent::preDispatch();
        $this->registerCall(__FUNCTION__);
    }
    
    /**
     * Registers calls of action methods.
     *
     * @param string $name
     * @param array(mixed) $args
     */
    public function __call($name, $args)
    {
        $this->registerCall($name);
    }
    
    /**
     * Action that is used to test the interaction with the redirector action helper.
     */
    public function redirectorAction()
    {
        $this->registerCall(__FUNCTION__);
        $this->_helper->redirector('my-action', 'my-controller', 'my-module', array('my-param' => 'my-value'));
    }
    
    /**
     * Registers calls to postDispatch().
     */
    public function postDispatch()
    {
        parent::postDispatch();
        $this->registerCall(__FUNCTION__);
    }
    
    /**
     * Returns a list of called controller methods (ordered
     * by time of execution).
     *
     * @return array(string)
     */
    public function getCalledMethods()
    {
        return $this->calledMethods;
    }
    
    /**
     * Registers a call to the provided method.
     *
     * @param string $methodName
     */
    protected function registerCall($methodName)
    {
        $this->calledMethods[] = $methodName;
    }
    
}
