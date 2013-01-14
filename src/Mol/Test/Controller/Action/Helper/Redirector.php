<?php

/**
 * Mol_Test_Controller_Action_Helper_Redirector
 *
 * @category PHP
 * @package Mol_Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 13.01.2013
 */

/**
 * Redirector helper that is used for testing.
 *
 * Avoids connections to global dependencies and prevents calls to exit(),
 * which would lead to untestable code.
 *
 * @category PHP
 * @package Mol_Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 13.01.2013
 */
class Mol_Test_Controller_Action_Helper_Redirector extends Zend_Controller_Action_Helper_Redirector
{
    
    /**
     * Avoid hard exists in tests as these will terminate the
     * whole test run.
     *
     * @var boolean
     */
    protected $_exit = false;
    
    
    /**
     * Sets a redirect URL of the form /module/controller/action/params.
     *
     * In contrast to setGotoSimple() of the parent class, this method
     * does not use the router to avoid the dependencies to front controller,
     * dispatcher and router.
     *
     * @param string $action
     * @param string $controller
     * @param string $module
     * @param array(string=>string)  $params
     */
    public function setGotoSimple($action, $controller = null, $module = null, array $params = array())
    {
        // TODO Use controller/module from request if null
        // TODO add params, sort params by key to create same output if params are equal (but order differs)
        $url = '/' . $module . '/' . $controller . '/' . $action;
        foreach ($params as $key => $value) {
            /* @var $key string */
            /* @var $value string */
            $url .= '/' . $key . '/' . $value;
        }
        $this->_redirect($url);
    }
    
}
