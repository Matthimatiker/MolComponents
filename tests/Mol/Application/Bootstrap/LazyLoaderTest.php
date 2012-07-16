<?php

/**
 * Mol_Application_Bootstrap_LazyLoaderTest
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 15.07.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the lazy loader.
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 15.07.2012
 */
class Mol_Application_Bootstrap_LazyLoaderTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * The name of the method that is used as callback.
     *
     * @var string
     */
    const CALLBACK_METHOD = 'init';
    
    /**
     * Ensures that an exception is thrown if an invalid callback is passed
     * to the constructor.
     */
    public function testConstructorThrowsExceptionIfInvalidCallbackIsProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        new Mol_Application_Bootstrap_LazyLoader(array(new stdClass(), 'missing'));
    }
    
    /**
     * Checks if the load() executes the callback.
     */
    public function testLoadExecutesCallback()
    {
        $mock = $this->createCallbackMock();
        $mock->expects($this->once())
             ->method(self::CALLBACK_METHOD)
             ->will($this->returnValue('test'));
        $this->createLazyLoader($mock)->load();
        
    }
    
    /**
     * Ensures that the callback is executed only once, even if load() is
     * called multiple times.
     */
    public function testCallbackIsExecutedOnlyOnceEvenIfLoadIsCalledMultipleTimes()
    {
        $mock = $this->createCallbackMock();
        $mock->expects($this->once())
             ->method(self::CALLBACK_METHOD)
             ->will($this->returnValue('test'));
        $loader = $this->createLazyLoader($mock);
        $loader->load();
        $loader->load();
    }
    
    /**
     * Ensures that the callback is executed only once, even if it returns
     * null as result.
     */
    public function testCallbackIsExecutedOnlyOnceEvenIfCallbackReturnsNull()
    {
        $mock = $this->createCallbackMock();
        $mock->expects($this->once())
             ->method(self::CALLBACK_METHOD)
             ->will($this->returnValue(null));
        $loader = $this->createLazyLoader($mock);
        $loader->load();
        $loader->load();
    }
    
    /**
     * Checks if load() returns the return value of the callback.
     */
    public function testLoadReturnsResultOfCallback()
    {
        $mock = $this->createCallbackMock();
        $mock->expects($this->any())
             ->method(self::CALLBACK_METHOD)
             ->will($this->returnValue('test'));
        $loader = $this->createLazyLoader($mock);
        $this->assertEquals('test', $loader->load());
    }
    
    /**
     * Ensures that following calls to load() return the correct value.
     */
    public function testLoadReturnsCorrectResultOnFollowingCalls()
    {
        $result = new stdClass();
        $mock   = $this->createCallbackMock();
        $mock->expects($this->any())
             ->method(self::CALLBACK_METHOD)
             ->will($this->returnValue($result));
        $loader = $this->createLazyLoader($mock);
        $loader->load();
        // Following calls to load() should return the same result.
        $this->assertSame($result, $loader->load());
    }
    
    /**
     * Creates a lazy loader that uses the provided mock object as callback.
     *
     * @param PHPUnit_Framework_MockObject_MockObject $mock
     * @return Mol_Application_Bootstrap_LazyLoader
     */
    protected function createLazyLoader(PHPUnit_Framework_MockObject_MockObject $mock)
    {
        return new Mol_Application_Bootstrap_LazyLoader($this->toCallback($mock));
    }
    
    /**
     * Creates a mock object that provides an init method which
     * is used as callback.
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    protected function createCallbackMock()
    {
        return $this->getMock('stdClass', array(self::CALLBACK_METHOD));
    }
    
    /**
     * Creates a callback for the provided mock object.
     *
     * The callback will execute the init method of the mock object.
     *
     * @param PHPUnit_Framework_MockObject_MockObject $mock
     * @return mixed The callback.
     */
    protected function toCallback(PHPUnit_Framework_MockObject_MockObject $mock)
    {
        return array($mock, self::CALLBACK_METHOD);
    }
    
}
