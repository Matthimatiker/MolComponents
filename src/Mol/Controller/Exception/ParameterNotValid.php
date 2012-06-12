<?php

/**
 * Mol_Controller_Exception_ParameterNotValid
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Controller
 * @copyright Matthias Molitor 2010
 * @version $Rev: 371 $
 * @since 16.12.2010
 */

/**
 * Exception that is used if provided parameter is not of the expected type.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Controller
 * @copyright Matthias Molitor 2010
 * @version $Rev: 371 $
 * @since 16.12.2010
 */
class Mol_Controller_Exception_ParameterNotValid extends Mol_Controller_Exception_ActionParameter {
    
    /**
     * Creates the exception.
     *
     * @param string|Zend_Validate_Interface|null $messageOrValidator
     * @param integer|null $code
     * @param Exception|null $previous
     */
    public function __construct($messageOrValidator = null, $code = null, Exception $previous = null) {
        if( $messageOrValidator instanceof Zend_Validate_Interface ) {
            $messageOrValidator = $this->toMessage($messageOrValidator);
        }
        parent::__construct($messageOrValidator, $code, $previous);
    }
    
    /**
     * Extracts the error messages from the validator and return them as string.
     *
     * @param Zend_Validate_Interface $validator
     * @return string
     */
    protected function toMessage(Zend_Validate_Interface $validator) {
        $messages = $validator->getMessages();
        return implode(PHP_EOL, $messages);
    }
    
}

?>