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
 * # Usage #
 *
 * ## Configuration ##
 *
 * Activate AutoComplete plugin:
 *
 *     resources.form.plugins.autoComplete = "Mol_Form_Factory_Plugin_AutoCompleteOff"
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
     * Sets the autocomplete attribute of given form to "off".
     *
     * The plugin will not modify the form if it already has
     * an autocomplete attribute.
     *
     * @param Zend_Form $form
     */
    public function enhance(Zend_Form $form)
    {
        if ($form->getAttrib('autocomplete') !== null) {
            // Autocomplete attribute is already set for
            // this form instance.
            return;
        }
        $form->setAttrib('autocomplete', 'off');
    }
    
}
