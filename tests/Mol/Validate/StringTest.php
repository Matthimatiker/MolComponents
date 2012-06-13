<?php

/**
 * Mol_Validate_StringTest
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
 * Tests the String validator.
 *
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @version $Rev: 416 $
 * @since 17.12.2010
 */
class Mol_Validate_StringTest extends PHPUnit_Framework_TestCase
{
    /**
     * System under test.
     *
     * @var Mol_Validate_String
     */
    protected $validator = null;

    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->validator = new Mol_Validate_String();
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
     * Ensures that getMessages() returns a single message.
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
     * Tests if isValid() returns a boolean
     */
    public function testIsValidReturnsBoolean()
    {
        $this->assertType('boolean', $this->validator->isValid(false));
    }

    /**
     * Ensures that the validator rejects a boolean.
     */
    public function testIsValidReturnsFalseForBoolean()
    {
        $this->assertFalse($this->validator->isValid(true));
    }

    /**
     * Ensures that the validator rejects an integer.
     */
    public function testIsValidReturnsFalseForInteger()
    {
        $this->assertFalse($this->validator->isValid(42));
    }

    /**
     * Ensures that the validator rejects a double.
     */
    public function testIsValidReturnsFalseForDouble()
    {
        $this->assertFalse($this->validator->isValid(42.0));
    }

    /**
     * Ensures that the validator rejects an array.
     */
    public function testIsValidReturnsFalseForArray()
    {
        $this->assertFalse($this->validator->isValid(array(1)));
    }

    /**
     * Ensures that the validator rejects an object.
     */
    public function testIsValidReturnsFalseForObject()
    {
        $this->assertFalse($this->validator->isValid(new stdClass()));
    }

    /**
     * Ensures that the validator rejects null.
     */
    public function testIsValidReturnsFalseForNull()
    {
        $this->assertFalse($this->validator->isValid(null));
    }

    /**
     * Ensures that isValid() accepts a string.
     */
    public function testIsValidReturnsTrueForString()
    {
        $this->assertTrue($this->validator->isValid('Hello World!'));
    }

    /**
     * Ensures that isValid() accepts an empty string.
     */
    public function testIsValidReturnsTrueForEmptyString()
    {
        $this->assertTrue($this->validator->isValid(''));
    }

}

