<?php

/**
 * Mol_Application_Bootstrap_Aware
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 14.10.2012
 */

/**
 * Interface that is used in combination with Mol_Application_Bootstrap_Injector
 * and defines a way to inject a bootstrapper.
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 14.10.2012
 */
interface Mol_Application_Bootstrap_Aware
{
    
    /**
     * This method is called to inject a bootstrapper.
     *
     * @param Zend_Application_Bootstrap_BootstrapAbstract $bootstrapper
     */
    public function setBootstrap(Zend_Application_Bootstrap_BootstrapAbstract $bootstrapper);
    
}
