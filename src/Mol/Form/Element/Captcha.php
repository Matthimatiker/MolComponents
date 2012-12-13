<?php

/**
 * Mol_Form_Element_Captcha
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 13.12.2012
 */

/**
 * A captcha element which must be solved only once by the user.
 *
 * When solved a message like "already successfully solved"  will be shown
 * instead of the captcha.
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 13.12.2012
 */
class Mol_Form_Element_Captcha extends Zend_Form_Element_Captcha
{
    
    /**
     * Checks if the captcha was already solved.
     *
     * @return boolean
     */
    protected function isSolved()
    {
        
    }
    
    /**
     * Marks the captcha as solved.
     */
    protected function markAsSolved()
    {
        
    }
    
}
