<?php

/**
 * Mol_Validate_Form_Relation_Contains
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 21.12.2012
 */

/**
 * Validator which ensures that a value contains another value.
 *
 * Can be used in combination with Mol_Validate_Form_ElementRelation.
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 21.12.2012
 */
class Mol_Validate_Form_Relation_Contains extends Zend_Validate_Abstract
{
    
    /**
     * Identifier for failure message if value does not
     * contain the compared value.
     *
     * @var string
     */
    const NOT_CONTAINS = 'relationContainsValueNotContains';
    
    /**
     * Failure message templates.
     *
     * @var array(string=>string)
     */
    protected $_messageTemplates = array(
        self::NOT_CONTAINS => "Input must contain '%compareLabel%'"
    );
    
    /**
     * Checks if $value contains $other.
     *
     * @param string $value
     * @param string $other
     * @return boolean True if $value contains $other, false otherwise.
     */
    public function isValid($value, $other = null)
    {
        
    }
    
}
