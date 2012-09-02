<?php

/**
 * Mol_Util_ObjectBuilderTest
 *
 * @category PHP
 * @package Mol_Util
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 02.09.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the object builder.
 *
 * @category PHP
 * @package Mol_Util
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 02.09.2012
 */
class Mol_Util_ObjectBuilderTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Ensures that the constructor throws an exception if an invalid type constraint
     * is passed.
     */
    public function testConstructorThrowsExceptionIfProvidedConstraintIsNeitherClassNorInterface()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->builder('Missing');
    }
    
    /**
     * Ensures that create() throws an exception if the provided argument is not
     * a class name.
     */
    public function testCreateThrowsExceptionIfProvidedArgumentIsNoValidClassName()
    {
        
    }
    
    /**
     * Ensures that create() throws an exception if the provided argument is the
     * name of an interface, but not a class name.
     */
    public function testCreateThrowsExceptionIfInterfaceNameIsProvidedAsArgument()
    {
        
    }
    
    /**
     * Ensures that create() throws an exception if the requested class does not meet
     * the parent class requirement.
     */
    public function testCreateThrowsExceptionIfClassDoesNotFulfillParentClassConstraint()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->builder('Exception')->create('stdClass');
    }
    
    /**
     * Ensures that create() throws an exception if the requested class does not meet
     * the interface requirement.
     */
    public function testCreateThrowsExceptionIfClassDoesNotFulfillInterfaceConstraint()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->builder('Countable')->create('stdClass');
    }
    
    /**
     * Ensures that create() instantiates the requested class if no constraints
     * were provided.
     */
    public function testCreateInstantiatesClassThatMeetsParentClassConstraint()
    {
        $object = $this->builder('Exception')->create('LogicException');
        $this->assertInstanceOf('LogicException', $object);
    }
    
    /**
     * Ensures that create() instantiates the requested class if it equals the
     * class that was provided as constraint.
     */
    public function testCreateInstantiatesClassThatEqualsParentClassConstraint()
    {
        $object = $this->builder('Exception')->create('Exception');
        $this->assertInstanceOf('Exception', $object);
    }
    
    /**
     * Ensures that create() instantiates the requested class if it meets the
     * parent class constraint.
     */
    public function testCreateInstantiatesClassThatMeetsInterfaceConstraint()
    {
        $object = $this->builder('Countable')->create('ArrayObject');
        $this->assertInstanceOf('ArrayObject', $object);
    }
    
    /**
     * Ensures that create() instantiates the requested class if it meets the
     * interface constraint.
     */
    public function testCreateInstantiatesClassIfNoConstraintIsActive()
    {
        $object = $this->builder()->create('stdClass');
        $this->assertInstanceOf('stdClass', $object);
    }
    
    /**
     * Ensures that an exception is thrown if a constructor argument is required, but
     * not passed to create().
     */
    public function testCreateThrowsExceptionIfRequiredConstructorArgumentsAreNotProvided()
    {
        $this->setExpectedException('BadMethodCallException');
        $this->builder()->create('DateTimeZone');
    }
    
    /**
     * Ensures that create() instantiates the class if a constructor argument is optional
     * and therefore not provided.
     */
    public function testCreateInstantiatesClassIfOptionalConstructorArgumentsAreOmitted()
    {
        $iterator = new ArrayIterator(array());
        $object   = $this->builder()->create('CachingIterator ', array($iterator));
        $this->assertInstanceOf('CachingIterator', $object);
    }
    
    /**
     * Ensures that create() instantiates the class if all constructor arguments are provided.
     */
    public function testCreateInstantiatesClassIfAllConstructorArgumentsAreProvided()
    {
        $iterator = new ArrayIterator(array());
        $object   = $this->builder()->create('CachingIterator ', array($iterator, CachingIterator::CALL_TOSTRING));
        $this->assertInstanceOf('CachingIterator', $object);
    }
    
    /**
     * Checks if create() passes the provided constructor arguments to the created class.
     */
    public function testCreatePassesConstructorArguments()
    {
        /* @var $object ArrayObject */
        $values = array(1, 2, 3);
        $object = $this->builder()->create('ArrayObject', array($values));
        $this->assertInstanceOf('ArrayObject', $object);
        $this->assertEquals($values, $object->getArrayCopy());
    }
    
    /**
     * Creates an object builder with the provided type constraint.
     *
     * @param string|null $constraint
     * @return Mol_Util_ObjectBuilder
     */
    public function builder($constraint = null)
    {
        return new Mol_Util_ObjectBuilder($constraint);
    }
    
}
