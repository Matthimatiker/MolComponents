<?php

/**
 * Mol_Application_Bootstrap_LazyLoader
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 15.07.2012
 */

/**
 * Class that uses a callback to lazy load resources.
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 15.07.2012
 */
class Mol_Application_Bootstrap_LazyLoader
{
    
    /**
     * Creates a lazy loader.
     *
     * @param mixed $callback A callback.
     * @throws InvalidArgumentException If the callback is not valid.
     */
    public function __construct($callback)
    {
        
    }
    
    /**
     * Uses the callback to load the resource.
     *
     * @return mixed
     */
    public function load()
    {
        
    }
    
}
