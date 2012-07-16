<?php

/**
 * Mol_Application_Bootstrap
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 14.07.2012
 */

/**
 * Bootstrapper that adds support for lazy loading.
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 14.07.2012
 */
class Mol_Application_Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    
    
    /**
     * Loads the resource and store it in the $_pluginResources attribute.
     *
     * Ensures that the resource will be lazy loaded if the lazyLoad option
     * evaluates to true.
     *
     * @param string $resource
     * @param array|object|null $options The resource options.
     * @return string|false The name of the resource or false if it was not found.
     */
    protected function _loadPluginResource($resource, $options)
    {
        
    }
    
    /**
     * Returns the requested resource and applies lazy
     * loading if necessary.
     *
     * @param string $name
     * @return mixed|null
     */
    public function getResource($name)
    {
    
    }
    
}
