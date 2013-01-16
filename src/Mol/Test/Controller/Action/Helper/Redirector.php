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
     * Rejects activation if exit() as it leads to untestable code.
     *
     * @param boolean $flag
     * @return Mol_Test_Controller_Action_Helper_Redirector Provides a fluent interface.
     * @throws Mol_Test_Exception If method is called to activate exit behavior.
     */
    public function setExit($flag)
    {
        if ($flag) {
            $message = __METHOD__ . '(): Do not force calls to exit() as these will terminate '
                     . 'the whole test run and therefore make the code untestable.';
            throw new Mol_Test_Exception($message);
        }
        return parent::setExit($flag);
    }
    
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
     * @param array(string=>string) $params
     */
    public function setGotoSimple($action, $controller = null, $module = null, array $params = array())
    {
        $module     = ($module !== null) ? $module : $this->getRequest()->getModuleName();
        $controller = ($controller !== null) ? $controller : $this->getRequest()->getControllerName();
        $url        = '/' . $module . '/' . $controller . '/' . $action;
        
        ksort($params);
        foreach ($params as $key => $value) {
            /* @var $key string */
            /* @var $value string */
            $url .= '/' . $key . '/' . $value;
        }
        
        $this->_redirect($url);
    }
    
    /**
     * Avoids the usage of the router and generates a simple url of the
     * form /module/controller/action/params.
     *
     * @param array(string=>string) $urlOptions
     * @param string $name
     * @param boolean $reset
     * @param boolean $encode
     */
    public function setGotoRoute(array $urlOptions = array(), $name = null, $reset = false, $encode = true)
    {
        // Extract speacial parameters if available.
        $module     = (isset($urlOptions['module'])) ? $urlOptions['module'] : null;
        $controller = (isset($urlOptions['controller'])) ? $urlOptions['controller'] : null;
        $action     = (isset($urlOptions['action'])) ? $urlOptions['action'] : null;
        
        // Remove special parameters.
        unset($urlOptions['module']);
        unset($urlOptions['controller']);
        unset($urlOptions['action']);
        
        // Delegate to setGotoSimple(), which does not rely on global dependencies.
        $this->setGotoSimple($action, $controller, $module, $urlOptions);
    }
    
    /**
     * Rejects access to front controller as it is a global dependency.
     *
     * @return Zend_Controller_Front
     * @throws Mol_Test_Exception Always thrown as this method rejects front controller access.
     */
    public function getFrontController()
    {
        $message = __METHOD__ . '(): Do not rely on the front controller as it is a '
                 . 'global dependency that may cause side effects.';
        throw new Mol_Test_Exception($message);
    }
    
    /**
     * Restrict access to redirectAndExit() as it leads to untestable code.
     *
     * @see Zend_Controller_Action_Helper_Redirector::redirectAndExit()
     * @throws Mol_Test_Exception Always thrown as access to this method is restricted.
     */
    public function redirectAndExit()
    {
        $message = __METHOD__ . '(): Do not force calls to exit() as these will terminate '
                 . 'the whole test run and therefore make the code untestable.';
        throw new Mol_Test_Exception($message);
    }
    
}
