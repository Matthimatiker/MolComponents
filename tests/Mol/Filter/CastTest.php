<?php

/**
 * Mol_Filter_CastTest
 *
 * @category PHP
 * @package Mol_Filter
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
 * Tests the Cast filter.
 *
 * @category PHP
 * @package Mol_Filter
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 17.12.2010
 */
class Mol_Filter_CastTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if the filter casts a string to an integer correctly.
     */
    public function testFilterCastsStringToInteger()
    {
        $this->assertFilterCastsTo(42, '42', 'integer');
    }

    /**
     * Tests if the filter casts an integer to a boolean correctly.
     */
    public function testFilterCastsIntegerToBoolean()
    {
        $this->assertFilterCastsTo(false, '0', 'boolean');
    }

    /**
     * Tests if the filter casts an integer to a string correctly.
     */
    public function testFilterCastsIntegerToString()
    {
        $this->assertFilterCastsTo('42', 42, 'string');
    }

    /**
     * Tests if the filter casts a string to a double correctly.
     */
    public function testFilterCastsStringToDouble()
    {
        $this->assertFilterCastsTo(42.5, '42.5', 'double');
    }

    /**
     * Tests if the filter casts an integer to a double correctly.
     */
    public function testFilterCastsIntegerToDouble()
    {
        $this->assertFilterCastsTo(42.0, 42, 'double');
    }

    /**
     * Asserts that the filter casts $actual to expected.
     *
     * The parameter $castType determines the target type of the filter.
     *
     * @param mixed $expected The expected value.
     * @param mixed $actual The filter input.
     * @param string $castType
     */
    protected function assertFilterCastsTo($expected, $actual, $castType)
    {
        $filter = new Mol_Filter_Cast($castType);
        $this->assertSame($expected, $filter->filter($actual), 'Unexpected filter result.');
    }

}

