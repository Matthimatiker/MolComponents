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
    
    public function testConstructorThrowsExceptionIfProvidedConstraintIsNeitherClassNorInterface()
    {
        
    }
    
    public function testCreateThrowsExceptionIfClassDoesNotFulfillParentClassConstraint()
    {
        
    }
    
    public function testCreateThrowsExceptionIfClassDoesNotFulfillInterfaceConstraint()
    {
    
    }
    
    public function testCreateInstantiatesClassThatMeetsParentClassConstraint()
    {
        
    }
    
    public function testCreateInstantiatesClassThatMeetsInterfaceConstraint()
    {
    
    }
    
    public function testCreateInstantiatesClassIfNoConstraintIsActive()
    {
        
    }
    
    public function testCreateThrowsExceptionIfRequiredConstructorArgumentsAreNotProvided()
    {
        
    }
    
    public function testCreateInstantiatesClassIfOptionalConstructorArgumentsAreOmitted()
    {
        
    }
    
    public function testCreatePassesConstructorArguments()
    {
        
    }
    
}
