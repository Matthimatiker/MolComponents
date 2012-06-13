<?php

/**
 * Mol_Filter_NullTest
 *
 * @package Mol_Filter
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
 * Tests the Null filter.
 *
 * @package Mol_Filter
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @version $Rev: 416 $
 * @since 17.12.2010
 */
class Mol_Filter_NullTest extends PHPUnit_Framework_TestCase
{
    /**
     * System under test.
     *
     * @var Mol_Filter_Null
     */
    protected $filter = null;

    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->filter = new Mol_Filter_Null();
    }

    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->filter = null;
        parent::tearDown();
    }

    /**
     * Ensures that null is not modified.
     */
    public function testFilterDoesNotModifyNull()
    {
        $this->assertNotModified(null);
    }

    /**
     * Ensures that a boolean is not modified.
     */
    public function testFilterDoesNotModifyBoolean()
    {
        $this->assertNotModified(true);
    }

    /**
     * Ensures that an integer is not modified.
     */
    public function testFilterDoesNotModifyInteger()
    {
        $this->assertNotModified(42);
    }

    /**
     * Ensures that a string is not modified.
     */
    public function testFilterDoesNotModifyString()
    {
        $this->assertNotModified('Hello World!');
    }

    /**
     * Ensures that an array is not modified.
     */
    public function testFilterDoesNotModifyArray()
    {
        $this->assertNotModified(array(1, 2, 3));
    }

    /**
     * Ensures that an object is not modified.
     */
    public function testFilterDoesNotModifyObject()
    {
        $this->assertNotModified(new stdClass());
    }

    /**
     * Asserts that the given value is not modified by the filter.
     *
     * @param mixed $value
     */
    protected function assertNotModified( $value )
    {
        $this->assertSame($value, $this->filter->filter($value));
    }

}

