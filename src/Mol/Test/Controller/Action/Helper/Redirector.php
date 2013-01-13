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
    protected $exit = false;
    
}
