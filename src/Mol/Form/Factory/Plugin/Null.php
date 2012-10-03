<?php

/**
 * Mol_Form_Factory_Plugin_Null
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 03.10.2012
 */

/**
 * Form plugin that does nothing.
 *
 * Can be used to disable plugins via configuration or for testing.
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 03.10.2012
 */
class Mol_Form_Factory_Plugin_Null implements Mol_Form_Factory_Plugin
{
    
    /**
     * See {@link Mol_Form_Factory_Plugin::__construct()} for details.
     *
     * @param array(string=>mixed) $options
     */
    public function __construct(array $options = array())
    {
    }
    
    /**
     * See {@link Mol_Form_Factory_Plugin::enhance()} for details.
     *
     * @param Zend_Form $form
     */
    public function enhance(Zend_Form $form)
    {
        
    }
    
}
