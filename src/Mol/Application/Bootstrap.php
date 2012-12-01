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
 * == Usage ==
 *
 * == Bootstrapper configuration ==
 *
 * Use this bootstrapper as base class for your own bootstrap class:
 * <code>
 * class My_Bootstrap extends Mol_Application_Bootstrap
 * {
 * }
 * </code>
 *
 * Add the bootstrap configuration to your application.ini to
 * ensure that the bootstrapper is used:
 * <code>
 * bootstrap.path  = APPLICATION_PATH "/Bootstrap.php"
 * bootstrap.class = "My_Bootstrap"
 * </code>
 *
 *
 * == Lazy loading configuration ==
 *
 * Now it is possible to activate lazy loading for any configured
 * resource by setting the lazyLoad option:
 * <code>
 * resources.log.stream.writerName          = "Stream"
 * resources.log.stream.writerParams.stream = APPLICATION_PATH "/storage/logs/application.log"
 * resources.log.stream.writerParams.mode   = "a"
 * resources.log.lazyLoad                   = On
 * </code>
 *
 * To load a resource the getResource() method of the bootstrapper is used as usual.
 * The following code retrieves the lazy loaded logger in context of an action
 * controller:
 * <code>
 * $bootstrap = $this->getInvokeArg('bootstrap');
 * $logger = $bootstrap->getResource('log');
 * </code>
 *
 * Keep in mind that some resources must be executed early as they modify
 * the global state of the application and will not be retrieved explicitely
 * via getResource().
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
        if ($this->isLazyLoader($result)) {
            // The resource uses lazy loading. As the resource
            // is requested now we have to load it finally.
            // The LazyLoader ensures that the resource is executed
            // only once, even if getResource() is called multiple
            // times.
            /* @var $result Mol_Application_Bootstrap_LazyLoader */
            return $result->load();
        }
        return $result;
    }
    
    /**
     * Checks if the provided value is a lazy loader.
     *
     * @param Mol_Application_Bootstrap_LazyLoader|mixed $value
     * @return boolean True if $value is a lazy loader, false otherwise.
     */
    protected function isLazyLoader($value)
    {
        return ($value instanceof Mol_Application_Bootstrap_LazyLoader);
    }
    
}
