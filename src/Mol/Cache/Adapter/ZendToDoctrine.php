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

use Doctrine\Common\Cache;

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
class Mol_Cache_Adapter_ZendToDoctrine
{
    
    /**
     * Creates an adapter for the given Zend cache.
     *
     * @param Zend_Cache_Backend_Interface $cache
     */
    public function __construct(Zend_Cache_Backend_Interface $cache)
    {
        
    }
    
    /**
     * Returns the inner Zend cache.
     *
     * @return Zend_Cache_Backend_Interface
     */
    public function getInnerCache()
    {
        
    }
    
}
