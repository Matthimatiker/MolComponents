<?php

/**
 * Mol_Form_Factory_Plugin_Csrf
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 08.10.2012
 */

/**
 * Plugin that adds CSRF tokens to forms.
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 08.10.2012
 */
class Mol_Form_Factory_Plugin_Csrf implements Mol_Form_Factory_Plugin
{
    
    /**
     * The default name for the token element.
     *
     * @var string
     */
    const DEFAULT_TOKEN_NAME = 'csrf_token';
    
    /**
     * See {@link Mol_Form_Factory_Plugin::__construct()} for details.
     *
     * @param array(string=>mixed) $options
     */
    public function __construct(array $options = array())
    {
        
    }
    
    /**
     * Adds a CSRF token to the form if it does not already contain one.
     *
     * @param Zend_Form $form
     */
    public function enhance(Zend_Form $form)
    {
        
    }
    
}
