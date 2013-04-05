<?php

/**
 * Mol_Cache_Adapter_Doctrine2
 *
 * @category PHP
 * @package Mol_Cache
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.04.2013
 */

use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Cache\ArrayCache;

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the Doctrine 2 cache adapter.
 *
 * @category PHP
 * @package Mol_Cache
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.04.2013
 */
class Mol_Cache_Adapter_Doctrine2Test extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Cache_Adapter_Doctrine2
     */
    protected $adapter = null;
    
    /**
     * The mocked inner cache.
     *
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    protected $innerCache = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->innerCache = $this->getMock('\Doctrine\Common\Cache\Cache');
        $this->adapter    = $this->createAdapter($this->innerCache);
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->adapter    = null;
        $this->innerCache = null;
        parent::tearDown();
    }
    
    /**
     * Checks if the adapter implements the Zend cache backend
     * interface.
     */
    public function testAdapterImplementsZendCacheInterface()
    {
        $this->assertInstanceOf('Zend_Cache_Backend_Interface', $this->adapter);
    }
    
    /**
     * Checks if the save() method delegates to the save() method
     * of the inner Doctrine cache.
     */
    public function testSaveDelegatesToInnerCache()
    {
        $this->innerCache->expects($this->once())
                         ->method('save')
                         ->with('test', $this->stringContains('hello world'));
        $this->adapter->save('hello world', 'test');
    }
    
    /**
     * Checks if the cache uses the configured lifetime per default.
     */
    public function testSaveUsesConfiguredLifetimePerDefault()
    {
        $this->innerCache->expects($this->once())
                         ->method('save')
                         ->with($this->anything(), $this->anything(), 42);
        $this->adapter->save('hello world', 'test');
    }
    
    /**
     * Checks if save() passes a specific lifetime to the inner cache.
     */
    public function testSaveSavesPassesSpecificLifetime()
    {
        $this->innerCache->expects($this->once())
                         ->method('save')
                         ->with($this->anything(), $this->anything(), 7);
        $this->adapter->save('hello world', 'test', array(), 7);
    }
    
    /**
     * Ensures that the infinite lifetime (value null) is translated
     * into 0, which is assumed infinite by the inner cache.
     */
    public function testSaveTranslatesInfiniteLifetimeCorrectly()
    {
        $this->innerCache->expects($this->once())
                         ->method('save')
                         ->with($this->anything(), $this->anything(), 0);
        $this->adapter->save('hello world', 'test', array(), null);
    }
    
    /**
     * Checks if the load() method delegates to the fetch() method
     * of the inner Doctrine cache.
     */
    public function testLoadDelegatesToFetch()
    {
        $this->innerCache->expects($this->once())
                         ->method('fetch')
                         ->with('test');
        $this->adapter->load('test');
    }
    
    /**
     * Ensures that load() returns false if the requested cache item
     * does not exist.
     */
    public function testLoadReturnsFalseIfItemDoesNotExist()
    {
        $this->adapter = $this->createAdapter(new ArrayCache());
        $this->assertFalse($this->adapter->load('missing'));
    }
    
    /**
     * Checks if load() returns the expected value.
     */
    public function testLoadReturnsCorrectValue()
    {
        $this->adapter = $this->createAdapter(new ArrayCache());
        $this->adapter->save('hello world', 'test');
        $this->assertEquals('hello world', $this->adapter->load('test'));
    }
    
    /**
     * Ensures that test() returns false if the cache item does not exist.
     */
    public function testTestReturnsFalseIfItemDoesNotExist()
    {
        $this->adapter = $this->createAdapter(new ArrayCache());
        $this->assertFalse($this->adapter->test('missing'));
    }
    
    /**
     * Ensures that test() returns the modification timestamp if the
     * cache item exists.
     */
    public function testTestReturnsModificationTimestampIfItemExists()
    {
        $this->adapter = $this->createAdapter(new ArrayCache());
        $this->adapter->save('hello world', 'test');
        $this->assertInternalType('integer', $this->adapter->test('test'));
    }
    
    /**
     * Checks if the remove() method delegates to the delete() method
     * of the inner Doctrine cache.
     */
    public function testRemoveDelegatesToDelete()
    {
        $this->innerCache->expects($this->once())
                         ->method('delete')
                         ->with('test');
        $this->adapter->remove('test');
    }
    
    /**
     * Ensures that the clean() method returns false as this functionality
     * is not supported by the inner cache.
     */
    public function testCleanReturnsFalseAsItIsNotSupported()
    {
        $this->assertFalse($this->adapter->clean());
    }
    
    /**
     * Creates an adapter for the provided cache.
     *
     * @param \Doctrine\Common\Cache\Cache $innerCache
     * @return Mol_Cache_Adapter_Doctrine2
     */
    protected function createAdapter(Cache $innerCache)
    {
        $adapter = new Mol_Cache_Adapter_Doctrine2($innerCache);
        $adapter->setDirectives(array('lifetime' => 42));
        return $adapter;
    }
    
}