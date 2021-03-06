<?php

/**
 * Mol_Validate_Form_Relation_LessThanTest
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 24.06.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the LessThan relation validator.
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 24.06.2012
 */
class Mol_Validate_Form_Relation_LessThanTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Validate_Form_Relation_LessThan
     */
    protected $validator = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->validator = new Mol_Validate_Form_Relation_LessThan();
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
     * Checks if the validator rejects a value that is greater than $other.
     */
    public function testValidatorRejectsValueThatIsGreaterThanTheComparedOne()
    {
        $this->assertFalse($this->validator->isValid(8, 7));
    }
    
    /**
     * Checks if the validator rejects a value that equals $other.
     */
    public function testValidatorRejectsValueThatEqualsTheComparedOne()
    {
        $this->assertFalse($this->validator->isValid(7, 7));
    }
    
    /**
     * Ensures that the validator accepts a value that is less than $other.
     */
    public function testValidatorAcceptsValueThatIsLessThanTheComparedOne()
    {
        $this->assertTrue($this->validator->isValid(7, 8));
    }
    
    /**
     * Ensures that the validator provides a failure message if the value
     * is greater than $other.
     */
    public function testValidatorProvidedMessageIfValueIsGreaterThanTheComparedOne()
    {
        $this->validator->isValid(8, 7);
        $this->assertFailureMessage();
    }
    
    /**
     * Ensures that the validator provides a failure message if the value
     * equals $other.
     */
    public function testValidatorProvidesMessageIfValueEqualsTheComparedOne()
    {
        $this->validator->isValid(7, 7);
        $this->assertFailureMessage();
    }
    
    /**
     * Asserts that the validator provides at least one failure message.
     */
    protected function assertFailureMessage()
    {
        $messages = $this->validator->getMessages();
        $this->assertInternalType('array', $messages);
        $this->assertGreaterThan(0, count($messages));
    }
    
}
