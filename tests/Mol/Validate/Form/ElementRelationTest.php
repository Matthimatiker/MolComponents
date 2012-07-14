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
 * @link https://github.com/Matthimatiker/MolComponents
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
 * @link https://github.com/Matthimatiker/MolComponents
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
        $this->simulateMessageList();
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
        $this->simulateMessageList();
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
        $this->simulateMessageList();
        $context = array('another' => 'value', 'name' => 'Matthias');
        $this->assertFalse($this->validator->isValid('test', $context));
    }
    
    /**
     * Ensures that isValid() returns true if the relation validator accepts the
     * compare values.
     */
    public function testValidatorAcceptsInputIfRelationValidatorDoesNotRejectValues()
    {
        $this->simulateSuccessfulRelationValidation();
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
        $this->simulateMessageList(array('my' => 'message'));
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
        $this->simulateMessageList(array('my' => 'message with [%compareLabel%]'));
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
        $this->simulateSuccessfulRelationValidation();
        $context = array('another' => 'value', 'name' => 'Matthias');
        $this->validator->isValid('test', $context);
        $this->assertEquals('test', $this->validator->value);
    }
    
    /**
     * Checks if the label of the compared element is available as property.
     */
    public function testLabelOfComparedElementIsAccessibleAsProperty()
    {
        $this->simulateSuccessfulRelationValidation();
        $context = array('another' => 'value', 'name' => 'Matthias');
        $this->validator->isValid('test', $context);
        $this->assertEquals('Your name', $this->validator->compareLabel);
    }
    
    /**
     * Checks if the compared value is available as property.
     */
    public function testComparedValueIsAccessibleAsProperty()
    {
        $this->simulateSuccessfulRelationValidation();
        $context = array('another' => 'value', 'name' => 'Matthias');
        $this->validator->isValid('test', $context);
        $this->assertEquals('Matthias', $this->validator->compareValue);
    }
    
    /**
     * Checks if the name of the compared element is available as property.
     */
    public function testNameOfComparedElementIsAccessibleAsProperty()
    {
        $this->simulateSuccessfulRelationValidation();
        $context = array('another' => 'value', 'name' => 'Matthias');
        $this->validator->isValid('test', $context);
        $this->assertEquals('name', $this->validator->compareName);
    }
    
    /**
     * Ensures that the compared value is obscured if configured.
     */
    public function testComparedValueIsObscuredIfRequired()
    {
        $this->relationValidator->expects($this->any())
                                ->method('isValid')
                                ->will($this->returnValue(false));
        $this->simulateMessageList(array('message' => 'compared to %compareValue%'));
        $this->validator->setObscureValue(true);
        $context = array('another' => 'value', 'name' => 'Matthias');
        $this->validator->isValid('test', $context);
        $messages = $this->validator->getMessages();
        $this->assertInternalType('array', $messages);
        $this->assertEquals(1, count($messages));
        $message = current($messages);
        $this->assertNotContains('%compareValue%', $message);
        $this->assertNotContains('Matthias', $message);
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
     * Checks if the constructor accepts the identifier for the Equal relation
     */
    public function testConstructorAcceptsEqualRelationIdentifier()
    {
        $this->setExpectedException(null);
        new Mol_Validate_Form_ElementRelation('==', $this->element);
    }
    
    /**
     * Checks if the constructor accepts the identifier for the NotEqual relation
     */
    public function testConstructorAcceptsNotEqualRelationIdentifier()
    {
        $this->setExpectedException(null);
        new Mol_Validate_Form_ElementRelation('!=', $this->element);
    }
    
    /**
     * Checks if the constructor accepts the identifier for the GreaterThan relation
     */
    public function testConstructorAcceptsGreaterThanRelationIdentifier()
    {
        $this->setExpectedException(null);
        new Mol_Validate_Form_ElementRelation('>', $this->element);
    }
    
    /**
     * Checks if the constructor accepts the identifier for the LessThan relation
     */
    public function testConstructorAcceptsLessThanRelationIdentifier()
    {
        $this->setExpectedException(null);
        new Mol_Validate_Form_ElementRelation('<', $this->element);
    }
    
    /**
     * Checks if the constructor accepts the identifier for the GreaterThanOrEqual relation
     */
    public function testConstructorAcceptsGreaterThanOrEqualRelationIdentifier()
    {
        $this->setExpectedException(null);
        new Mol_Validate_Form_ElementRelation('>=', $this->element);
    }
    
    /**
     * Checks if the constructor accepts the identifier for the LessThanOrEqual relation
     */
    public function testConstructorAcceptsLessThanOrEqualRelationIdentifier()
    {
        $this->setExpectedException(null);
        new Mol_Validate_Form_ElementRelation('<=', $this->element);
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
    
    /**
     * Simulates a successful relation validation.
     */
    protected function simulateSuccessfulRelationValidation()
    {
        $this->relationValidator->expects($this->any())
                                ->method('isValid')
                                ->will($this->returnValue(true));
        $this->simulateMessageList();
    }
    
    /**
     * Simulates the provided list of relation validation messages.
     *
     * @param array(string=>string) $messages
     */
    protected function simulateMessageList(array $messages = array())
    {
        $this->relationValidator->expects($this->any())
                                ->method('getMessages')
                                ->will($this->returnValue($messages));
    }
    
}