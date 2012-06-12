<?php

/**
 * Mol_Controller_Exception_ParameterTagMissing
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Controller
 * @copyright  2010-2012 Matthias Molitor
 * @version $Rev: 441 $
 * @since 16.12.2010
 */

/**
 * Exception that is used if an action methods DocBlock is defined, but does
 * not contain enough information for a declared parameter.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Controller
 * @copyright  2010-2012 Matthias Molitor
 * @version $Rev: 441 $
 * @since 16.12.2010
 */
class Mol_Controller_Exception_ParameterTagMissing extends Mol_Controller_Exception_ActionParameter
{
    /**
     * Creates the exception.
     *
     * With $paramName the parameter whose documentation is missing may be specified.
     *
     * @param string|null $paramName
     * @param integer|null $code
     * @param Exception|null $previous
     */
    public function __construct($paramName = null, $code = null, Exception $previous = null)
    {
        $message = null;
        if( $paramName !== null ) {
            $message = 'Missing DocTag for parameter "' . $paramName . '".';
        }
        parent::__construct($message, $code, $previous);
    }

}

