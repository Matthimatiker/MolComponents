<?php

/**
 * Mol_Controller_ActionParameterTest_MockController
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
 * Controller that is used to test the Mol_Controller_ActionParameter class.
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
class Mol_Controller_ActionParameterTest_MockController extends Mol_Controller_ActionParameter
{
    /**
     * A list of stdClass objects that contain information about
     * the called methods.
     *
     * Each object has the following properties:
     * # name      (string)       - The name of the called method.
     * # arguments (array(mixed)) - The used method arguments.
     *
     * @var array(stdClass)
     */
    protected $methodCalls = array();

    /**
     * Initializes the controller and removes dependencies.
     */
    public function init()
    {
        parent::init();
        $this->_helper->resetHelpers();
    }

    /**
     * Checks if the method $method was called.
     *
     * @param string $method
     * @return boolean True if the method was called, false otherwise.
     */
    public function wasCalled($method )
    {
        return count($this->filterCallsByName($method)) > 0;
    }

    /**
     * Returns the arguments from the last call to $method.
     *
     * @param string $method
     * @return array(mixed)
     */
    public function getLastArgumentsFrom($method )
    {
        $calls           = $this->filterCallsByName($method);
        $numberOfMatches = count($calls);
        if($numberOfMatches === 0 ) {
            // Method was not called.
            return array();
        }
        return $calls[$numberOfMatches - 1]->arguments;
    }

    /**
     * Returns an array with information about all calls to $method.
     *
     * @param string $method
     * @return array(stdClass)
     */
    protected function filterCallsByName($method )
    {
        $matches = array();
        foreach($this->methodCalls as $call ) {
            /* @var $call stdClass */
            if($call->name !== $method ) {
                continue;
            }
            $matches[] = $call;
        }
        return $matches;
    }

    /**
     * Action without parameters.
     */
    public function fooAction()
    {
        $arguments = func_get_args();
        $this->notifyMethodCall(__FUNCTION__, $arguments);
    }

    /**
     * Action with a required parameter.
     *
     * @param integer $count
     */
    public function requiredParameterAction($count )
    {
        $arguments = func_get_args();
        $this->notifyMethodCall(__FUNCTION__, $arguments);
    }

    /**
     * Action with a parameter that has a default value.
     *
     * @param string $text
     */
    public function optionalParameterAction($text = 'Hello World!' )
    {
        $arguments = func_get_args();
        $this->notifyMethodCall(__FUNCTION__, $arguments);
    }

    /**
     * Action with a parameter that cannot be handled by the default validators.
     *
     * @param Unknown $unknown
     */
    public function unknownTypeAction($unknown )
    {
        $arguments = func_get_args();
        $this->notifyMethodCall(__FUNCTION__, $arguments);
    }

    /**
     * Action with multiple parameters of default types.
     *
     * @param boolean $flag
     * @param double $number
     * @param mixed $mixed
     */
    public function mixedTypesAction($flag, $number, $mixed )
    {
        $arguments = func_get_args();
        $this->notifyMethodCall(__FUNCTION__, $arguments);
    }

    /**
     * Action whose the parameter names are aligned.
     *
     * @param string  $one
     * @param boolean $two
     */
    public function indentedNamesAction($one, $two )
    {
        $arguments = func_get_args();
        $this->notifyMethodCall(__FUNCTION__, $arguments);
    }

    /**
     * Action with additional parameter comments.
     *
     * The additional comments are aligned.
     *
     * @param string $one  This is the first parameter.
     * @param boolean $two This is the second parameter.
     */
    public function additionalParameterDocumentationAction($one, $two )
    {
        $arguments = func_get_args();
        $this->notifyMethodCall(__FUNCTION__, $arguments);
    }

    public function undocumentedAction($flag )
    {
        // An Acrion without DocBlock.
        $arguments = func_get_args();
        $this->notifyMethodCall(__FUNCTION__, $arguments);
    }

    /**
     * A DocBlock with missing parameter documentation.
     */
    public function noParameterTagAction($flag )
    {
        $arguments = func_get_args();
        $this->notifyMethodCall(__FUNCTION__, $arguments);
    }

    /**
     * An action that expects an array.
     *
     * @param array(integer) $list
     */
    public function arrayParameterAction(array $list )
    {
        $arguments = func_get_args();
        $this->notifyMethodCall(__FUNCTION__, $arguments);
    }

    /**
     * The documented parameter contains just the type, the name is missing.
     *
     * @param boolean
     */
    public function docBlockWithoutParameterNameAction($flag )
    {
        $arguments = func_get_args();
        $this->notifyMethodCall(__FUNCTION__, $arguments);
    }

    /**
     * Logs calls to not existing methods.
     *
     * @param string $name
     * @param array $arguments
     */
    public function __call($name, $arguments )
    {
        $this->notifyMethodCall($name, $arguments);
    }

    /**
     * Logs the call to the method $method with the parameters $arguments.
     *
     * @param string $method
     * @param array(mixed) $arguments
     */
    protected function notifyMethodCall($method, array $arguments )
    {
        $call                = new stdClass();
        $call->name          = $method;
        $call->arguments     = $arguments;
        $this->methodCalls[] = $call;
    }

}

