<?php

/**
 * Mol_Validate_BooleanTest
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
 * Tests the Boolean validator.
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
class Mol_Validate_BooleanTest extends PHPUnit_Framework_TestCase
{
    /**
     * Ensures that isValid() return a boolean.
     */
    public function testValidatorReturnsBoolean()
    {
        $validator = new Mol_Validate_Boolean();
        $this->assertType('boolean', $validator->isValid('test'));
    }

    /**
     * Ensures that the validator accepts the boolean value true.
     */
    public function testValidatorAcceptsTrue()
    {
        $this->assertAccepts(true);
    }

    /**
     * Ensures that the validator accepts the boolean value false.
     */
    public function testValidatorAcceptsFalse()
    {
        $this->assertAccepts(false);
    }

    /**
     * Ensures that the validator accepts the string "true".
     */
    public function testValidatorAcceptsTrueAsString()
    {
        $this->assertAccepts('true');
    }

    /**
     * Ensures that the validator accepts the string "false".
     */
    public function testValidatorAcceptsFalseAsString()
    {
        $this->assertAccepts('false');
    }

    /**
     * Ensures that the validator accepts the integer 0.
     */
    public function testValidatorAcceptsZero()
    {
        $this->assertAccepts(0);
    }

    /**
     * Ensures that the validator accepts the integer 1.
     */
    public function testValidatorAcceptsOne()
    {
        $this->assertAccepts(1);
    }

    /**
     * Ensures that the validator accepts the string "0".
     */
    public function testValidatorAcceptsZeroAsString()
    {
        $this->assertAccepts('0');
    }

    /**
     * Ensures that the validator accepts the string "1".
     */
    public function testValidatorAcceptsOneAsString()
    {
        $this->assertAccepts('1');
    }

    /**
     * Ensures that the validator accepts the string "yes".
     */
    public function testValidatorAcceptsYes()
    {
        $this->assertAccepts('yes');
    }

    /**
     * Ensures that the validator accepts the string "no".
     */
    public function testValidatorAcceptsNo()
    {
        $this->assertAccepts('no');
    }

    /**
     * Ensures that the validator rejects integer values greater than 1.
     */
    public function testValidatorRejectsIntegersGreaterThanOne()
    {
        $this->assertRejects(2);
    }

    /**
     * Ensures that the validator rejects negative integer values.
     */
    public function testValidatorRejectsNegativeIntegers()
    {
        $this->assertRejects(-1);
    }

    /**
     * Ensures that the validator rejects arrays.
     */
    public function testValidatorRejectsArrays()
    {
        $this->assertRejects(array());
    }

    /**
     * Ensures that the validator rejects objects.
     */
    public function testValidatorRejectsObjects()
    {
        $this->assertRejects(new stdClass());
    }

    /**
     * Ensures that the validator rejects strings without special meaning.
     */
    public function testValidatorRejectsStrings()
    {
        $this->assertRejects('Hello World!');
    }

    /**
     * Asserts that the validator accepts the value $value.
     *
     * @param mixed $value
     */
    protected function assertAccepts($value )
    {
        $this->assertValidation(true, $value);
    }

    /**
     * Asserts that the validator rejects the value $value.
     *
     * @param mixed $value
     */
    protected function assertRejects($value )
    {
        $this->assertValidation(false, $value);
    }

    /**
     * Asserts that the validation of $value returns $expectedResult.
     *
     * @param boolean $expectedResult
     * @param mixed $value
     */
    private function assertValidation($expectedResult, $value )
    {
        $validator = new Mol_Validate_Boolean();
        $this->assertSame($expectedResult, $validator->isValid($value));
    }

}

