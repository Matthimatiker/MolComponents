<?php

/**
 * Mol_Cache_Adapter_Doctrine2ToZend
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
 * # Usage #
 *
 * To create an adapter it is enough to pass the inner Doctrine 2 cache instance
 * to the constructor:
 *
 *     use Doctrine\Common\Cache\ArrayCache;
 *
 *     $adapter = new Mol_Cache_Adapter_Doctrine2ToZend(new ArrayCache());
 *
 * The adapter can be used wherever a Zend cache backend (``Zend_Cache_Backend_Interface``)
 * is required.
 *
 * Please note that the adapter is *not* compatible to the extended cache backend interface
 * (``Zend_Cache_Backend_ExtendedInterface``) as the required operations are not supported
 * by the inner Doctrine 2 cache.
 *
 * @category PHP
 * @package Mol_Cache
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.04.2013
 */
class Mol_Cache_Adapter_Doctrine2ToZend implements Zend_Cache_Backend_Interface
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
     * @param \Doctrine\Common\Cache\Cache|array(string=>mixed) $cacheOrOptions
     */
    public function __construct($cacheOrOptions)
    {
        $this->cache = $cacheOrOptions;
    }
    
    /**
     * Returns the inner cache instance.
     *
     * This method is useful to change the configuration of
     * the inner cache after construction.
     *
     * @return \Doctrine\Common\Cache\Cache
     */
    public function getInnerCache()
    {
        return $this->cache;
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
        $item = $this->loadItem($id);
        if ($item === false) {
            return false;
        }
        return $item->data;
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
        $item = $this->loadItem($id);
        if ($item === false) {
            return false;
        }
        return $item->modified;
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
        return $this->cache->save($id, $this->encodeItem($this->toItem($data)), $lifetime);
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
     * Converts the cache data into a cache item with
     * additional metadata.
     *
     * @param string $data
     * @return stdClass
     */
    protected function toItem($data)
    {
        $item = new stdClass();
        $item->data     = $data;
        $item->modified = time();
        return $item;
    }
    
    /**
     * Returns a decoded cache item or false if the requested
     * item does not exist.
     *
     * A cache item contains the cached payload as well as metadata.
     *
     * An item offers the following properties:
     *
     * * data     (string)  - The cached payload.
     * * modified (integer) - Timestamp when the item was stored.
     *
     * @param string $id
     * @return stdClass|false
     */
    protected function loadItem($id)
    {
        $encodedItem = $this->cache->fetch($id);
        if ($encodedItem === false) {
            return false;
        }
        return $this->decodeItem($encodedItem);
    }
    
    /**
     * Converts the given cache item into a string.
     *
     * @param stdClass $item
     * @return string
     */
    protected function encodeItem(stdClass $item)
    {
        return json_encode($item);
    }
    
    /**
     * Restores the original cache item from the encoded value.
     *
     * @param string $encodedItem
     * @return stdClass
     */
    protected function decodeItem($encodedItem)
    {
        return json_decode($encodedItem);
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
