<?php

/**
 * Mol_Application_Resource_TestData_Form_FactoryPlugin
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 05.10.2012
 */

/**
 * Form factory plugin that is just used for testing.
 *
 * Stores provided options to allow detailed checks later.
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 05.10.2012
 */
class Mol_Application_Resource_TestData_Form_FactoryPlugin implements Mol_Form_Factory_Plugin, Mol_Application_Bootstrap_Aware
{
    
    /**
     * The received options.
     *
     * @var array(string=>mixed)
     */
    protected $options = null;
    
    /**
     * The injected bootstrapper.
     *
     * @var Zend_Application_Bootstrap_BootstrapAbstract|null
     */
    protected $bootstrapper = null;
    
    /**
     * See {@link Mol_Form_Factory_Plugin::__construct()} for details.
     *
     * @param array(string=>mixed) $options
     */
    public function __construct(array $options = array())
    {
        $this->options = $options;
    }
    
    /**
     * See {@link Mol_Form_Factory_Plugin::enhance()} for details.
     *
     * @param Zend_Form $form
     */
    public function enhance(Zend_Form $form)
    {
    }
    
    /**
     * Returns the received options.
     *
     * @return array(string=>mixed)
     */
    public function getOptions()
    {
        return $this->options;
    }
    
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
     * @return Zend_Application_Bootstrap_BootstrapAbstract|null
     */
    public function getBootstrap()
    {
        return $this->bootstrapper;
    }
    
}
