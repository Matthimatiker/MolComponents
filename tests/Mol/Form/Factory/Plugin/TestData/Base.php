<?php

/**
 * Mol_Form_Factory_Plugin_TestData_Base
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 05.03.2013
 */

/**
 * Simple form factory plugin that is used to test the functionality
 * of the abstract plugin.
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 05.03.2013
 */
class Mol_Form_Factory_Plugin_TestData_Base extends Mol_Form_Factory_Plugin_AbstractPlugin
{
    
    /**
     * Provides access to internal methods for testing.
     *
     * The parameter $method determines the method that will be called,
     * the provided arguments are passed on call.
     *
     * @param string $method
     * @param array(mixed) $args
     * @return mixed
     */
    public function execute($method, array $args = array())
    {
        return call_user_func_array(array($this, $method), $args);
    }
    
}
