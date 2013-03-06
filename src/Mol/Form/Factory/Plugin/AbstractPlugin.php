<?php

/**
 * Mol_Form_Factory_Plugin_AbstractPlugin
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 10.02.2013
 */

/**
 * Optional base class for form factory plugins.
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 10.02.2013
 */
abstract class Mol_Form_Factory_Plugin_AbstractPlugin implements
    Mol_Form_Factory_Plugin,
    Mol_Application_Bootstrap_Aware
{
    
    /**
     * Options that were passed to the plugin.
     *
     * @var array(string=>mixed)
     */
    protected $options = null;
    
    /**
     * The injected bootstrapper.
     *
     * Null if the bootstrapper was not injected yet.
     *
     * @var Zend_Application_Bootstrap_BootstrapAbstract|null
     */
    private $bootstrapper = null;
    
    /**
     * See {@link Mol_Application_Bootstrap_Aware::setBootstrap()} for details.
     *
     * @param Zend_Application_Bootstrap_BootstrapAbstract $bootstrapper
     */
    public function setBootstrap(Zend_Application_Bootstrap_BootstrapAbstract $bootstrapper)
    {
        $this->bootstrapper = $bootstrapper;
    }
    
    /**
     * Returns the injected bootstrapper.
     *
     * @return Zend_Application_Bootstrap_BootstrapAbstract
     * @throws RuntimeException If the bootstrapper was not injected yet.
     */
    protected function getBootstrap()
    {
        if ($this->bootstrapper === null) {
            $message = 'Bootstrapper was not injected yet. Use setBootstrap() to inject a bootstrapper.';
            throw new RuntimeException($message);
        }
        return $this->bootstrapper;
    }
    
    /**
     * Returns the resource with the provided name.
     *
     * @param string $name
     * @return mixed
     */
    protected function getResource($name)
    {
        $this->getBootstrap()->bootstrap($name);
        return $this->getBootstrap()->getResource($name);
    }
    
    /**
     * Returns the value of the provided option.
     *
     * Returns $default if the option does not exist.
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    protected function getOption($name, $default = null)
    {
        
    }
    
}
