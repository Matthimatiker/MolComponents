<?php

/**
 * Mol_Form_Element_UrlTest
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 24.03.2013
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the URL element.
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 24.03.2013
 */
class Mol_Form_Element_UrlTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Form_Element_Url
     */
    protected $element = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->element = new Mol_Form_Element_Url('url');
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->element = null;
        parent::tearDown();
    }
    
    public function testElementAcceptsUrl()
    {
        
    }
    
    public function testElementRejectsNonUrl()
    {
        
    }
    
    public function testHasHostnameRestrictionsReturnsFalseIfNoConstraintsWereDefined()
    {
        
    }
    
    public function testHasHostnameRestrictionsReturnsTrueIfConstraintsWereProvided()
    {
        
    }
    
    public function testSetAllowedHostnamesProvidesFluentInterface()
    {
        
    }
    
    public function testGetAllowedHostnamsReturnsProvidedHostnameConstraints()
    {
        
    }
    
    public function testElementAcceptsUrlWithAllowedHostname()
    {
        
    }
    
    public function testElementRejectsUrlWithNotAcceptedHostname()
    {
        
    }
    
}
