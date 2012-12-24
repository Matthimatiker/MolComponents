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
    
    /**
     * Ensures that hasHeader() succeeds if the response contains the
     * expected header.
     */
    public function testHasHeaderSucceedsIfExpectedHeaderIsPresent()
    {
        
    }
    
    /**
     * Ensures that hasHeader() succeeds if the response contains the
     * expected header multiple times.
     */
    public function testHasHeaderSucceedsIfExpectedHeaderIsPresentMultipleTimes()
    {
    
    }
    
    /**
     * Ensures that hasHeader() fails if the response does not contain
     * the expected header.
     */
    public function testHasHeaderFailsIfHeaderIsMissing()
    {
        
    }
    
    /**
     * Ensures that notHasHeader() succeeds if the given header is not
     * present in the response.
     */
    public function testNotHasHeaderSucceedsIfHeaderIsNotPresent()
    {
        
    }
    
    /**
     * Ensures that notHasHeader() fails if the response contains the
     * provided header once.
     */
    public function testNotHasHeaderFailsIfHeaderIsPresentOnce()
    {
    
    }
    
    /**
     * Ensures that notHasHeader() fails if the response contains the
     * provided header multiple times.
     */
    public function testNotHasHeaderFailsIfHeaderIsPresentMultipleTimes()
    {
    
    }
    
    /**
     * Ensures that headerEquals() fails if the response does not contain
     * the expected header.
     */
    public function testHeaderEqualsFailsIfHeaderIsNotPresent()
    {
        
    }
    
    /**
     * Ensures that headerEquals() fails if the response contains
     * the provided header multiple times.
     */
    public function testHeaderEqualsFailsIfHeaderIsPresentMultipleTimes()
    {
    
    }
    
    /**
     * Ensures that headerEquals() fails if the response contains the
     * provided header once, but its content differs from the expected
     * value.
     */
    public function testHeaderEqualsFailsIfHeaderIsPresentButNotEqual()
    {
    
    }
    
    /**
     * Ensures that headerEquals() succeeds if the header is present exactly
     * once and it has the expected content.
     */
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
