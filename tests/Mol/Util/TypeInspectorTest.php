<?php

/**
 * Mol_Util_TypeInspectorTest
 *
 * @category PHP
 * @package Mol_Util
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/Mol_Components
 * @since 13.11.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the type inspector.
 *
 * @category PHP
 * @package Mol_Util
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/Mol_Components
 * @since 13.11.2012
 */
class Mol_Util_TypeInspectorTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Util_TypeInspector
     */
    protected $inspector = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->inspector = new Mol_Util_TypeInspector();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->inspector = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that isClass() throws an exception if the given argument
     * is not a string.
     */
    public function testIsClassThrowsExceptionIfNoStringIsProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->isClass(new stdClass());
    }
    
    /**
     * Ensures that isClass() returns false if the given string
     * is not even a type name.
     */
    public function testIsClassReturnsFalseIfGivenValueIsNoType()
    {
        $this->assertFalse($this->inspector->isClass('Missing'));
    }
    
    /**
     * Ensures that isClass() returns false if the given value is an
     * interface name.
     */
    public function testIsClassReturnsFalseIfGivenValueIsAnInterfaceName()
    {
        $this->assertFalse($this->inspector->isClass('ArrayAccess'));
    }
    
    /**
     * Ensures that isClass() returns true if a class name is provided.
     */
    public function testIsClassReturnsTrueIfGivenValueIsClassName()
    {
        $this->assertTrue($this->inspector->isClass('ArrayObject'));
    }
    
    /**
     * Ensures that isInterface() throws an exception if the given argument
     * is not a string.
     */
    public function testIsInterfaceThrowsExceptionIfNoStringIsProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->isInterface(new stdClass());
    }
    
    /**
     * Ensures that isInterface() returns false if the given string
     * is not even a type name.
     */
    public function testIsInterfaceReturnsFalseIfGivenValueIsNoType()
    {
        $this->assertFalse($this->inspector->isInterface('Missing'));
    }
    
    /**
     * Ensures that isInterface() returns false if the given value is a
     * class name.
     */
    public function testIsInterfaceReturnsFalseIfGivenValueIsClassName()
    {
        $this->assertFalse($this->inspector->isInterface('ArrayObject'));
    }
    
    /**
     * Ensures that isInterface() returns true if an interface name is provided.
     */
    public function testIsInterfaceReturnsTrueIfGivenValueIsAnInterfaceName()
    {
        $this->assertTrue($this->inspector->isInterface('ArrayAccess'));
    }
    
    /**
     * Ensures that isType() throws an exception if the given argument
     * is not a string.
     */
    public function testIsTypeThrowsExceptionIfGivenValueIsNoString()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->isType(new stdClass());
    }
    
    /**
     * Ensures that isType() returns false if the given string
     * is not a type name.
     */
    public function testIsTypeReturnsFalseIfGivenValueIsNoTypeName()
    {
        $this->assertFalse($this->inspector->isType('Missing'));
    }
    
    /**
     * Checks if isType() accepts an interface name.
     */
    public function testIsTypeReturnsTrueIfGivenValueIsAnInterfaceName()
    {
        $this->assertTrue($this->inspector->isType('ArrayAccess'));
    }
    
    /**
     * Checks if isType() accepts a class name.
     */
    public function testIsTypeReturnsTrueIfGivenValueIsClassName()
    {
        $this->assertTrue($this->inspector->isType('ArrayObject'));
    }
    
    /**
     * Ensures that is() throws an exception if the provided constraint
     * is not a type name.
     */
    public function testIsThrowsExceptionIfProvidedConstraintIsNoType()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->is('stdClass', 'Missing');
    }
    
    /**
     * Ensures that is() throws an exception if a constraint list is provided and
     * at least one of the constraints is not a type name.
     */
    public function testIsThrowsExceptionIfAtLeastOneOfTheProvidedConstraintsIsNoType()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->is('stdClass', array('ArrayAccess', 'Missing'));
    }
    
    /**
     * Ensures that the exception is thrown even if the given constraint list
     * contains arrays.
     *
     * Depending on the handling of the constraint list, Array to String conversion
     * notices may occur in PHP 5.4. These warnings will be converted to exceptions
     * by PHPUnit, which are of course not of the expected InvalidArgumentException
     * type.
     */
    public function testIsThrowsCorrectExceptionIfConstraintListContainsArrays()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->is('stdClass', array(array('An array instead of a type.')));
    }
    
    /**
     * Ensures that is() throws an exception if the provided name
     * is not a string.
     */
    public function testIsThrowsExceptionIfProvidedValueIsNoString()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->is(new stdClass(), 'ArrayObject');
    }
    
    /**
     * Ensures that is() returns an boolean if the given constraint
     * is a type name.
     */
    public function testIsReturnsBooleanIfProvidedConstraintIsType()
    {
        $this->assertInternalType('boolean', $this->inspector->is('stdClass', 'ArrayObject'));
    }
    
    /**
     * Ensures that is() returns a boolean if the given constraint list contains
     * only valid type names.
     */
    public function testIsReturnsBooleanIfConstraintListContainsOnlyValidTypes()
    {
        $this->assertInternalType('boolean', $this->inspector->is('stdClass', array('ArrayObject', 'ArrayAccess')));
    }
    
    /**
     * Ensures that is() returns false if the provided name is not
     * a real class or interface.
     */
    public function testIsReturnsFalseIfProvidedNameIsNoType()
    {
        $this->assertFalse($this->inspector->is('Missing', 'stdClass'));
    }
    
    /**
     * Ensures that is() returns true if the given list of constraints
     * is empty.
     */
    public function testIsReturnsTrueIfConstraintListIsEmpty()
    {
        $this->assertTrue($this->inspector->is('stdClass', array()));
    }
    
    /**
     * Ensures that is() throws an exception if no valid name is passed,
     * even if the given constraint list is empty.
     */
    public function testIsThrowsExceptionIfNoNameIsProvidedEvenIfTypeListIsEmpty()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->is(new stdClass(), array());
    }
    
    /**
     * Ensures that is() returns false if the given value does not fulfill
     * the type constraint.
     */
    public function testIsReturnsFalseIfValueDoesNotFulfillTypeConstraint()
    {
        $this->assertFalse($this->inspector->is('stdClass', 'ArrayObject'));
    }
    
    /**
     * Ensures that is() returns false if the given value does not fulfill
     * all constraints in the given type list.
     */
    public function testIsReturnsFalseIfValueDoesNotFulfillAllGivenConstraints()
    {
        $this->assertFalse($this->inspector->is('stdClass', array('stdClass', 'ArrayAccess')));
    }
    
    /**
     * Ensures that is() returns true if the given class name equals
     * the given constraint exactly.
     */
    public function testIsReturnsTrueIfClassNameIsExactlyOfRequestedType()
    {
        $this->assertTrue($this->inspector->is('stdClass', 'stdClass'));
    }
    
    /**
     * Ensures that is() returns true if the given interface name equals
     * the given constraint exactly.
     */
    public function testIsReturnsTrueIfInterfaceNameIsExactlyOfRequestedType()
    {
        $this->assertTrue($this->inspector->is('IteratorAggregate', 'IteratorAggregate'));
    }
    
    /**
     * Ensures that is() returns true if the given class name is a
     * subclass of the requested type.
     */
    public function testIsReturnsTrueIfValueIsSubclassOfRequestedType()
    {
        $this->assertTrue($this->inspector->is('FilterIterator', 'IteratorIterator'));
    }
    
    /**
     * Ensures that is() returns true if the given class implements the
     * requested interface type.
     */
    public function testIsReturnsTrueIfValueImplementsRequestedInterfaceType()
    {
        $this->assertTrue($this->inspector->is('ArrayIterator', 'Iterator'));
    }
    
    /**
     * Ensures that is() returns true if an interface is provided which extends
     * the requested interface type.
     */
    public function testIsReturnsTrueIfValueIsAnInterfaceThatExtendsTheRequestedInterfaceType()
    {
        $this->assertTrue($this->inspector->is('Iterator', 'Traversable'));
    }
    
    /**
     * Ensures that is() returns true if the value fulfills all type constraints
     * in the provided constraint list.
     */
    public function testIsReturnsTrueIfValueFulfillsAllGivenTypeConstraints()
    {
        $this->assertTrue($this->inspector->is('ArrayObject', array('ArrayAccess', 'Countable')));
    }
    
    /**
     * Ensures that assertInterface() throws an exception if the provided
     * "name" is not a string.
     */
    public function testAssertInterfaceThrowsExceptionIfNoStringIsPassed()
    {
        
    }
    
    public function testAssertInterfaceThrowsExceptionIfGivenStringIsNoType()
    {
        
    }
    
    public function testAssertInterfaceThrowsExceptionIfGivenStringIsClassName()
    {
    
    }
    
    public function testAssertInterfaceAcceptsInterfaceName()
    {
        
    }
    
    /**
     * Ensures that assertClass() throws an exception if the provided
     * "name" is not a string.
     */
    public function testAssertClassThrowsExceptionIfNoStringIsPassed()
    {
    
    }
    
    public function testAssertClassThrowsExceptionIfGivenStringIsNoType()
    {
    
    }
    
    public function testAssertClassThrowsExceptionIfGivenStringIsInterfaceName()
    {
    
    }
    
    public function testAssertClassAcceptsClassName()
    {
    
    }
    
    /**
     * Ensures that assertType() throws an exception if the provided
     * "name" is not a string.
     */
    public function testAssertTypeThrowsExceptionIfNoStringIsPassed()
    {
    
    }
    
    public function testAssertTypeThrowsExceptionIfGivenStringIsNoType()
    {
    
    }
    
    public function testAssertTypeAcceptsClassName()
    {
    
    }
    
    public function testAssertTypeAcceptsInterfaceName()
    {
    
    }
    
    /**
     * Ensures that assertTypes() throws an exception if at least one item
     * in the list of names is not a string.
     */
    public function testAssertTypesThrowsExceptionIfAtLeastOneItemIsNoString()
    {
        
    }
    
    public function testAssertTypesThrowsExceptionIfAtLeastOneItemIsNoValidTypeName()
    {
        
    }
    
    public function testAssertTypesAcceptsEmptyArray()
    {
        
    }
    
    public function testAssertTypesAcceptsListOfValidTypes()
    {
        
    }
    
    /**
     * Ensures that assertFulfillsConstraints() throws an exception if the provided
     * "name" is not a string.
     */
    public function testAssertFulfillsConstraintsThrowsExceptionIfNoStringIsProvided()
    {
        
    }
    
    public function testAssertFulfillsConstraintsThrowsExceptionIfAtLeastOneOfTheConstraintsIsNoValidType()
    {
        
    }
    
    public function testAssertFulfillsConstraintsThrowsExceptionIfTypeDoesNotFulfillAtLeastOneConstraint()
    {
        
    }
    
    public function testAssertFulfillsConstraintsAcceptsTypeThatFulfillsAllConstraints()
    {
        
    }
    
    public function testAssertFulfillsConstraintsAcceptsTypeIfListOfConstraintsIsEmpty()
    {
    
    }
    
}
