<?php

/**
 * Mol_Cache_Backend_MemoryTest
 *
 * @category PHP
 * @package Mol_Cache
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 11.04.2013
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Mol_Cache_Backend_Memory
 *
 * @category PHP
 * @package Mol_Cache
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 11.04.2013
 */
class Mol_Cache_Backend_MemoryTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Cache_Backend_Memory
     */
    protected $cache = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->cache = new Mol_Cache_Backend_Memory();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->cache = null;
        parent::tearDown();
    }
    
    /**
     * Checks if the cache implements the cache backend interface.
     */
    public function testCacheImplementsBackendInterface()
    {
        $this->assertInstanceOf('Zend_Cache_Backend_Interface', $this->cache);
    }
    
    /**
     * Checks if the cache extends the cache backend base class.
     *
     * That class must be used as parent, otherwise the cache does not
     * work with Zend_Cache_Core.
     */
    public function testCacheExtendsBackendClass()
    {
        $this->assertInstanceOf('Zend_Cache_Backend', $this->cache);
    }
    
    /**
     * Ensures that test() returns false if the cache item does not exist.
     */
    public function testTestReturnsFalseIfItemDoesNotExist()
    {
        $this->assertFalse($this->cache->test('key'));
    }
    
    /**
     * Ensures that test() returns a timestamp if the checked item exists.
     */
    public function testTestReturnsTimestampIfItemExists()
    {
        $this->cache->save('value', 'key');
        $this->assertInternalType('integer', $this->cache->test('key'));
    }
    
    /**
     * Ensures that load() returns false if the requested item does not exist.
     */
    public function testLoadReturnsFalseIfItemDoesNotExist()
    {
        $this->assertFalse($this->cache->load('key'));
    }
    
    /**
     * Checks if load() returns the cached item.
     */
    public function testLoadReturnsStoredItem()
    {
        $this->cache->save('value', 'key');
        $this->assertEquals('value', $this->cache->load('key'));
    }
    
    /**
     * Ensures that save() returns true if the cache item was stored.
     */
    public function testSaveReturnsTrueIfItemWasStored()
    {
        $this->assertTrue($this->cache->save('value', 'key'));
    }
    
    /**
     * Checks if remove() deletes a previously added item.
     */
    public function testRemoveDeletesItem()
    {
        $this->cache->save('value', 'key');
        $this->cache->remove('key');
        $this->assertFalse($this->cache->test('key'));
    }
    
    /**
     * Ensures that removed() returns true if the cache item was successfully
     * deleted.
     */
    public function testRemoveReturnsTrueIfEntryWasDeleted()
    {
        $this->cache->save('value', 'key');
        $this->assertTrue($this->cache->remove('key'));
    }
    
    /**
     * Ensures that different cache instances do not share their data.
     */
    public function testDifferentCacheInstancesDoNotShareData()
    {
        $anotherCache = new Mol_Cache_Backend_Memory();
        $anotherCache->save('value', 'key');
        $this->assertFalse($this->cache->test('key'));
    }
    
}
