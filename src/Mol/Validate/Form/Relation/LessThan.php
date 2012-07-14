<?php

/**
 * Mol_Validate_Form_Relation_LessThan
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 24.06.2012
 */

/**
 * Validator that checks if a value is less than a compared value.
 *
 * Can be used in combination with Mol_Validate_Form_ElementRelation.
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 24.06.2012
 */
class Mol_Validate_Form_Relation_LessThan extends Zend_Validate_Abstract
{
    
    /**
     * Identifier for failure message if value is greater than or equals
     * the compared value.
     *
     * @var string
     */
    const GREATER_OR_EQUAL = 'relationLessThanValueGreaterOrEqual';
    
    /**
     * Failure message templates.
     *
     * @var array(string=>string)
     */
    protected $_messageTemplates = array(
        self::GREATER_OR_EQUAL => "Input must be less than '%compareLabel%'"
    );
    
    /**
     * Checks if $value is less than $other.
     *
     * @param mixed $value
     * @param mixed $other The compared value.
     * @return boolean True if the value is less, false otherwise.
     */
    public function isValid($value, $other = null)
    {
        $this->_setValue($value);
        if ($value >= $other) {
            $this->_error(self::GREATER_OR_EQUAL);
            return false;
        }
        return true;
    }
    
}
