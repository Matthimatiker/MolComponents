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
abstract class Mol_Form_Factory_Plugin_AbstractPlugin
{
    
    /**
     * Returns the injected bootstrapper.
     *
     * @return Zend_Application_Bootstrap_BootstrapAbstract
     * @throws RuntimeException If the bootstrapper was not injected yet.
     */
    protected function getBootstrap()
    {
        
    }
    
    /**
     * Returns the resource with the provided name.
     *
     * @param string $name
     * @return mixed
     */
    protected function getResource($name)
    {
        
    }
    
}
