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
     * Checks if the adapter implements the Zend cache backend
     * interface.
     */
    public function testAdapterImplementsZendCacheInterface()
    {
        
    }
    
    /**
     * Checks if the load() method delegates to the fetch() method
     * of the inner Doctrine cache.
     */
    public function testLoadDelegatesToFetch()
    {
        
    }
    
    /**
     * Checks if the test() method delegates to the contains() method
     * of the inner Doctrine cache.
     */
    public function testTestDelegatesToContains()
    {
        
    }
    
    /**
     * Checks if the save() method delegates to the save() method
     * of the inner Doctrine cache.
     */
    public function testSaveDelegatesToInnerCache()
    {
        
    }
    
    /**
     * Checks if the remove() method delegates to the delete() method
     * of the inner Doctrine cache.
     */
    public function testRemoveDelegatesToDelete()
    {
        
    }
    
    /**
     * Ensures that the clean() method returns false as this functionality
     * is not supported by the inner cache.
     */
    public function testCleanReturnsFalseAsItIsNotSupported()
    {
        
    }
    
}
