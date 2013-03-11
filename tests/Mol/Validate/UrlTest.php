<?php

/**
 * Mol_Validate_UrlTest
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 11.03.2013
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the URL validator.
 *
 * @category PHP
 * @package Mol_Validate
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 11.03.2013
 */
class Mol_Validate_UrlTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Validate_Url
     */
    protected $validator = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->validator = new Mol_Validate_Url();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->validator = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that the validator rejects non-string values.
     */
    public function testValidatorRejectsNonStringValue()
    {
        
    }
    
    /**
     * Checks if the validator rejects a string that does not
     * contrain an URL.
     */
    public function testValidatorRejectsNonUrlString()
    {
        
    }
    
    /**
     * Ensures that the validator rejects relative URLs.
     */
    public function testValidatorRejectsRelativeUrl()
    {
        
    }
    
    /**
     * Checks if the validator accepts absolute URLs.
     */
    public function testValidatorAcceptsAbsoluteUrl()
    {
        
    }
    
    /**
     * Ensures that the validator provides a failure message when a validated
     * value was not accepted.
     */
    public function testValidatorProvidesMessageAfterValidationOfNonUrlString()
    {
        
    }
    
}
