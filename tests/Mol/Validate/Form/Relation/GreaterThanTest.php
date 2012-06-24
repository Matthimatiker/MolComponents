<?php

/**
 * Mol_Validate_Form_Relation_GreaterThanTest
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 24.06.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the GreaterThan relation validator.
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 24.06.2012
 */
class Mol_Validate_Form_Relation_GreaterThanTest extends PHPUnit_Framework_TestCase
{
    
    public function testValidatorRejectsValueThatIsLessThanTheComparedOne()
    {
        
    }
    
    public function testValidatorRejectsValueThatEqualsTheComparedOne()
    {
    
    }
    
    public function testValidatorAcceptsValueThatIsGreaterThanTheComparedOne()
    {
        
    }
    
    public function testValidatorProvidedMessageIfValueIsLessThanTheComparedOne()
    {
    
    }
    
    public function testValidatorProvidesMessageIfValueEqualsTheComparedOne()
    {
    
    }
    
}
