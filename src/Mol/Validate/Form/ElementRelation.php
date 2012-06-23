<?php

/**
 * Mol_Validate_Form_ElementRelation
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
class Mol_Validate_Form_ElementRelation extends Zend_Validate_Abstract
{
    
    /**
     * Creates a validator that uses the provided relation and
     * compares the validated value against the value of the given
     * form element.
     *
     * @param string $relation
     * @param Zend_Form_Element $element
     */
    public function __construct($relation, Zend_Form_Element $element)
    {
        
    }
    
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