<?php

/**
 * Mol_Form_Factory_Plugin_AutoCompleteOff
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 13.10.2012
 */

/**
 * Plugin that disables browser auto completion for all forms.
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 13.10.2012
 */
class Mol_Form_Factory_Plugin_AutoCompleteOff implements Mol_Form_Factory_Plugin
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
     * Gives the plugin the chance to enhance the provided form.
     *
     * @param Zend_Form $form
     */
    public function enhance(Zend_Form $form)
    {
        
    }
    
}
