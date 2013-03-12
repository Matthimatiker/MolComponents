<?php

/**
 * Mol_Form_Factory_Plugin_Captcha
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 12.03.2013
 */

/**
 * Plugin that is able to add captchas to forms.
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 12.03.2013
 */
class Mol_Form_Factory_Plugin_Captcha extends Mol_Form_Factory_Plugin_AbstractPlugin
{
    
    /**
     * Adds a captcha element to the given form if the for attribute
     * "data-captcha" equals true or "yes".
     *
     * The "data-captcha" attribute is removed after processing to
     * ensure that it is not rendered by the form.
     *
     * @param Zend_Form $form
     */
    public function enhance(Zend_Form $form)
    {
        
    }
    
}
