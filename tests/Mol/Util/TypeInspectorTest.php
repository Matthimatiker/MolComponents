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
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->assertInterface(new stdClass());
    }
    
    /**
     * Ensures that assertInterface() throws an exception if the provided
     * string is not a type name.
     */
    public function testAssertInterfaceThrowsExceptionIfGivenStringIsNoType()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->assertInterface('Missing');
    }
    
    /**
     * Ensures that assertInterface() throws an exception if a class name
     * is passed.
     */
    public function testAssertInterfaceThrowsExceptionIfGivenStringIsClassName()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->assertInterface('ArrayObject');
    }
    
    /**
     * Checks if assertInterface() accepts an interface name.
     */
    public function testAssertInterfaceAcceptsInterfaceName()
    {
        $this->setExpectedException(null);
        $this->inspector->assertInterface('ArrayAccess');
    }
    
    /**
     * Ensures that assertClass() throws an exception if the provided
     * "name" is not a string.
     */
    public function testAssertClassThrowsExceptionIfNoStringIsPassed()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->assertClass(new stdClass());
    }
    
    /**
     * Ensures that assertClass() throws an exception if the provided
     * string is not a type name.
     */
    public function testAssertClassThrowsExceptionIfGivenStringIsNoType()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->assertClass('Missing');
    }
    
    /**
     * Ensures that assertClass() throws an exception if an interface name
     * is provided.
     */
    public function testAssertClassThrowsExceptionIfGivenStringIsInterfaceName()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->assertClass('ArrayAccess');
    }
    
    /**
     * Checks if assertClass() accepts a class name.
     */
    public function testAssertClassAcceptsClassName()
    {
        $this->setExpectedException(null);
        $this->inspector->assertClass('ArrayObject');
    }
    
    /**
     * Ensures that assertType() throws an exception if the provided
     * "name" is not a string.
     */
    public function testAssertTypeThrowsExceptionIfNoStringIsPassed()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->assertType(new stdClass());
    }
    
    /**
     * Ensures that assertType() throws an exception if the provided
     * string is not a type name.
     */
    public function testAssertTypeThrowsExceptionIfGivenStringIsNoType()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->assertType('Missing');
    }
    
    /**
     * Checks if assertType() accepts a class name.
     */
    public function testAssertTypeAcceptsClassName()
    {
        $this->setExpectedException(null);
        $this->inspector->assertType('ArrayObject');
    }
    
    /**
     * Checks if assertType() accepts an interface name.
     */
    public function testAssertTypeAcceptsInterfaceName()
    {
        $this->setExpectedException(null);
        $this->inspector->assertType('ArrayAccess');
    }
    
    /**
     * Ensures that assertTypes() throws an exception if at least one item
     * in the list of names is not a string.
     */
    public function testAssertTypesThrowsExceptionIfAtLeastOneItemIsNoString()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->assertTypes(array('ArrayObject', new stdClass()));
    }
    
    /**
     * Ensures that assertTypes() throws an exception if at least one of the list
     * items is not a type name.
     */
    public function testAssertTypesThrowsExceptionIfAtLeastOneItemIsNoValidTypeName()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->assertTypes(array('ArrayObject', 'Missing'));
    }
    
    /**
     * Checks if assertTypes() accepts an empty array.
     */
    public function testAssertTypesAcceptsEmptyArray()
    {
        $this->setExpectedException(null);
        $this->inspector->assertTypes(array());
    }
    
    /**
     * Checks if assertTypes() accepts a list of type names.
     */
    public function testAssertTypesAcceptsListOfValidTypes()
    {
        $this->setExpectedException(null);
        $this->inspector->assertTypes(array('ArrayObject', 'ArrayAccess'));
    }
    
    /**
     * Ensures that assertFulfills() throws an exception if the provided
     * "name" is not a string.
     */
    public function testAssertFulfillsThrowsExceptionIfNoStringIsProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->assertFulfills(new stdClass(), array('ArrayAccess'));
    }
    
    /**
     * Ensures that assertFulfills() throws an exception if the provided
     * string is not a type name.
     */
    public function testAssertFulfillsThrowsExceptionIfProvidedStringIsNoType()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->assertFulfills('Missing', array('ArrayAccess'));
    }
    
    /**
     * Ensures that assertFulfills() throws an exception if at least one of the
     * given constraints is not a valid type.
     */
    public function testAssertFulfillsThrowsExceptionIfAtLeastOneOfTheConstraintsIsNoValidType()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->assertFulfills('ArrayObject', array('ArrayAccess', 'Missing'));
    }
    
    /**
     * Ensures that assertFulfills() throws an exception if at least one of the given
     * type constraints is not fulfilled.
     */
    public function testAssertFulfillsThrowsExceptionIfTypeDoesNotFulfillAtLeastOneConstraint()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->assertFulfills('ArrayObject', array('ArrayAccess', 'SplQueue'));
    }
    
    /**
     * Checks if assertFulfills() accepts a type that fulfills all given type constraints.
     */
    public function testAssertFulfillsAcceptsTypeThatFulfillsAllConstraints()
    {
        $this->setExpectedException(null);
        $this->inspector->assertFulfills('ArrayObject', array('ArrayAccess', 'Countable'));
    }
    
    /**
     * Ensures that assertFulfills() accepts a type if the constraints list
     * is empty.
     */
    public function testAssertFulfillsAcceptsTypeIfListOfConstraintsIsEmpty()
    {
        $this->setExpectedException(null);
        $this->inspector->assertFulfills('ArrayObject', array());
    }
    
}
