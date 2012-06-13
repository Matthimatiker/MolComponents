<?php

/**
 * Mol_Validate_Boolean
 *
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @version $Rev: 378 $
 * @since 17.12.2010
 */

/**
 * A validator that checks if a value may be interpreted as boolean.
 *
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @version $Rev: 378 $
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
                // Boolans as string
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

}

