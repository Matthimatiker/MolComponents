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
    
    /**
     * Ensures that the creation of the assertion object fails if no
     * valid HTTP response object is provided.
     */
    public function testCreatingObjectForNonResponseFails()
    {
        
    }
    
    /**
     * Ensures that hasCode() fails if the status code of the response
     * does not match the expected one.
     */
    public function testHasCodeFailsIfCodeDiffers()
    {
        
    }
    
    /**
     * Ensures hasCode() succeeds if the response contains the expected
     * status code.
     */
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
    
    public function testContainsFailsIfBodyDoesNotContainTheExpectedString()
    {
        
    }
    
    public function testContainsSucceedsIfBodyContainsTheExpectedString()
    {
    
    }
    
    public function testNotContainsFailsIfBodyContainsTheGivenString()
    {
        
    }
    
    public function testNotContainsSucceedsIfBodyDoesNotContainTheGivenString()
    {
        
    }
    
    public function testContainsImageFailsIfBodyDoesNotContainImage()
    {
        
    }
    
    public function testContainsImageFailsIfImageContentTypeIsMissing()
    {
        
    }
    
    public function testContainsImageFailsIfTypeOfImageAndContentTypeDoNotMatch()
    {
        
    }
    
    public function testContainsImageSucceedsIfBodyContainsImageAndHeaderIsCorrect()
    {
    
    }
    
    public function testContainsJsonFailsIfBodyDoesNotContainJsonData()
    {
        
    }
    
    public function testContainsJsonFailsIfContentTypeDoesNotIndicateJsonFormat()
    {
        
    }
    
    public function testContainsJsonSucceedsIfBodyContainsJsonAndContentTypeIndicatesFormat()
    {
        
    }
    
}
