<?php

/**
 * Mol_Controller_Exception_ParameterNotValidTest
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Controller
 * @subpackage Tests
 * @copyright Matthias Molitor 2010
 * @version $Rev: 371 $
 * @since 17.12.2010
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the additional functionality of the Mol_Controller_Exception_ParameterNotValid exception.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Controller
 * @subpackage Tests
 * @copyright Matthias Molitor 2010
 * @version $Rev: 371 $
 * @since 17.12.2010
 */
class Mol_Controller_Exception_ParameterNotValidTest extends PHPUnit_Framework_TestCase {
    
    /**
     * Ensures that getMessage() returns the correct value if a string
     * argument was passed to the constructor.
     */
    public function testGetMessageReturnsCorrectValueIfStringWasProvided() {
        $exception = new Mol_Controller_Exception_ParameterNotValid('Hello World!');
        $this->assertEquals('Hello World!', $exception->getMessage());
    }
    
    /**
     * Ensures that getMessage() returns the correct value if a validator was
     * passed as constructor argument.
     */
    public function testGetMessageReturnsCorrectValueIfValidatorWasProvided() {
        $validator = new Mol_Validate_False('My error message.');
        // Call isValid() to ensure that the message is available.
        $validator->isValid(false);
        $exception = new Mol_Controller_Exception_ParameterNotValid($validator);
        $this->assertEquals('My error message.', $exception->getMessage());
    }
    
    /**
     * Ensures that the exception can be created without any constructor argument.
     */
    public function testExceptionCanBeConstructedWithoutParameters() {
        $this->setExpectedException(null);
        new Mol_Controller_Exception_ParameterNotValid();
    }
    
}

?>