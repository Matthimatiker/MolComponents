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

