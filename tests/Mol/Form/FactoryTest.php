<?php

/**
 * Mol_Form_FactoryTest
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.10.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the form factory.
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.10.2012
 */
class Mol_Form_FactoryTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Form_Factory
     */
    protected $factory = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->factory = new Mol_Form_Factory();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->factory = null;
        parent::tearDown();
    }
    
    /**
     * Checks if addAlias() provides a fluent interface.
     */
    public function testAddAliasProvidesFluentInterface()
    {
        $this->assertSame($this->factory, $this->factory->addAlias('registration', 'Zend_Form'));
    }
    
    /**
     * Ensures that getAliases() returns an array.
     */
    public function testGetAliasesReturnsArray()
    {
        $this->assertInternalType('array', $this->factory->getAliases());
    }
    
    /**
     * Checks if getAliases() returns the correct mapping of aliases
     * to classes.
     */
    public function testGetAliasesReturnsMappingOfAliasesToClasses()
    {
        $this->factory->addAlias('registration', 'Zend_Form');
        $this->factory->addAlias('login', 'Zend_Form');
        $aliases  = $this->factory->getAliases();
        $expected = array(
            'registration' => 'Zend_Form',
            'login'        => 'Zend_Form'
        );
        $this->assertEquals($expected, $aliases);
    }
    
    /**
     * Checks if addAlias() overwrites the previous alias with the
     * same name.
     */
    public function testAddAliasOverwritesExistingAliasWithSameName()
    {
        $this->factory->addAlias('login', 'Zend_Form_SubForm');
        $this->factory->addAlias('login', 'Zend_Form');
        $aliases = $this->factory->getAliases();
        $this->assertInternalType('array', $aliases);
        $this->assertArrayHasKey('login', $aliases);
        $this->assertEquals('Zend_Form', $aliases['login']);
    }
    
    /**
     * Checks if registerPlugin() provides a fluent interface.
     */
    public function testRegisterPluginProvidesFluentInterface()
    {
        $this->assertSame($this->factory, $this->factory->registerPlugin(new Mol_Form_Factory_Plugin_Null()));
    }
    
    /**
     * Ensures that getPlugins() returns an array.
     */
    public function testGetPluginsReturnsArray()
    {
        $this->assertInternalType('array', $this->factory->getPlugins());
    }
    
    /**
     * Checks if getPlugins() returns the registered plugins.
     */
    public function testGetPluginsReturnsRegisteredPlugins()
    {
        $plugin = new Mol_Form_Factory_Plugin_Null();
        $this->factory->registerPlugin($plugin);
        $plugins = $this->factory->getPlugins();
        $this->assertInternalType('array', $plugins);
        $this->assertEquals(1, count($plugins));
        $this->assertContains($plugin, $plugins);
    }
    
    /**
     * Ensures that getPlugins() returns the plugins in order of their
     * registration.
     */
    public function testGetPluginsReturnsPluginsInRegistrationOrder()
    {
        $first = new Mol_Form_Factory_Plugin_Null();
        $this->factory->registerPlugin($first);
        $second = new Mol_Form_Factory_Plugin_Null();
        $this->factory->registerPlugin($second);
        $plugins = $this->factory->getPlugins();
        $this->assertInternalType('array', $plugins);
        $this->assertGreaterThan(array_search($first, $plugins, true), array_search($second, $plugins, true));
    }
    
    /**
     * Ensures that create() returns the form instance that is
     * passed as argument.
     */
    public function testCreateReturnsProvidedFormInstance()
    {
        $form = new Zend_Form();
        $this->assertSame($form, $this->factory->create($form));
    }
    
    /**
     * Checks if create() creates an instance of the given form class.
     */
    public function testCreateInstantiatesFormOfGivenType()
    {
        $form = $this->factory->create('Zend_Form');
        $this->assertInstanceOf('Zend_Form', $form);
    }
    
    /**
     * Ensures that create() instantiates a form of the type that the given
     * alias points to.
     */
    public function testCreateInstantiatesFormOfCorrectTypeIfAliasIsProvided()
    {
        $this->factory->addAlias('login', 'Zend_Form');
        $form = $this->factory->create('login');
        $this->assertInstanceOf('Zend_Form', $form);
    }
    
    /**
     * Ensures that create() instantiates the correct form type even if a form
     * class name is used as alias.
     */
    public function testCreateInstantiatesFormOfCorrectTypeIfClassNameIsUsedAsAlias()
    {
        // Create a sub class of Zend_Form.
        $formMock = $this->getMock('Zend_Form');
        $subClass = get_class($formMock);
        $this->factory->addAlias('Zend_Form', $subClass);
        $form = $this->factory->create('Zend_Form');
        $this->assertInstanceOf('Zend_Form', $form);
        $this->assertEquals($subClass, get_class($form));
    }
    
    /**
     * Checks if the factory passes the created form to the registered plugins.
     */
    public function testCreatePassesFormToRegisteredPlugins()
    {
        $plugin = $this->getMock('Mol_Form_Factory_Plugin');
        $plugin->expects($this->once())
               ->method('enhance')
               ->with($this->isInstanceOf('Zend_Form'));
        $this->factory->registerPlugin($plugin);
        $this->factory->create('Zend_Form');
    }
    
    /**
     * Ensures that create() throws an exception if the given alias does
     * not exist.
     */
    public function testCreateThrowsExceptionIfAliasDoesNotExist()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->factory->create('notExistingAlias');
    }
    
    /**
     * Ensures that create() throws an exception if the given alias points
     * to an invalid class.
     */
    public function testCreateThrowsExceptionIfAliasPointsToInvalidClass()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->factory->addAlias('alias', 'stdClass');
        $this->factory->create('alias');
    }
    
    /**
     * Ensures that create() throws an exception if the given class is
     * not a valid form class.
     */
    public function testCreateThrowsExceptionIfNoFormClassIsProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->factory->create('stdClass');
    }
    
    /**
     * Ensures that create() throws an exception if the given object is not
     * an instance of Zend_Form.
     */
    public function testCreateThrowsExceptionIfProvidedObjectIsNoFormInstance()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->factory->create(new stdClass());
    }
    
}
