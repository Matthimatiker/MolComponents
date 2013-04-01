<?php

/**
 * Mol_Form_Factory_Plugin_UniqueId
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.04.2013
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Mol_Form_Factory_Plugin_UniqueId
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.04.2013
 */
class Mol_Form_Factory_Plugin_UniqueIdTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Form_Factory_Plugin_UniqueId
     */
    protected $plugin = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->plugin = new Mol_Form_Factory_Plugin_UniqueId();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->plugin = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that the generated ID starts with the original ID.
     */
    public function testGeneratedIdStartsWithOriginalId()
    {
        
    }
    
    /**
     * Ensures that elements with the same name get different IDs.
     */
    public function testElementsWithSameNameReceiveDifferentIds()
    {
        
    }
    
    /**
     * Ensures that elements in sub forms also get unique IDs.
     */
    public function testElementsInSubFormsReceiveUniqueIds()
    {
        
    }
    
}