<?php

/**
 * Mol_Validate_True
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Validate
 * @copyright  2010-2012 Matthias Molitor
 * @version $Rev: 418 $
 * @since 17.12.2010
 */

/**
 * A validator that returns always true.
 *
 * May be used as null or special case object.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Validate
 * @copyright  2010-2012 Matthias Molitor
 * @version $Rev: 418 $
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
    public function isValid( $value )
    {
        return true;
    }
    // @codingStandardsIgnoreEnd

}

