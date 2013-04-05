<?php

/**
 * Mol_Cache_Adapter_Doctrine2
 *
 * @category PHP
 * @package Mol_Cache
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.04.2013
 */

use Doctrine\Common\Cache\Cache;

/**
 * Adapter that allows the usage of Doctrine 2 caches in Zend applications.
 *
 * @category PHP
 * @package Mol_Cache
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.04.2013
 */
class Mol_Cache_Adapter_Doctrine2 implements Zend_Cache_Backend_Interface
{
    
    /**
     * The inner cache.
     *
     * @var \Doctrine\Common\Cache\Cache
     */
    protected $cache = null;
    
    /**
     * Options that were passed to this cache.
     *
     * @var array(string=>mixed)
     */
    protected $directives = array();
    
    /**
     * Creates an adapter for the provided cache.
     *
     * @param Cache $innerCache
     */
    public function __construct(Cache $innerCache)
    {
        $this->cache = $innerCache;
    }
    
    /**
     * Sets the frontend directives.
     *
     * @param array(string=>mixed) $directives assoc of directives
     */
    public function setDirectives($directives)
    {
        $this->directives = $directives;
    }

    /**
     * Returns the cache item that belongs to the provided ID.
     *
     * Returns false if no such item exists. The $doNotTestCacheValidity
     * is ignored as it i not supported by the inner cache.
     *
     * @param string $id
     * @param boolean $doNotTestCacheValidity
     * @return string|false
     */
    public function load($id, $doNotTestCacheValidity = false)
    {
        return $this->cache->fetch($id);
    }

    /**
     * Checks if a cache item for the provided ID is available.
     *
     * Returns the timestamp of last modification if the cache item exists.
     *
     * @param string $id
     * @return mixed|false
     */
    public function test($id)
    {
        return $this->cache->contains($id);
    }

    /**
     * Stores a cache item.
     *
     * Tags are ignored as they are not supported by the inner cache.
     * Uses the configured lifetime if $specificLifetime is false.
     * Assumes an infinite lifetime if $specificLifetime is null.
     *
     * @param string $data
     * @param string $id
     * @param array(string) $tags
     * @param integer $specificLifetime
     * @return boolean
     */
    public function save($data, $id, $tags = array(), $specificLifetime = false)
    {
        $lifetime = ($specificLifetime === false) ? $this->getDefaultLifetime() : $specificLifetime;
        if ($lifetime === null) {
            // Zend interprets null as infinite lifetime, whereas
            // Doctrine assumes that 0 means infinite lifetime.
            $lifetime = 0;
        }
        return $this->cache->save($id, $data, $lifetime);
    }

    /**
     * Deletes a cache item.
     *
     * @param string $id
     * @return boolean
     */
    public function remove($id)
    {
        return $this->cache->delete($id);
    }

    /**
     * Returns always false as cleanup is not supported by the inner cache.
     *
     * @param string $mode
     * @param array(string) $tags
     * @return boolean
     */
    public function clean($mode = Zend_Cache::CLEANING_MODE_ALL, $tags = array())
    {
        return false;
    }
    
    /**
     * Returns the configured default lifetime.
     *
     * @return integer|null
     */
    protected function getDefaultLifetime()
    {
        return isset($this->directives['lifetime']) ? $this->directives['lifetime'] : null;
    }
    
}
