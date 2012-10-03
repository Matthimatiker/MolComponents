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
        
    }
    
    /**
     * Ensures that getAliases() returns an array.
     */
    public function testGetAliasesReturnsArray()
    {
        
    }
    
    /**
     * Checks if getAliases() returns the correct mapping of aliases
     * to classes.
     */
    public function testGetAliasesReturnsMappingOfAliasesToClasses()
    {
    
    }
    
    /**
     * Checks if registerPlugin() provides a fluent interface.
     */
    public function testRegisterPluginProvidesFluentInterface()
    {
        
    }
    
    /**
     * Ensures that getPlugins() returns an array.
     */
    public function testGetPluginsReturnsArray()
    {
        
    }
    
    /**
     * Checks if getPlugins() returns the registered plugins.
     */
    public function testGetPluginsReturnsRegisteredPlugins()
    {
    
    }
    
    /**
     * Ensures that create() returns the form instance that is
     * passed as argument.
     */
    public function testCreateReturnsProvidedFormInstance()
    {
        
    }
    
    /**
     * Checks if create() creates an instance of the given form class.
     */
    public function testCreateInstantiatesFormOfGivenType()
    {
        
    }
    
    /**
     * Ensures that create() instantiates a form of the type that the given
     * alias points to.
     */
    public function testCreateInstantiatesFormOfCorrectTypeIfAliasIsProvided()
    {
    
    }
    
    /**
     * Ensures that create() instantiates the correct form type even if a form
     * class name is used as alias.
     */
    public function testCreateInstantiatesFormOfCorrectTypeIfClassNameIsUsedAsAlias()
    {
    
    }
    
    /**
     * Checks if the factory passes the created form to the registered plugins.
     */
    public function testCreatePassesFormToRegisteredPlugins()
    {
        
    }
    
    /**
     * Ensures that create() throws an exception if the given alias does
     * not exist.
     */
    public function testCreateThrowsExceptionIfAliasDoesNotExist()
    {
    
    }
    
    /**
     * Ensures that create() throws an exception if the given alias points
     * to an invalid class.
     */
    public function testCreateThrowsExceptionIfAliasPointsToInvalidClass()
    {
        
    }
    
    /**
     * Ensures that create() throws an exception if the given class is
     * not a valid form class.
     */
    public function testCreateThrowsExceptionIfNoFormClassIsProvided()
    {
        
    }
    
    /**
     * Ensures that create() throws an exception if the given object is not
     * an instance of Zend_Form.
     */
    public function testCreateThrowsExceptionIfProvidedObjectIsNoFormInstance()
    {
        
    }
    
}
