<?php

/**
 * Mol_Validate_Boolean
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 17.12.2010
 */

/**
 * A validator that checks if a value may be interpreted as boolean.
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 17.12.2010
 */
class Mol_Validate_Boolean extends Zend_Validate_InArray
{
    
    /**
     * Creates the validator.
     */
    public function __construct()
    {
        $options = array(
            'haystack' => array(
                // Boolean types
                true,
                false,
                // Integers
                0,
                1,
                // Integers as string
                '0',
                '1',
                // Boolean values as string
                'true',
                'false',
                // Yes / No
                'yes',
                'no'
            ),
            'strict'   => true
        );
        parent::__construct($options);
    }
    
    /**
     * Checks if the provided value represents a boolean.
     *
     * @param mixed $value
     * @return boolean True if $value represents a boolean, false otherwise.
     */
    public function isValid($value)
    {
        if (is_array($value)) {
            // Arrays are not accepted.
            // Ensure that the value is not passed to the parent
            // isValid() method as it raises an error when generating
            // the failure message if PHP 5.4 is used.
            // See #14 for details:
            // https://github.com/Matthimatiker/MolComponents/issues/14
            return false;
        }
        return parent::isValid($value);
    }

}
