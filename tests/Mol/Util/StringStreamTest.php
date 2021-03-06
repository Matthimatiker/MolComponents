<?php

/**
 * Mol_Util_StringStreamTest
 *
 * @category PHP
 * @package Mol_Util
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 02.07.2011
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the StringStream helper class.
 *
 * @category PHP
 * @package Mol_Util
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 02.07.2011
 */
class Mol_Util_StringStreamTest extends PHPUnit_Framework_TestCase
{
    /**
     * The string that is used for testing.
     */
    const TEST_STRING = 'Chocolate for 75% less! Only Today!';

    /**
     * System under test.
     *
     * @var Mol_Util_StringStream
     */
    protected $stream = null;

    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->stream = new Mol_Util_StringStream(self::TEST_STRING);
    }

    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->stream = null;
        parent::tearDown();
    }

    /**
     * Ensures that an exception is thrown if an invalid argument is
     * passed to the constructor.
     */
    public function testConstructorThrowsExceptionIfInvalidArgumentIsProvided()
    {
        $this->setExpectedException('RuntimeException');
        new Mol_Util_StringStream(new stdClass());
    }

    /**
     * Ensures that __toString() returns an stream identifier.
     */
    public function testToStringReturnsStreamIdentifier()
    {
        $identifier = (string)$this->stream;
        $this->assertFalse(empty($identifier), 'No identifier created.');
    }

    /**
     * Checks if the stream identifier is readable via stream functions.
     */
    public function testStreamIdentifierIsReadable()
    {
        $content = file_get_contents($this->stream);
        $this->assertEquals(self::TEST_STRING, $content, 'Failed to read correct content from stream.');
    }

}

