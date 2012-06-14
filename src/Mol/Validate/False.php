<?php

/**
 * Mol_Validate_False
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
 * A validator that always returns false.
 *
 * May be used as a null or special case object.
 *
 * The error message is customizable:
 * <code>
 * $validator = new Mol_Validate_False('Invalid');
 * // Returns false.
 * $validator->isValid('hello');
 * // Returns an array with the message "Invalid".
 * $validator->getMessages();
 * </code>
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 17.12.2010
 */
class Mol_Validate_False implements Zend_Validate_Interface
{
    /**
     * Contains error messages for the last isValid() call.
     *
     * @var array(string=>string)
     */
    protected $messages = array();

    /**
     * The key that is used to store the error message.
     *
     * @var string
     */
    protected $failureMessageKey = null;

    /**
     * The error message.
     *
     * @var string
     */
    protected $failureMessage = null;

    /**
     * Creates the validator.
     *
     * @param string $message The error message.
     * @param string $messageKey
     */
    public function __construct($message, $messageKey = __CLASS__)
    {
        $this->failureMessage    = $message;
        $this->failureMessageKey = $messageKey;
    }

    /**
     * See {@link Zend_Validate_Interface::getMessages()} for details.
     *
     * @return array(string=>string)
     */
    public function getMessages()
    {
        return $this->messages;
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
        $this->messages[$this->failureMessageKey] = $this->failureMessage;
        return false;
    }
    // @codingStandardsIgnoreEnd

}

