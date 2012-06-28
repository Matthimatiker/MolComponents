<?php

/**
 * Mol_Validate_Form_Relation_GreaterThanOrEqual
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 28.06.2012
 */

/**
 * Validator that checks if a value is greater than or equal to a compared value.
 *
 * Can be used in combination with Mol_Validate_Form_ElementRelation.
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 28.06.2012
 */
class Mol_Validate_Form_Relation_GreaterThanOrEqual extends Zend_Validate_Abstract
{
    
    /**
     * Checks if $value is greater than $other.
     *
     * @param mixed $value
     * @param mixed $other The compared value.
     * @return boolean True if the value is greater, false otherwise.
     */
    public function isValid($value, $other = null)
    {
        
    }
    
}
