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
    
    /**
     * Checks if init() returns a form factory.
     */
    public function testInitReturnsFormFactory()
    {
        $this->resource->setOptions(array(true));
        $factory = $this->resource->init();
        $this->assertInstanceOf('Mol_Form_Factory', $factory);
    }
    
    /**
     * Checks if the resource adds the configured aliases.
     */
    public function testResourceAddsConfiguredAliases()
    {
        $configuredAliases = array(
            'login' => 'Zend_Form'
        );
        $options = array(
            'aliases' => $configuredAliases
        );
        $this->resource->setOptions($options);
        $factory = $this->resource->init();
        $this->assertInstanceOf('Mol_Form_Factory', $factory);
        $aliases = $factory->getAliases();
        $this->assertEquals($configuredAliases, $aliases);
    }
    
    /**
     * Checks if the resource registers the configured plugins.
     */
    public function testResourceRegistersConfiguredPlugins()
    {
        $options = array(
            'plugins' => array(
                'firstPlugin' => 'Mol_Form_Factory_Plugin_Null'
            )
        );
        $this->resource->setOptions($options);
        $factory = $this->resource->init();
        $this->assertInstanceOf('Mol_Form_Factory', $factory);
        $plugins = $factory->getPlugins();
        $this->assertEquals(1, count($plugins));
        $this->assertContainsOnly('Mol_Form_Factory_Plugin_Null', $plugins);
    }
    
    /**
     * Checks if the resource passes configured options to plugins.
     */
    public function testResourcePassesConfiguredOptionsToPlugin()
    {
    
    }
    
    /**
     * Ensures that the plugins are registered in the same order as they
     * are configured.
     */
    public function testResourceRegistersPluginsInConfigurationOrder()
    {
        
    }
    
    /**
     * Ensures that the resource registers plugins that are configured as combination
     * of plugin class and options, instead of just a class.
     */
    public function testResourceRegistersConfiguredPluginIfPluginOptionsAreProvided()
    {
    
    }
    
    /**
     * Ensures that an exception is thrown if a class that is configured as
     * plugin does not implement the plugin interface.
     */
    public function testResourceThrowsExceptionIfConfiguredPluginClassIsNotValid()
    {
        $this->setExpectedException('Zend_Application_Resource_Exception');
        $options = array(
            'plugins' => array(
                'invalidPlugin' => 'stdClass'
            )
        );
        $this->resource->setOptions($options);
        $this->resource->init();
    }
    
}
