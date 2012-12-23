<?php

/**
 * Mol_Validate_Form_Relation_NotContains
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
 * Validator which ensures that a value does not contain another value.
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
class Mol_Validate_Form_Relation_NotContains extends Zend_Validate_Abstract
{
    
    /**
     * Identifier for failure message if values are equal.
     *
     * @var string
     */
    const CONTAINS = 'relationNotContainsValueContains';
    
    /**
     * Failure message templates.
     *
     * @var array(string=>string)
     */
    protected $_messageTemplates = array(
        self::CONTAINS => "Input must not contain '%compareLabel%'"
    );
    
    /**
     * Checks if $value does not contain $other.
     *
     * @param string $value
     * @param string $other
     * @return boolean True if $value does not contain $other, false otherwise.
     */
    public function isValid($value, $other = null)
    {
        $this->_setValue($value);
        if (strpos($value, $other) !== false) {
            $this->_error(self::CONTAINS);
            return false;
        }
        return true;
    }
    
}
