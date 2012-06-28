<?php

/**
 * Mol_Validate_Form_Relation_LessThanOrEqualTest
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
 * Tests the LessThanOrEqual relation.
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
class Mol_Validate_Form_Relation_LessThanOrEqualTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Validate_Form_Relation_LessThanOrEqual
     */
    protected $validator = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->validator = new Mol_Validate_Form_Relation_LessThanOrEqual();
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
     * Checks if the validator accepts values that are less than $other.
     */
    public function testValidatorAcceptsValueThatIsLessThanTheComparedOne()
    {
        $this->assertTrue($this->validator->isValid(7, 8));
    }
    
    /**
     * Ensures that the validator accepts values that are equal to $other.
     */
    public function testValidatorAcceptsValueThatEqualsTheComparedOne()
    {
        $this->assertTrue($this->validator->isValid(7, 7));
    }
    
    /**
     * Ensures that the validator rejects values that are greater than $other.
     */
    public function testValidatorRejectsValueThatIsGreaterThanTheComparedOne()
    {
        $this->assertFalse($this->validator->isValid(7, 6));
    }
    
    /**
     * Ensures that the validator provides a failure message if the checked value
     * is greater than $other.
     */
    public function testValidatorProvidesMessageIfValueIsGreaterThanTheComparedOne()
    {
        $this->validator->isValid(7, 6);
        $messages = $this->validator->getMessages();
        $this->assertInternalType('array', $messages);
        $this->assertGreaterThan(0, count($messages));
    }
    
}
