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
    
    public function testImplementsCacheInterface()
    {
        
    }
    
    public function testContainsReturnsTrueIfItemExists()
    {
        
    }
    
    public function testContainsReturnsFalseIfItemDoesNotExist()
    {
        
    }
    
    public function testFetchReturnsFalseIfItemDoesNotExist()
    {
        
    }
    
    public function testFetchReturnsCachedItem()
    {
        
    }
    
    public function testSaveStoresItem()
    {
        
    }
    
    public function testSavePassesLifetimeToInnerCache()
    {
        
    }
    
    public function testSaveTranslatesInfiniteLifetimeCorrectly()
    {
        
    }
    
    public function testDeleteRemovesItem()
    {
        
    }
    
    public function testGetStatsReturnsNull()
    {
        
    }
    
    public function testGetInnerCacheReturnsCacheThatWasPassedToTheConstructor()
    {
        
    }
    
}
