<?php

/**
 * Mol_Application_Bootstrap_LazyLoad_ResourceDecorator
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
 * An application resource decorator that delays initialization by using
 * a LazyLoader instance.
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 15.07.2012
 */
class Mol_Application_Bootstrap_LazyLoad_ResourceDecorator implements Zend_Application_Resource_Resource
{
    
    /**
     * The decorated resource.
     *
     * @var Zend_Application_Resource_Resource
     */
    protected $innerResource = null;
    
    /**
     * Decorates the provided resource.
     *
     * @param Zend_Application_Resource_Resource $resource
     * @throws InvalidArgumentException If no resource was provided.
     */
    public function __construct($resource = null)
    {
        if (!($resource instanceof Zend_Application_Resource_Resource)) {
            $message = 'Instance of Zend_Application_Resource_Resource expected.';
            throw new InvalidArgumentException($message);
        }
        $this->innerResource = $resource;
    }
    
    /**
     * Forwards the bootstrapper to the inner resource.
     *
     * @param Zend_Application_Bootstrap_Bootstrapper $bootstrap
     * @return Zend_Application_Resource_Resource Provides a fluent interface.
     */
    public function setBootstrap(Zend_Application_Bootstrap_Bootstrapper $bootstrap)
    {
        $this->innerResource->setBootstrap($bootstrap);
        return $this;
    }
    
    /**
     * Retrieves the bootstrapper from the inner resource.
     *
     * @return Zend_Application_Bootstrap_Bootstrapper
     */
    public function getBootstrap()
    {
        return $this->innerResource->getBootstrap();
    }
    
    /**
     * Forwards options to the inner resource.
     *
     * @param array(string|integer=>mixed) $options
     * @return Zend_Application_Resource_Resource Provides a fluent interface.
     */
    public function setOptions(array $options)
    {
        $this->innerResource->setOptions($options);
        return $this;
    }
    
    /**
     * Returns the options of the inner resource.
     *
     * @return array(string|integer=>mixed)
     */
    public function getOptions()
    {
        return $this->innerResource->getOptions();
    }
    
    /**
     * Creates a lazy loader that is used to initialize the
     * inner resource later.
     *
     * Creates a new loader on each call to honor that the init() method of
     * the inner resource would usually be called multiple times too.
     *
     * @return Mol_Application_Bootstrap_LazyLoader
     */
    public function init()
    {
        return new Mol_Application_Bootstrap_LazyLoader(array($this->innerResource, 'init'));
    }
    
}
