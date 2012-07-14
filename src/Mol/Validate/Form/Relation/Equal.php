<?php

/**
 * Mol_Validate_Form_Relation_Equal
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
 * Validator that checks if two values are equal.
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
class Mol_Validate_Form_Relation_Equal extends Zend_Validate_Abstract
{
    
    /**
     * Identifier for failure message if values are not equal.
     *
     * @var string
     */
    const NOT_EQUAL = 'relationEqualValuesNotEqual';
    
    /**
     * Failure message templates.
     *
     * @var array(string=>string)
     */
    protected $_messageTemplates = array(
        self::NOT_EQUAL => "Input must be equal to '%compareLabel%'"
    );
    
    /**
     * Checks if the two values are equal.
     *
     * @param mixed $value
     * @param mixed $other The compared value.
     * @return boolean True if the values are equal, false otherwise.
     */
    public function isValid($value, $other = null)
    {
        $this->_setValue($value);
        if ($value !== $other) {
            $this->_error(self::NOT_EQUAL);
            return false;
        }
        return true;
    }
    
}
