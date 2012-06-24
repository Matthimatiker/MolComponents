<?php

/**
 * Mol_Validate_Form_Relation_GreaterThan
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
 * Validator that checks if a value is greater than a compared value.
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
class Mol_Validate_Form_Relation_GreaterThan extends Zend_Validate_Abstract
{
    
    /**
     * Identifier for failure message if value is less than or equals
     * the compared value.
     *
     * @var string
     */
    const LESS_OR_EQUAL = 'relationGreaterThanValueLessOrEqual';
    
    /**
     * Failure message templates.
     *
     * @var array(string=>string)
     */
    protected $_messageTemplates = array(
        self::LESS_OR_EQUAL => "Input must be greater than '%compareLabel%'"
    );
    
    /**
     * Checks if $value is greater than $other.
     *
     * @param mixed $value
     * @param mixed $other The compared value.
     * @return boolean True if the value is greater, false otherwise.
     */
    public function isValid($value, $other = null)
    {
        $this->_setValue($value);
        
    }
    
}
