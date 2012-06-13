<?php

/**
 * Mol_Controller_Exception_ParameterTagMissing
 *
 * @category PHP
 * @package Mol_Controller
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 16.12.2010
 */

/**
 * Exception that is used if an action methods DocBlock is defined, but does
 * not contain enough information for a declared parameter.
 *
 * @category PHP
 * @package Mol_Controller
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
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
        if ($paramName !== null) {
            $message = 'Missing DocTag for parameter "' . $paramName . '".';
        }
        parent::__construct($message, $code, $previous);
    }

}

