<?php

/**
 * Mol_Validate_String
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Validate
 * @copyright Matthias Molitor 2010
 * @version $Rev: 418 $
 * @since 17.12.2010
 */

/**
 * A validator that checks if a given value is a string.
 *
 * Example:
 * <code>
 * $validator = Mol_Validate_String();
 * // Returns false.
 * $validator->isValid(42);
 * // Returns true.
 * $validator->isValid('42');
 * </code>
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Validate
 * @copyright Matthias Molitor 2010
 * @version $Rev: 418 $
 * @since 17.12.2010
 */
class Mol_Validate_String implements Zend_Validate_Interface {

    /**
     * The error messages of the last validation.
     *
     * @var array(string=>string)
     */
    protected $messages = array();
    
    /**
     * See {@link Zend_Validate_Interface::getMessages()} for details.
     *
     * @return array(string=>string)
     */
    public function getMessages() {
        return $this->messages;
    }

    /**
     * See {@link Zend_Validate_Interface::isValid()} for details.
     *
     * @param mixed $value
     * @return boolean
     */
    public function isValid( $value ) {
        if( !is_string($value) ) {
            $this->messages = array(
                'notOfTypeString' => 'Value is not of type string. Type is "' . gettype($value) . '".'
            );
            return false;
        }
        return true;
    }
    
}

?>