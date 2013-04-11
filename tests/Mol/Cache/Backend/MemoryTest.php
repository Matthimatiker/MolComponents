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
     * Checks if the cache implements the cache backend interface.
     */
    public function testCacheImplementsBackendInterface()
    {
        
    }
    
    /**
     * Checks if the cache extends the cache backend base class.
     *
     * That class must be used as parent, otherwise the cache does not
     * work with Zend_Cache_Core.
     */
    public function testCacheExtendsBackendClass()
    {
        
    }
    
    /**
     * Ensures that test() returns false if the cache item does not exist.
     */
    public function testTestReturnsFalseIfItemDoesNotExist()
    {
        
    }
    
    /**
     * Ensures that test() returns a timestamp if the checked item exists.
     */
    public function testTestReturnsTimestampIfItemExists()
    {
        
    }
    
    /**
     * Ensures that load() returns false if the requested item doe snot exist.
     */
    public function testLoadReturnsFalseIfItemDoesNotExist()
    {
        
    }
    
    /**
     * Checks if load() returns the cached item.
     */
    public function testLoadReturnsStoredItem()
    {
        
    }
    
    /**
     * Checks if remove() deletes a previously added item.
     */
    public function testRemoveDeletesItem()
    {
        
    }
    
    /**
     * Ensures that different cache instances do not share their data.
     */
    public function testDifferentCacheInstancesDoNotShareData()
    {
        
    }
    
}
