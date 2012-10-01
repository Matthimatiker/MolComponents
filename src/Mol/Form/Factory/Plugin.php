<?php

/**
 * Mol_Form_Factory_Plugin
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.10.2012
 */

/**
 * Interface for plugins that can be added to the form factory.
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.10.2012
 */
interface Mol_Form_Factory_Plugin
{
    
    /**
     * Gives the plugin the chance to enhance the provided form.
     *
     * @param Zend_Form $form
     */
    public function enhance(Zend_Form $form);
    
}
