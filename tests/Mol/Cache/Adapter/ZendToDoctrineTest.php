<?php

/**
 * Mol_Cache_Adapter_ZendToDoctrineTest
 *
 * @category PHP
 * @package Mol_Cache
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 13.04.2013
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the ZendToDoctrine cache adapter.
 *
 * @category PHP
 * @package Mol_Cache
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 13.04.2013
 */
class Mol_Cache_Adapter_ZendToDoctrineTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Cache_Adapter_ZendToDoctrine
     */
    protected $adapter = null;
    
    /**
     * The cache that is passed to the adapter.
     *
     * @var Zend_Cache_Backend_Interface
     */
    protected $innerCache = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->innerCache = new Mol_Cache_Backend_Memory();
        $this->adapter    = new Mol_Cache_Adapter_ZendToDoctrine($this->innerCache);
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
     * Checks if the adapter implements the Doctrine cache interface.
     */
    public function testImplementsCacheInterface()
    {
        $this->assertInstanceOf('Doctrine\Common\Cache\Cache', $this->adapter);
    }
    
    /**
     * Ensures that contains() returns true if a cache item exists.
     */
    public function testContainsReturnsTrueIfItemExists()
    {
        
    }
    
    /**
     * Ensures that contains() returns false if the tested cache item
     * does not exist.
     */
    public function testContainsReturnsFalseIfItemDoesNotExist()
    {
        
    }
    
    /**
     * Ensures that fetch() returns false if the requested cache item
     * does not exist.
     */
    public function testFetchReturnsFalseIfItemDoesNotExist()
    {
        
    }
    
    /**
     * Checks if fetch() returns the requested cache item.
     */
    public function testFetchReturnsCachedItem()
    {
        
    }
    
    /**
     * Checks if save() stores the given cache item.
     */
    public function testSaveStoresItem()
    {
        
    }
    
    /**
     * Ensures that save() passes the provided lifetim to the inner cache.
     */
    public function testSavePassesLifetimeToInnerCache()
    {
        
    }
    
    /**
     * Ensures that save() translates an infinite lifetime value correctly.
     */
    public function testSaveTranslatesInfiniteLifetimeCorrectly()
    {
        
    }
    
    /**
     * Ensures that non-string values are converted to strings before the adapter
     * passes them to the inner cache.
     */
    public function testSaveConvertsNonStringValuesToStringBeforePassingThemToInnerCache()
    {
        
    }
    
    /**
     * Checks if fetch() returns a cached non-string item correctly.
     */
    public function testFetchReturnsCachedNonStringItemCorrectly()
    {
        
    }
    
    /**
     * Checks if delete() removes an item.
     */
    public function testDeleteRemovesItem()
    {
        
    }
    
    /**
     * Ensures that getStats() returns null as it is not possible to determine
     * the requested statistics from a simple cache.
     */
    public function testGetStatsReturnsNull()
    {
        $this->assertNull($this->adapter->getStats());
    }
    
    /**
     * Checks if getInnerCache() returns the cache that was passed to the constructor.
     */
    public function testGetInnerCacheReturnsCacheThatWasPassedToTheConstructor()
    {
        $this->assertSame($this->innerCache, $this->adapter->getInnerCache());
    }
    
}
