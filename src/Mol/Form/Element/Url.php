<?php

/**
 * Mol_Form_Element_Url
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 24.03.2013
 */

/**
 * Form element that accepts a URL as input.
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 24.03.2013
 */
class Mol_Form_Element_Url extends Zend_Form_Element_Text
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
    
    /**
     * Sets hostnames that are allowed in the url.
     *
     * @param array(string) $hostnames
     * @return Mol_Form_Element_Url Provides a fluent interface.
     */
    public function setAllowedHostnames(array $hostnames)
    {
        
    }
    
    /**
     * Returns a list of allowed hostnames.
     *
     * @return array(string)
     */
    public function getAllowedHostnames()
    {
        
    }
    
    /**
     * Checks if hostname restrictions are active.
     *
     * @return boolean True if the hostname is restricted, false otherwise.
     */
    public function hasHostnameRestrictions()
    {
        
    }
    
}
