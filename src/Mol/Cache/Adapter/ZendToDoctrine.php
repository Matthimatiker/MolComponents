<?php

/**
 * Mol_Cache_Adapter_ZendToDoctrine
 *
 * @category PHP
 * @package Mol_Cache
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 13.04.2013
 */

use Doctrine\Common\Cache\Cache;

/**
 * Adapter that allows the usage of Zend caches with Doctrine 2.
 *
 * @category PHP
 * @package Mol_Cache
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 13.04.2013
 */
class Mol_Cache_Adapter_ZendToDoctrine implements Cache
{
    
    /**
     * The inner cache.
     *
     * @var Zend_Cache_Backend_Interface
     */
    protected $cache = null;
    
    /**
     * Creates an adapter for the given Zend cache.
     *
     * @param Zend_Cache_Backend_Interface $cache
     */
    public function __construct(Zend_Cache_Backend_Interface $cache)
    {
        $this->cache = $cache;
    }
    
    /**
     * Returns the inner Zend cache.
     *
     * @return Zend_Cache_Backend_Interface
     */
    public function getInnerCache()
    {
        return $this->cache;
    }
    
    /**
     * See {@link Doctrine\Common\Cache\Cache::fetch()} for details.
     *
     * @param string $id
     * @return mixed
     */
    function fetch($id)
    {
        $item = $this->cache->load($id);
        if ($item === false) {
            return false;
        }
        return $item;
    }

    /**
     * See {@link Doctrine\Common\Cache\Cache::contains()} for details.
     *
     * @param string $id
     * @return boolean
     */
    function contains($id)
    {
        return $this->cache->test($id) !== false;
    }

    /**
     * See {@link Doctrine\Common\Cache\Cache::save()} for details.
     *
     * @param string $id
     * @param mixed $data
     * @param integer $lifeTime
     * @return boolean
     */
    function save($id, $data, $lifeTime = 0)
    {
        if ($lifeTime === 0) {
            // Lifetime 0 means infinite in Doctrine 2 whereas Zend
            // interprets null as infinite.
            $lifeTime = null;
        }
        return $this->cache->save($data, $id, array(), $lifeTime);
    }

    /**
     * See {@link Doctrine\Common\Cache\Cache::delete()} for details.
     *
     * @param string $id
     * @return boolean
     */
    function delete($id)
    {
        return $this->cache->remove($id);
    }

    /**
     * See {@link Doctrine\Common\Cache\Cache::getStats()} for details.
     *
     * @return null
     */
    function getStats()
    {
        return null;
    }
    
}
