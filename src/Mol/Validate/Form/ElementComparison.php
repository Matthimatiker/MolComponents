<?php

/**
 * Mol_Validate_Form_ElementComparison
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 23.06.2012
 */

/**
 * Validator that compares the values of two different form elements.
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 23.06.2012
 */
class Mol_Validate_Form_ElementComparison extends Zend_Validate_Abstract
{
    
    /**
     * Checks if the values of the two form elements fulfill the relation.
     *
     * @param mixed $value
     * @param array(string=>string)|null $context
     * @return boolean
     */
    public function isValid($value, $context = null)
    {
        
    }
    
}