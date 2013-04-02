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
    
    public function testAdapterImplementsZendCacheInterface()
    {
        
    }
    
    public function testLoadDelegatesToFetch()
    {
        
    }
    
    public function testTestDelegatesToContains()
    {
        
    }
    
    public function testSaveDelegatesToInnerCache()
    {
        
    }
    
    public function testRemoveDelegatesToDelete()
    {
        
    }
    
    public function testCleanReturnsFalseAsItIsNotSupported()
    {
        
    }
    
}
