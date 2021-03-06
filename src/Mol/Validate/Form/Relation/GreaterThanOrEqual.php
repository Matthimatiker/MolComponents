<?php

/**
 * Mol_Validate_Form_Relation_GreaterThanOrEqual
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
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
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 28.06.2012
 */
class Mol_Validate_Form_Relation_GreaterThanOrEqual extends Zend_Validate_Abstract
{
    
    /**
     * Identifier for failure message if value is less
     * than the compared value.
     *
     * @var string
     */
    const LESS = 'relationGreaterThanOrEqualValueLess';
    
    /**
     * Failure message templates.
     *
     * @var array(string=>string)
     */
    protected $_messageTemplates = array(
        self::LESS => "Input must be greater than or equal to '%compareLabel%'"
    );
    
    /**
     * Checks if $value is greater than or equal to $other.
     *
     * @param mixed $value
     * @param mixed $other The compared value.
     * @return boolean True if the value is greater or equal, false otherwise.
     */
    public function isValid($value, $other = null)
    {
        $this->_setValue($value);
        if ($value < $other) {
            $this->_error(self::LESS);
            return false;
        }
        return true;
    }
    
}
