<?php

/**
 * Mol_Validate_Form_Relation_NotEqualTest
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
 * Tests the NotEqual relation validator.
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
class Mol_Validate_Form_Relation_NotEqualTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Validate_Form_Relation_NotEqual
     */
    protected $validator = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->validator = new Mol_Validate_Form_Relation_NotEqual();
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
     * Checks if the validator accepts values that differ.
     */
    public function testValidatorAcceptsValuesThatDiffer()
    {
        $this->assertTrue($this->validator->isValid(7, 42));
    }
    
    /**
     * Ensures that the validator rejects values that are equal.
     */
    public function testValidatorRejectsEqualValues()
    {
        $this->assertFalse($this->validator->isValid(42, 42));
    }
    
    /**
     * Ensures that the validator provides a failure message if the
     * values are equal.
     */
    public function testValidatorProvidesFailureMessageIfValuesAreEqual()
    {
        $this->validator->isValid(42, 42);
        $messages = $this->validator->getMessages();
        $this->assertInternalType('array', $messages);
        $this->assertGreaterThan(0, count($messages));
    }
    
}
