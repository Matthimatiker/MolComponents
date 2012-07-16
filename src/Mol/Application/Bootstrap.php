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
        $options  = (array)$options;
        $lazyLoad = false;
        if (isset($options['lazyLoad'])) {
            $lazyLoad = $options['lazyLoad'];
            // Do not pass the lazyLoad option to the resource
            // to be as transparent as possible.
            unset($options['lazyLoad']);
        }
        $name = parent::_loadPluginResource($resource, $options);
        if ($name === false) {
            // Resource was not found.
            return false;
        }
        if ($lazyLoad) {
            $this->forceLazyLoad($name);
        }
        return $name;
    }
    
    /**
     * Enforces lazy loading of the resource with the provided name.
     *
     * @param string $resource The name of the resource.
     */
    protected function forceLazyLoad($resource)
    {
        /* @var $loadedPlugin Zend_Application_Resource_Resource */
        $loadedPlugin = $this->_pluginResources[$resource];
        // Wrap the plugin into a decorator that ensures that calls to init() do not
        // immediately execute the original plugin.
        $this->_pluginResources[$resource] = new Mol_Application_Bootstrap_LazyLoad_ResourceDecorator($loadedPlugin);
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
        $result = parent::getResource($name);
        if ($result instanceof Mol_Application_Bootstrap_LazyLoader) {
            // The resource uses lazy loading. As the resource
            // is requested now we have to load it finally.
            // The LazyLoader ensures that the resource is executed
            // only once, even if getResource() is called multiple
            // times.
            return $result->load();
        }
        return $result;
    }
    
}
