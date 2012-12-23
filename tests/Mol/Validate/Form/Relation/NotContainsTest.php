<?php

/**
 * Mol_Validate_Form_Relation_NotContainsTest
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
 * Tests the NotContains relation validator.
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
class Mol_Validate_Form_Relation_NotContainsTest extends PHPUnit_Framework_TestCase
{
    
    
    /**
     * System under test.
     *
     * @var Mol_Validate_Form_Relation_NotContains
     */
    protected $validator = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->validator = new Mol_Validate_Form_Relation_NotContains();
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
     * Checks if the validator accepts a value that does not contain the
     * compared value.
     */
    public function testValidatorAcceptsValueThatDoesNotContainComparedValue()
    {
        $this->assertTrue($this->validator->isValid('hello world', 'universe'));
    }
    
    /**
     * Ensures that the validator rejects a value that starts with the
     * compared value.
     */
    public function testValidatorRejectsValueThatStartsWithComparedValue()
    {
        $this->assertFalse($this->validator->isValid('hello world', 'hello'));
    }
    
    /**
     * Ensures that the validator rejects a value that contains the
     * compared value.
     */
    public function testValidatorRejectsValueThatContainsComparedValue()
    {
        $this->assertFalse($this->validator->isValid('hello world', 'lo wo'));
    }
    
    /**
     * Ensures that the validator rejects a value that ends with the
     * compared value.
     */
    public function testValidatorRejectsValueThatEndsWithComparedValue()
    {
        $this->assertFalse($this->validator->isValid('hello world', 'world'));
    }
    
    /**
     * Ensures that the validator rejects a value that equals the
     * compared value.
     */
    public function testValidatorRejectsValueThatEqualsComparedValue()
    {
        $this->assertFalse($this->validator->isValid('hello world', 'hello world'));
    }
    
    /**
     * Ensures that the validator provides a failure message if the
     * value is rejected.
     */
    public function testValidatorProvidesFailureMessageIfValueIsRejected()
    {
        $this->validator->isValid('123', '2');
        $messages = $this->validator->getMessages();
        $this->assertInternalType('array', $messages);
        $this->assertGreaterThan(0, count($messages));
    }
    
}
