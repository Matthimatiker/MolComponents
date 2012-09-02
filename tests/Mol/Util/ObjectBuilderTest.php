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
        
    }
    
    /**
     * Ensures that create() throws an exception if the requested class does not meet
     * the parent class requirement.
     */
    public function testCreateThrowsExceptionIfClassDoesNotFulfillParentClassConstraint()
    {
        
    }
    
    /**
     * Ensures that create() throws an exception if the requested class does not meet
     * the interface requirement.
     */
    public function testCreateThrowsExceptionIfClassDoesNotFulfillInterfaceConstraint()
    {
    
    }
    
    /**
     * Ensures that create() instantiates the requested class if no constraints
     * were provided.
     */
    public function testCreateInstantiatesClassThatMeetsParentClassConstraint()
    {
        
    }
    
    /**
     * Ensures that create() instantiates the requested class if it meets the
     * parent class constraint.
     */
    public function testCreateInstantiatesClassThatMeetsInterfaceConstraint()
    {
    
    }
    
    /**
     * Ensures that create() instantiates the requested class if it meets the
     * interface constraint.
     */
    public function testCreateInstantiatesClassIfNoConstraintIsActive()
    {
        
    }
    
    /**
     * Ensures that an exception is thrown if a constructor argument is required, but
     * not passed to create().
     */
    public function testCreateThrowsExceptionIfRequiredConstructorArgumentsAreNotProvided()
    {
        
    }
    
    /**
     * Ensures that create() instantiates the class if a constructor argument is optional
     * and therefore not provided.
     */
    public function testCreateInstantiatesClassIfOptionalConstructorArgumentsAreOmitted()
    {
        
    }
    
    /**
     * Checks if create() passes the provided constructor arguments to the created class.
     */
    public function testCreatePassesConstructorArguments()
    {
        
    }
    
    /**
     * Creates an object builder with the provided type constraint.
     *
     * @param string|null $constraint
     * @return Mol_Util_ObjectBuilder
     */
    public function builder($constraint = null)
    {
        
    }
    
}
