<?php

/**
 * Mol_Test_Assertions_HttpResponseTest
 *
 * @category PHP
 * @package Mol_Test
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 23.12.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the HttpResponse assertions.
 *
 * @category PHP
 * @package Mol_Test
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 23.12.2012
 */
class Mol_Test_Assertions_HttpResponseTest extends PHPUnit_Framework_TestCase
{
    
    public function testCreatingObjectForNonResponseFails()
    {
        
    }
    
    public function testHasCodeFailsIfCodeDiffers()
    {
        
    }
    
    public function testHasCodeSucceedsIfExpectedCodeIsPresent()
    {
        
    }
    
    public function testHasHeaderSucceedsIfExpectedHeaderIsPresent()
    {
        
    }
    
    public function testHasHeaderSucceedsIfExpectedHeaderIsPresentMultipleTimes()
    {
    
    }
    
    public function testHasHeaderFailsIfHeaderIsMissing()
    {
        
    }
    
    public function testNotHasHeaderSucceedsIfHeaderIsNotPresent()
    {
        
    }
    
    public function testNotHasHeaderFailsIfHeaderIsPresentOnce()
    {
    
    }
    
    public function testNotHasHeaderFailsIfHeaderIsPresentMultipleTimes()
    {
    
    }
    
    public function testHeaderEqualsFailsIfHeaderIsNotPresent()
    {
        
    }
    
    public function testHeaderEqualsFailsIfHeaderIsPresentMultipleTimes()
    {
    
    }
    
    public function testHeaderEqualsFailsIfHeaderIsPresentButNotEqual()
    {
    
    }
    
    public function testHeaderEqualsSucceedsIfHeaderIsPresentOnceAndEqual()
    {
    
    }
    
}
