<?php

/**
 * Mol_Test_Controller_Action_Helper_ViewRenderer
 *
 * @category PHP
 * @package Mol_Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 02.01.2013
 */

/**
 * A ViewRenderer that avoids global dependencies and is used for testing.
 *
 * @category PHP
 * @package Mol_Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 02.01.2013
 */
class Mol_Test_Controller_Action_Helper_ViewRenderer extends Zend_Controller_Action_Helper_ViewRenderer
{
    
    /**
     * Initializes the view renderer, but does not use the front controller.
     */
    public function init()
    {
        $this->initView();
    }
    
    /**
     * Determines the module directory without accessing the front
     * controller, which is a global dependency.
     *
     * @return string
     */
    public function getModuleDirectory()
    {
        $info = new ReflectionClass($this->getActionController());
        $path = $info->getFileName();
        // Controllers reside in the "controllers" directory which is located in
        // the module directory. Therefore, the upper directory is defined as
        // module directory by Zend convention.
        $this->_moduleDir = realpath(dirname($path) . '/..');
        return $this->_moduleDir;
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
     * Generates the path to a view script.
     *
     * Simple implementation that does not rely on the front controller.
     *
     * @param array(string=>string) $vars
     * @return string
     */
    protected function _translateSpec(array $vars = array())
    {
        $controller = isset($vars['controller']) ? $vars['controller'] : $this->getRequest()->getControllerName();
        $action     = isset($vars['action']) ? $vars['action'] : $this->getRequest()->getActionName();
        $suffix     = isset($vars['suffix']) ? $vars['suffix'] : $this->getViewSuffix();
        return $controller . '/' . $action . '.' . $suffix;
    }
    
    /**
     * Retrieve base path.
     *
     * @return string
     */
    protected function _getBasePath()
    {
        return './views';
    }
    
    
    /**
     * Determine if a view script should be rendered without using
     * the front controller.
     *
     * @return boolean
     */
    protected function _shouldRender()
    {
        return (!$this->_neverRender
                && !$this->_noRender
                && (null !== $this->_actionController)
                && $this->getRequest()->isDispatched()
                && !$this->getResponse()->isRedirect()
        );
    }
    
}
