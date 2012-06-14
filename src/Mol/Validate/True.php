<?php

/**
 * Mol_Validate_True
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
 * A validator that returns always true.
 *
 * May be used as null or special case object.
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 17.12.2010
 */
class Mol_Validate_True implements Zend_Validate_Interface
{
    /**
     * See {@link Zend_Validate_Interface::getMessages()} for details.
     *
     * @return array(string=>string)
     */
    public function getMessages()
    {
        return array();
    }

    // @codingStandardsIgnoreStart Not using the $value parameter is intended.
    /**
     * See {@link Zend_Validate_Interface::isValid()} for details.
     *
     * @param  mixed $value
     * @return boolean
     */
    public function isValid($value)
    {
        return true;
    }
    // @codingStandardsIgnoreEnd

}

