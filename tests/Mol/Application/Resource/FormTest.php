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
 * Loads the factory plugin mock that is used in some tests.
 */
require_once(dirname(__FILE__) . '/TestData/Form/FactoryPlugin.php');

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
     * Ensures that the resource registers plugins that are configured as combination
     * of plugin class and options, instead of just a class.
     */
    public function testResourceRegistersConfiguredPluginIfPluginOptionsAreProvided()
    {
        $options = array(
            'plugins' => array(
                'mockPlugin' => array(
                    'class'   => 'Mol_Application_Resource_TestData_Form_FactoryPlugin',
                    'options' => array()
                )
            )
        );
        $this->resource->setOptions($options);
        $factory = $this->resource->init();
        $this->assertInstanceOf('Mol_Form_Factory', $factory);
        $plugins = $factory->getPlugins();
        $this->assertEquals(1, count($plugins));
    }
    
    /**
     * Checks if the resource passes configured options to plugins.
     */
    public function testResourcePassesConfiguredOptionsToPlugin()
    {
        $pluginOptions = array(
            'a' => 'b'
        );
        $options = array(
            'plugins' => array(
                'mockPlugin' => array(
                    'class'   => 'Mol_Application_Resource_TestData_Form_FactoryPlugin',
                    'options' => $pluginOptions
                )
            )
        );
        $this->resource->setOptions($options);
        $factory = $this->resource->init();
        $this->assertInstanceOf('Mol_Form_Factory', $factory);
        $plugins = $factory->getPlugins();
        $this->assertEquals(1, count($plugins));
        $this->assertContainsOnly('Mol_Application_Resource_TestData_Form_FactoryPlugin', $plugins);
        /* @var $plugin Mol_Application_Resource_TestData_Form_FactoryPlugin */
        $plugin = current($plugins);
        $this->assertEquals($pluginOptions, $plugin->getOptions());
    }
    
    /**
     * Ensures that the plugins are registered in the same order as they
     * are configured.
     */
    public function testResourceRegistersPluginsInConfigurationOrder()
    {
        $options = array(
            'plugins' => array(
                'first' => array(
                    'class'   => 'Mol_Application_Resource_TestData_Form_FactoryPlugin',
                    'options' => array(
                        'order' => 1
                    )
                ),
                'second' => array(
                    'class'   => 'Mol_Application_Resource_TestData_Form_FactoryPlugin',
                    'options' => array(
                        'order' => 2
                    )
                )
            )
        );
        $this->resource->setOptions($options);
        $factory = $this->resource->init();
        $this->assertInstanceOf('Mol_Form_Factory', $factory);
        $plugins = $factory->getPlugins();
        $this->assertEquals(2, count($plugins));
        $this->assertContainsOnly('Mol_Application_Resource_TestData_Form_FactoryPlugin', $plugins);
        $this->assertEquals(array('order' => 1), $plugins[0]->getOptions());
        $this->assertEquals(array('order' => 2), $plugins[1]->getOptions());
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
    
    /**
     * Ensures that an exception is thrown if the options of a plugin are
     * not defined as array.
     */
    public function testResourceThrowsExceptionIfPluginOptionsAreNotDefinedAsArray()
    {
        $this->setExpectedException('Zend_Application_Resource_Exception');
        $options = array(
            'plugins' => array(
                'invalidOptions' => array(
                    'class'   => 'Mol_Form_Factory_Plugin_Null',
                    'options' => 'Hello world!'
                )
            )
        );
        $this->resource->setOptions($options);
        $this->resource->init();
    }
    
    /**
     * Ensures that the resource adds a plugin that is configured via "class"
     * key, but whose options are omitted.
     */
    public function testResourceCreatesPluginIfOptionsAreOmitted()
    {
        $options = array(
            'plugins' => array(
                'noOptions' => array(
                    'class' => 'Mol_Form_Factory_Plugin_Null'
                )
            )
        );
        $this->resource->setOptions($options);
        $factory = $this->resource->init();
        $this->assertInstanceOf('Mol_Form_Factory', $factory);
        $plugins = $factory->getPlugins();
        $this->assertEquals(1, count($plugins));
    }
    
}
