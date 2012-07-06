<?php

/**
 * Mol_Test_BootstrapTest
 *
 * @category PHP
 * @package Mol_Test
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 06.07.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the bootstrapper that is used for testing.
 *
 * @category PHP
 * @package Mol_Test
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 06.07.2012
 */
class Mol_Test_BootstrapTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
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
        $this->bootstrapper = $this->createBootstrapper();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->bootstrapper = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that create() returns always new bootstrapper instances.
     */
    public function testCreateReturnsNewBootstrapperOnEachCall()
    {
        $this->assertNotSame(Mol_Test_Bootstrap::create(), Mol_Test_Bootstrap::create());
    }
    
    /**
     * Checks if the bootstrapper implements the bootstrapper interface.
     */
    public function testBootrapperImplementsBootstrapperInterface()
    {
        $this->assertInstanceOf('Zend_Application_Bootstrap_Bootstrapper', $this->bootstrapper);
    }
    
    /**
     * Checks if simulateResource() provides a fluent interface.
     */
    public function testSimulateResourceProvidesFluentInterface()
    {
        $this->assertSame($this->bootstrapper, $this->bootstrapper->simulateResource('test'));
    }
    
    /**
     * Ensures that getResource() returns simulated resources.
     */
    public function testGetResourceReturnsSimulatedResource()
    {
        $this->bootstrapper->simulateResource('hello', 'world');
        $this->assertEquals('world', $this->bootstrapper->getResource('hello'));
    }
    
    /**
     * Ensures that a resource is overwritten if simlateResource() is called again.
     */
    public function testSimulateResourceOverwritesPreviousResourceWithSameName()
    {
        $this->bootstrapper->simulateResource('hello', 'world');
        $this->bootstrapper->simulateResource('hello', 'test');
        $this->assertEquals('test', $this->bootstrapper->getResource('hello'));
    }
    
    /**
     * Checks if it is possible to overwrite a resource with null.
     */
    public function testSimulateResourceCanOverwriteResourceWithNull()
    {
        $this->bootstrapper->simulateResource('hello', 'world');
        $this->bootstrapper->simulateResource('hello', null);
        $this->assertNull($this->bootstrapper->getResource('hello'));
    }
    
    /**
     * Ensures that multiple bootstrapper instances do not share their resources.
     */
    public function testBootstrappersDoNotShareResources()
    {
        $other = $this->createBootstrapper();
        $this->bootstrapper->simulateResource('hello', 'world');
        $this->assertNull($other->getResource('hello'));
    }
    
    /**
     * Ensures that bootstrap() does not throw an exception if the provided
     * resource was simulated.
     */
    public function testBootstrapDoesNotThrowExceptionIfResourceWasSimulated()
    {
        $this->bootstrapper->simulateResource('hello', 'world');
        $this->bootstrapper->bootstrap('hello');
    }
    
    /**
     * Ensures that bootstrap() throws an exception if the provided resource
     * was not simulated.
     */
    public function testBootstrapThrowsExceptionIfResourceWasNotSimulated()
    {
        $this->setExpectedException('Zend_Application_Bootstrap_Exception');
        $this->bootstrapper->bootstrap('hello');
    }
    
    /**
     * Ensures that the run() method does not raise any error.
     */
    public function testRunDoesNothing()
    {
        $this->setExpectedException(null);
        $this->bootstrapper->run();
    }
    
    /**
     * Creates a new bootstrapper for testing.
     *
     * @return Mol_Test_Bootstrap
     */
    protected function createBootstrapper()
    {
        $bootstrapper = Mol_Test_Bootstrap::create();
        $this->assertInstanceOf('Mol_Test_Bootstrap', $bootstrapper);
        return $bootstrapper;
    }
    
}
