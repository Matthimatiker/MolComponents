<?php

/**
 * Mol_Validate_Form_Relation_ContainsTest
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 21.12.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the Contains relation validator.
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 21.12.2012
 */
class Mol_Validate_Form_Relation_ContainsTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Validate_Form_Relation_Contains
     */
    protected $validator = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->validator = new Mol_Validate_Form_Relation_Contains();
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
     * Ensures that the validator rejects a value that does not contain the
     * compared value.
     */
    public function testValidatorRejectsValueThatDoesNotContainComparedValue()
    {
        $this->assertFalse($this->validator->isValid('value', 'other'));
    }

    /**
     * Checks if the validator accepts a value that starts with the
     * compared value.
     */
    public function testValidatorAcceptsValueThatStartsWithComparedValue()
    {
        $this->assertTrue($this->validator->isValid('test value', 'test'));
    }
    
    /**
     * Checks if the validator accepts a value that contains the compared
     * value.
     */
    public function testValidatorAcceptsValueThatContainsComparedValue()
    {
        $this->assertTrue($this->validator->isValid('test value', 'st va'));
    }
    
    /**
     * Checks if the validator accepts a value that ends with the
     * compared value.
     */
    public function testValidatorAcceptsValueThatEndsWithComparedValue()
    {
        $this->assertTrue($this->validator->isValid('test value', 'value'));
    }
    
    /**
     * Checks if the validator accepts a value that equals the compared
     * value.
     */
    public function testValidatorAcceptsValueThatEqualsComparedValue()
    {
        $this->assertTrue($this->validator->isValid('test value', 'test value'));
    }
    
    /**
     * Ensures that the validator provides a failure message if the value
     * is rejected.
     */
    public function testValidatorProvidesFailureMessageIfValueIsRejected()
    {
        $this->validator->isValid('test value', 'other');
        $messages = $this->validator->getMessages();
        $this->assertInternalType('array', $messages);
        $this->assertGreaterThan(0, count($messages));
    }
    
}
