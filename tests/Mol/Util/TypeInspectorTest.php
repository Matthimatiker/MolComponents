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
        
    }
    
    /**
     * Ensures that isClass() returns false if the given value is an
     * interface name.
     */
    public function testIsClassReturnsFalseIfGivenValueIsAnInterfaceName()
    {
        
    }
    
    /**
     * Ensures that isClass() returns true if a class name is provided.
     */
    public function testIsClassReturnsTrueIfGivenValueIsClassName()
    {
        
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
    
    }
    
    /**
     * Ensures that isInterface() returns false if the given value is a
     * class name.
     */
    public function testIsInterfaceReturnsFalseIfGivenValueIsClassName()
    {
    
    }
    
    /**
     * Ensures that isInterface() returns true if an interface name is provided.
     */
    public function testIsInterfaceReturnsTrueIfGivenValueIsAnInterfaceName()
    {
    
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
        
    }
    
    /**
     * Checks if isType() accepts an interface name.
     */
    public function testIsTypeReturnsTrueIfGivenValueIsAnInterfaceName()
    {
        
    }
    
    /**
     * Checks if isType() accepts a class name.
     */
    public function testIsTypeReturnsTrueIfGivenValueIsClassName()
    {
        
    }
    
    /**
     * Ensures that is() throws an exception if the provided constraint
     * is not a type name.
     */
    public function testIsThrowsExceptionIfProvidedConstraintIsNoType()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->is('AnyName', 'Missing');
    }
    
    /**
     * Ensures that is() throws an exception if a constraint list is provided and
     * at least one of the constraints is not a type name.
     */
    public function testIsThrowsExceptionIfAtLeastOneOfTheProvidedConstraintsIsNoType()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->inspector->is('AnyName', array('ArrayAccess', 'Missing'));
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
        
    }
    
    /**
     * Ensures that is() returns a boolean if the given constraint list contains
     * only valid type names.
     */
    public function testIsReturnsBooleanIfConstraintListContainsOnlyValidTypes()
    {
        
    }
    
    /**
     * Ensures that is() returns true if the given list of constraints
     * is empty.
     */
    public function testIsReturnsTrueIfConstraintListIsEmpty()
    {
        
    }
    
    /**
     * Ensures that is() returns false if the given value does not fulfill
     * the type constraint.
     */
    public function testIsReturnsFalseIfValueDoesNotFulfillTypeConstraint()
    {
        
    }
    
    /**
     * Ensures that is() returns false if the given value does not fulfill
     * all constraints in the given type list.
     */
    public function testIsReturnsFalseIfValueDoesNotFulfillAllGivenConstraints()
    {
        
    }
    
    /**
     * Ensures that is() returns true if the value fulfills all type constraints
     * in the provided constraint list.
     */
    public function testIsReturnsTrueIfValueFulfillsAllGivenTypeConstraints()
    {
        
    }
    
    /**
     * Ensures that is() returns true if the given class name equals
     * the given constraint exactly.
     */
    public function testIsReturnsTrueIfClassNameIsExactlyOfRequestedType()
    {
        
    }
    
    /**
     * Ensures that is() returns true if the given interface name equals
     * the given constraint exactly.
     */
    public function testIsReturnsTrueIfInterfaceNameIsExactlyOfRequestedType()
    {
    
    }
    
    /**
     * Ensures that is() returns true if the given class name is a
     * subclass of the requested type.
     */
    public function testIsReturnsTrueIfValueIsSubclassOfRequestedType()
    {
    
    }
    
    /**
     * Ensures that is() returns true if the given class implements the
     * requested interface type.
     */
    public function testIsReturnsTrueIfValueImplementsRequestedInterfaceType()
    {
        
    }
    
    /**
     * Ensures that is() returns true if an interface is provided which extends
     * the requested interface type.
     */
    public function testIsReturnsTrueIfValueIsAnInterfaceThatExtendsTheRequestedInterfaceType()
    {
        
    }
    
}
