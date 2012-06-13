<?php

/**
 * Mol_DataType_MapTest
 *
 * @package Mol_DataType
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright  2010-2012 Matthias Molitor
 * @version $Rev: 416 $
 * @since 27.12.2010
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the Mol_DataType_Map class.
 *
 * @package Mol_DataType
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright  2010-2012 Matthias Molitor
 * @version $Rev: 416 $
 * @since 27.12.2010
 */
class Mol_DataType_MapTest extends PHPUnit_Framework_TestCase
{
    /**
     * System under test.
     *
     * @var Mol_DataType_Map
     */
    protected $map = null;

    /**
     * The registered default value.
     *
     * An object is used to allow identity tests.
     *
     * @var stdClass
     */
    protected $default = null;

    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->default        = new stdClass();
        $this->default->value = 'hallo';
        $this->map            = new Mol_DataType_Map(array('a' => 1, 'b' => 2, 'c' => 3), $this->default);
    }

    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->map     = null;
        $this->default = null;
        parent::tearDown();
    }

    /**
     * Tests if the values are accessible via array syntax.
     */
    public function testPropertiesCanBeAccessedByArraySyntax()
    {
        $this->assertEquals(1, $this->map['a']);
    }

    /**
     * Tests if the values are accessible via property syntax.
     */
    public function testPropertiesCanBeAccessedByObjectSyntax()
    {
        $this->assertEquals(2, $this->map->b);
    }

    /**
     * Ensures that the default value is returned if the requested key
     * does not exist.
     */
    public function testMapReturnsDefaultValueIfKeyDoesNotExist()
    {
        $this->assertEquals($this->default, $this->map['d']);
    }

    /**
     * Ensures that the default value exists once and is not copied on
     * each request.
     */
    public function testMapDoesNotCloneDefaultValues()
    {
        $this->assertSame($this->map['d'], $this->map['e']);
    }

    /**
     * Ensures that using register() with a single key works.
     */
    public function testRegisterCanBeUsedWithSingleKey()
    {
        $this->map->register('buhuhu', 'd');
        $this->assertEquals('buhuhu', $this->map['d']);
    }

    /**
     * Ensures that using register() with a multiple keys works.
     */
    public function testRegisterWorksWithMultipleKeys()
    {
        $this->map->register('buhuhu', array('d', 'e'));
        $this->assertEquals('buhuhu', $this->map['d']);
        $this->assertEquals('buhuhu', $this->map['e']);
    }

    /**
     * Ensures that register() does not copy values that are assigned to multiple keys.
     * Therefore the same object may be accessible through multiple keys.
     */
    public function testValuesRegisteredForMultipleKeysAreNotCloned()
    {
        $value = new stdClass();
        $this->map->register($value, array('d', 'e'));
        $this->assertSame($value, $this->map['d']);
        $this->assertSame($value, $this->map['e']);
    }

}

