<?php

/**
 * Mol_Cache_Backend_Memory
 *
 * @category PHP
 * @package Mol_Cache
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 11.04.2013
 */

use Doctrine\Common\Cache\ArrayCache;

/**
 * Cache backend that holds its data in the memory.
 *
 * The cache data is lost when the PHP script terminates.
 * Different cache objects do not share their data.
 *
 * # Requirements #
 *
 * Internally this cache uses a Doctrine 2 cache instance, therefore
 * the package "doctrine/cache" is needed for this component to work.
 *
 * # Usage #
 *
 * No arguments are needed to create memory cache instances:
 *
 *     $backend = new Mol_Cache_Backend_Memory();
 *
 * Afterwards backend can be used by a cache instance:
 *
 *     $cache = new Zend_Cache_Core();
 *     $cache->setBackend($backend);
 *
 * It is also possible to use the factory() method of Zend_Cache_Core
 * to create a cache with memory backend:
 *
 *     $cache = Zend_Cache_Core::factory('Core', 'Mol_Cache_Backend_Memory', array(), array(), false, true, true);
 *
 * @category PHP
 * @package Mol_Cache
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 11.04.2013
 */
class Mol_Cache_Backend_Memory extends Mol_Cache_Adapter_DoctrineToZend
{
    
    /**
     * Creates a cache instance.
     */
    public function __construct()
    {
        parent::__construct(new ArrayCache());
    }
    
}
