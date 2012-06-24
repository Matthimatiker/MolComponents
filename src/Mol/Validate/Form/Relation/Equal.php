<?php

/**
 * Mol_Validate_Form_Relation_Equal
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 24.06.2012
 */

/**
 * Validator that checks if two values are equal.
 *
 * Can be used in combination with Mol_Validate_Form_ElementRelation.
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 24.06.2012
 */
class Mol_Validate_Form_Relation_Equal extends Zend_Validate_Abstract
{
    
    /**
     * Checks if the two values are equal.
     *
     * @param mixed $value
     * @param mixed $other The compared value.
     * @return boolean True if the values are equal, false otherwise.
     */
    public function isValid($value, $other = null)
    {
        
    }
    
}
