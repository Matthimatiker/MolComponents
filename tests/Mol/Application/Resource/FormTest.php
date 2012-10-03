<?php

/**
 * Mol_Application_Resource_FormTest
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 03.10.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the form resource.
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 03.10.2012
 */
class Mol_Application_Resource_FormTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Application_Resource_Form
     */
    protected $resource = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->resource = new Mol_Application_Resource_Form();
        $this->resource->setBootstrap(Mol_Test_Bootstrap::create());
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->resource = null;
        parent::tearDown();
    }
    
    public function testInitReturnsFormFactory()
    {
        
    }
    
    public function testResourceAddsConfiguredAliases()
    {
        
    }
    
    public function testResourceRegistersConfiguredPlugins()
    {
        
    }
    
    public function testResourceRegistersPluginsInConfigurationOrder()
    {
        
    }
    
    public function testResourceRegistersConfiguredPluginIfPluginOptionsAreProvided()
    {
    
    }
    
    public function testResourcePassesConfiguredOptionsToPlugin()
    {
        
    }
    
    public function testResourceThrowsExceptionIfConfiguredPluginClassIsNotValid()
    {
        
    }
    
}
