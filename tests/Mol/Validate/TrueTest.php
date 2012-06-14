<?php

/**
 * Mol_Validate_TrueTest
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 17.12.2010
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the True validator.
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
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
        $this->assertInternalType('array', $this->validator->getMessages());
    }

    /**
     * Ensures that the array returned by getMessages() is empty.
     */
    public function testGetMessagesReturnsEmptyArray()
    {
        // Call isValid(), otherwise the message array is empty anyway.
        $this->validator->isValid(false);
        $messages = $this->validator->getMessages();
        $this->assertInternalType('array', $messages);
        $this->assertEquals(0, count($messages));
    }

    /**
     * Tests if isValid() returns a boolean.
     */
    public function testIsValidReturnsBoolean()
    {
        $this->assertInternalType('boolean', $this->validator->isValid(false));
    }

    /**
     * Ensures that isValid() returns true if a boolean is validated.
     */
    public function testIsValidReturnsTrueForBoolean()
    {
        $this->assertTrue($this->validator->isValid(false));
    }

}

