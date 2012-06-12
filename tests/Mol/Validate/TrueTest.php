<?php

/**
 * Mol_Validate_TrueTest
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Validate
 * @subpackage Tests
 * @copyright Matthias Molitor 2010
 * @version $Rev: 416 $
 * @since 17.12.2010
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the True validator.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Validate
 * @subpackage Tests
 * @copyright Matthias Molitor 2010
 * @version $Rev: 416 $
 * @since 17.12.2010
 */
class Mol_Validate_TrueTest extends PHPUnit_Framework_TestCase
{
    /**
     * System under test.
     *
     * @var Mol_Validate_True
     */
    protected $validator = null;

    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->validator = new Mol_Validate_True();
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
     * Ensures that the array returned by getMessages() is empty.
     */
    public function testGetMessagesReturnsEmptyArray()
    {
        // Call isValid(), otherwise the message array is empty anyway.
        $this->validator->isValid(false);
        $messages = $this->validator->getMessages();
        $this->assertType('array', $messages);
        $this->assertEquals(0, count($messages));
    }

    /**
     * Tests if isValid() returns a boolean.
     */
    public function testIsValidReturnsBoolean()
    {
        $this->assertType('boolean', $this->validator->isValid(false));
    }

    /**
     * Ensures that isValid() returns true if a boolean is validated.
     */
    public function testIsValidReturnsTrueForBoolean()
    {
        $this->assertTrue($this->validator->isValid(false));
    }

}

