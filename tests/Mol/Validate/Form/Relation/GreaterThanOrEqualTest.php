<?php

/**
 * Mol_Validate_Form_Relation_GreaterThanOrEqualTest
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 28.06.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the GreaterThanOrEqual relation.
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 28.06.2012
 */
class Mol_Validate_Form_Relation_GreaterThanOrEqualTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Validate_Form_Relation_GreaterThanOrEqual
     */
    protected $validator = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->validator = new Mol_Validate_Form_Relation_GreaterThanOrEqual();
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
     * Ensures that the validator rejects values that are less than $other.
     */
    public function testValidatorRejectsValueThatIsLessThanTheComparedOne()
    {
        $this->assertFalse($this->validator->isValid(41, 42));
    }
    
    /**
     * Checks if the validator accepts a value that equals $other.
     */
    public function testValidatorAcceptsValuesThatEqualsTheComparedOne()
    {
        $this->assertTrue($this->validator->isValid(42, 42));
    }
    
    /**
     * Ensures that the validator accepts a value that is greater than $other.
     */
    public function testValidatorAcceptsValueThatIsGreaterThanTheComparedOne()
    {
        $this->assertTrue($this->validator->isValid(43, 42));
    }
    
    /**
     * Ensures that the validator provides a failure message if the checked
     * value is less than $other.
     */
    public function testValidatorProvidesMessageIfValueIsLessThanTheComparedOne()
    {
        $this->validator->isValid(41, 42);
        $messages = $this->validator->getMessages();
        $this->assertInternalType('array', $messages);
        $this->assertGreaterThan(0, count($messages));
    }
    
}
