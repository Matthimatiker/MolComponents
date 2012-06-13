<?php

/**
 * Mol_Validate_FalseTest
 *
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @version $Rev: 416 $
 * @since 17.12.2010
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the False validator.
 *
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @version $Rev: 416 $
 * @since 17.12.2010
 */
class Mol_Validate_FalseTest extends PHPUnit_Framework_TestCase
{
    /**
     * System under test.
     *
     * @var Mol_Validate_False
     */
    protected $validator = null;

    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->validator = new Mol_Validate_False('Hello World!', 'message');
    }

    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->validator = null;
        parent::tearDown();
    }

    /**
     * Tests if getMessages() returns an array.
     */
    public function testGetMessagesReturnsArray()
    {
        $this->assertType('array', $this->validator->getMessages());
    }

    /**
     * Ensures that getMessages() returns an empty array if isValid()
     * was not called.
     */
    public function testGetMessagesReturnsEmptyArrayIfIsValidWasNotCalled()
    {
        $messages = $this->validator->getMessages();
        $this->assertType('array', $messages);
        $this->assertEquals(0, count($messages));
    }

    /**
     * Ensures that getMessages() contains the defined message.
     */
    public function testGetMessagesReturnsArrayWithProvidedMessage()
    {
        // Call isValid() to ensure that a message is available.
        $this->validator->isValid(false);
        $messages = $this->validator->getMessages();
        $this->assertType('array', $messages);
        $this->assertContains('Hello World!', $messages);
    }

    /**
     * Ensures that the provided key is used to store the message.
     */
    public function testGetMessagesReturnsArrayWithProvidedMessageKey()
    {
        // Call isValid() to ensure that a message is available.
        $this->validator->isValid(false);
        $messages = $this->validator->getMessages();
        $this->assertType('array', $messages);
        $this->assertArrayHasKey('message', $messages);
    }

    /**
     * Ensures that getMessages() contains just the provided message.
     */
    public function testGetMessagesReturnsSingleMessage()
    {
        // Call isValid() to ensure that a message is available.
        $this->validator->isValid(false);
        $messages = $this->validator->getMessages();
        $this->assertType('array', $messages);
        $this->assertEquals(1, count($messages));
    }

    /**
     * Tests if isValid() return a boolean.
     */
    public function testIsValidReturnsBoolean()
    {
        $this->assertType('boolean', $this->validator->isValid(false));
    }

    /**
     * Ensures that isValid() returns false if a boolean is validated.
     */
    public function testIsValidReturnsFalseForBoolean()
    {
        $this->assertFalse($this->validator->isValid(true));
    }

}

