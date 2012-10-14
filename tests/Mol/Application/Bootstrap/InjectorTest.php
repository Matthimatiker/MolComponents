<?php

/**
 * Mol_Application_Bootstrap_InjectorTest
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 14.10.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the bootstrap injector.
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 14.10.2012
 */
class Mol_Application_Bootstrap_InjectorTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Application_Bootstrap_Injector
     */
    protected $injector = null;
    
    /**
     * The bootstrapper that is used in the tests.
     *
     * @var Mol_Test_Bootstrap
     */
    protected $bootstrapper = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->bootstrapper = Mol_Test_Bootstrap::create();
        $this->injector     = new Mol_Application_Bootstrap_Injector($this->bootstrapper);
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->injector     = null;
        $this->bootstrapper = null;
        parent::tearDown();
    }
    
    /**
     * Checks if inject() returns the provided non-bootstrap-aware
     * object.
     */
    public function testInjectReturnsProvidedObject()
    {
        
    }
    
    /**
     * Checks if inject() returns the provided value.
     */
    public function testInjectReturnsProvidedValue()
    {
        
    }
    
    /**
     * Ensures that inject() injects the bootstrapper into a bootstrap-aware
     * object.
     */
    public function testInjectSetsBootstrapperIfObjectIsBootstrapAware()
    {
        
    }
    
    /**
     * Checks if inject() returns the provided bootstrap-aware object.
     */
    public function testInjectReturnsBootstrapAwareObject()
    {
        
    }
    
    /**
     * Method that is used as callback and checks the received bootstrapper.
     *
     * @param mixed $bootstrapper
     */
    public function setBootstrap($bootstrapper)
    {
        $this->assertSame($this->bootstrapper, $bootstrapper);
    }
    
}
