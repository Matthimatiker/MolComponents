<?php

/**
 * Mol_Validate_Form_ElementRelationTest
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 23.06.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the ElementComparison validator.
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 23.06.2012
 */
class Mol_Validate_Form_ElementRelationTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Validate_Form_ElementRelation
     */
    protected $validator = null;
    
    /**
     * The mocked relation validator.
     *
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    protected $relationValidator = null;
    
    /**
     * The element whose value is compared.
     *
     * @var Zend_Form_Element_Text
     */
    protected $element = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->relationValidator = $this->createRelationValidator();
        $this->element = new Zend_Form_Element_Text('name');
        $this->element->setLabel('Your name');
        $this->validator = new Mol_Validate_Form_ElementRelation($this->relationValidator, $this->element);
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->validator         = null;
        $this->element           = null;
        $this->relationValidator = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that isValid() returns false if no context is provided.
     */
    public function testIsValidReturnsFalseIfNoContextIsProvided()
    {
        $this->assertFalse($this->validator->isValid('test'));
    }
    
    /**
     * Checks if the validator provides a failure message if no context
     * was available during validation.
     */
    public function testValidatorProvidesMessageIfNoContextIsProvided()
    {
        $this->validator->isValid('test');
        $messages = $this->validator->getMessages();
        $this->assertInternalType('array', $messages);
        $this->assertGreaterThan(0, count($messages));
    }
    
    /**
     * Ensures that isValid() returns false if no valid context is provided.
     */
    public function testIsValidReturnsFalseIfContextIsNotAnArray()
    {
        $this->assertFalse($this->validator->isValid('test', new stdClass()));
    }
    
    /**
     * Checks if the validator provides a failure message if no valid context
     * was passed to isValid().
     */
    public function testValidatorProvidesMessageIfContextIsNotAnArray()
    {
        $this->validator->isValid('test', new stdClass());
        $messages = $this->validator->getMessages();
        $this->assertInternalType('array', $messages);
        $this->assertGreaterThan(0, count($messages));
    }
    
    /**
     * Ensures that isValid() returns false if the context does not contain
     * the compared value.
     */
    public function testIsValidReturnsFalseIfComparedValueIsMissing()
    {
        $context = array('another' => 'value');
        $this->assertFalse($this->validator->isValid('test', $context));
    }
    
    /**
     * Checks if the validator provides a failure message if the context that
     * was passed to isValid() did not contain the compared value.
     */
    public function testValidatorProvidesMessageIfComparedValueIsMissing()
    {
        $context = array('another' => 'value');
        $this->validator->isValid('test', $context);
        $messages = $this->validator->getMessages();
        $this->assertInternalType('array', $messages);
        $this->assertGreaterThan(0, count($messages));
    }
    
    /**
     * Checks if the validated value is passed to the relation validator.
     */
    public function testValidatedValueIsPassedToRelationValidator()
    {
        $this->relationValidator->expects($this->once())
                                ->method('isValid')
                                ->with('test')
                                ->will($this->returnValue(false));
        $context = array('another' => 'value', 'name' => 'Matthias');
        $this->validator->isValid('test', $context);
    }
    
    /**
     * Checks if the compared value is passed to the relationb validator.
     */
    public function testCompareValueIsPassedToRelationValidator()
    {
        $this->relationValidator->expects($this->once())
                                ->method('isValid')
                                ->with(new PHPUnit_Framework_Constraint_IsAnything(), 'Matthias')
                                ->will($this->returnValue(false));
        $context = array('another' => 'value', 'name' => 'Matthias');
        $this->validator->isValid('test', $context);
    }
    
    /**
     * Ensures that isValid() returns false if the relation validator rejects
     * the compared values.
     */
    public function testValidatorRejectsInputIfRelationValidatorDoesNotAcceptValues()
    {
        $this->relationValidator->expects($this->any())
                                ->method('isValid')
                                ->will($this->returnValue(false));
        $this->relationValidator->expects($this->any())
                                ->method('getMessages')
                                ->will($this->returnValue(array()));
        $context = array('another' => 'value', 'name' => 'Matthias');
        $this->assertFalse($this->validator->isValid('test', $context));
    }
    
    /**
     * Ensures that isValid() returns true if the relation validator accepts the
     * compare values.
     */
    public function testValidatorAcceptsInputIfRelationValidatorDoesNotRejectValues()
    {
        $this->relationValidator->expects($this->any())
                                ->method('isValid')
                                ->will($this->returnValue(true));
        $this->relationValidator->expects($this->any())
                                ->method('getMessages')
                                ->will($this->returnValue(array()));
        $context = array('another' => 'value', 'name' => 'Matthias');
        $this->assertTrue($this->validator->isValid('Matthias', $context));
    }
    
    /**
     * Ensures that getMessages() returns the messages that are provided by the
     * relation validator.
     */
    public function testGetMessagesReturnsMessagesProvidedByRelationValidator()
    {
        $this->relationValidator->expects($this->any())
                                ->method('isValid')
                                ->will($this->returnValue(false));
        $this->relationValidator->expects($this->any())
                                ->method('getMessages')
                                ->will($this->returnValue(array('my' => 'message')));
        $context = array('another' => 'value', 'name' => 'Matthias');
        $this->validator->isValid('test', $context);
        $messages = $this->validator->getMessages();
        $this->assertInternalType('array', $messages);
        $this->assertArrayHasKey('my', $messages);
        $this->assertEquals($messages['my'], 'message');
    }
    
    /**
     * Ensures that the validator injects properties into the message of the relation validator
     * if it contains placeholders.
     */
    public function testValidatorInjectsPropertiesIntoMessagesThatAreProvidedByTheRelationValidator()
    {
        $this->relationValidator->expects($this->any())
                                ->method('isValid')
                                ->will($this->returnValue(false));
        $this->relationValidator->expects($this->any())
                                ->method('getMessages')
                                ->will($this->returnValue(array('my' => 'message with [%label%]')));
        $context = array('another' => 'value', 'name' => 'Matthias');
        $this->validator->isValid('test', $context);
        $messages = $this->validator->getMessages();
        $this->assertInternalType('array', $messages);
        $this->assertArrayHasKey('my', $messages);
        $this->assertContains('[Your name]', $messages['my']);
    }
    
    /**
     * Checks if the validated value is available as property.
     */
    public function testValidatedValueIsAccessibleAsProperty()
    {
        $context = array('another' => 'value', 'name' => 'Matthias');
        $this->validator->isValid('test', $context);
        $this->assertEquals('test', $this->validator->value);
    }
    
    /**
     * Checks if the label of the compared element is available as property.
     */
    public function testLabelOfComparedElementIsAccessibleAsProperty()
    {
        $context = array('another' => 'value', 'name' => 'Matthias');
        $this->validator->isValid('test', $context);
        $this->assertEquals('Your name', $this->validator->label);
    }
    
    /**
     * Checks if the compared value is available as property.
     */
    public function testComparedValueIsAccessibleAsProperty()
    {
        $context = array('another' => 'value', 'name' => 'Matthias');
        $this->validator->isValid('test', $context);
        $this->assertEquals('Matthias', $this->validator->comparedValue);
    }
    
    /**
     * Ensures that the constructor throws an exception if an invalid relation identifier
     * is provided.
     */
    public function testConstructorThrowsExceptionIfInvalidRelationIdentifierIsProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        new Mol_Validate_Form_ElementRelation('buhuhu', $this->element);
    }
    
    /**
     * Ensures that the constructor throws an exception if an invalid relation object
     * is provided.
     *
     * Valid relation object must at least implement Zend_Validate_Interface.
     */
    public function testConstructorThrowsExceptionIfInvalidRelationObjectIsProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        new Mol_Validate_Form_ElementRelation(new stdClass(), $this->element);
    }
    
    /**
     * Creates a mocked relation validator.
     *
     * @return  PHPUnit_Framework_MockObject_MockObject
     */
    protected function createRelationValidator()
    {
        return $this->getMock('Zend_Validate_Interface');
    }
    
}