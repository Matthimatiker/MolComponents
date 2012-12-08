<?php

/**
 * Mol_Application_Bootstrap_Injector
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 14.10.2012
 */

/**
 * Helper class that is able to inject a bootstrapper into
 * bootstrap aware objects.
 *
 * # Usage #
 *
 * Create an injector:
 * <code>
 * $injector = new Mol_Application_Bootstrap_Injector($myBootstrapper);
 * </code>
 *
 * Inject the bootstrapper into an object:
 * <code>
 * $injector->inject($object);
 * </code>
 * If the given value is not bootstrap aware, then the injector
 * will just ignore it.
 *
 * The injector will also ignore non-objects:
 * <code>
 * $value = $injector->inject(null);
 * </code>
 * The method inject() returns the provided value afterwards.
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 14.10.2012
 */
class Mol_Application_Bootstrap_Injector
{
    
    /**
     * The bootstrapper that will be injected.
     *
     * @var Zend_Application_Bootstrap_BootstrapAbstract
     */
    protected $bootstrapper = null;
    
    /**
     * Creates an injector.
     *
     * Requires the bootstrapper that will be injected as an argument.
     *
     * @param Zend_Application_Bootstrap_BootstrapAbstract $bootstrapper
     */
    public function __construct(Zend_Application_Bootstrap_BootstrapAbstract $bootstrapper)
    {
        $this->bootstrapper = $bootstrapper;
    }
    
    /**
     * Tries to inject the bootstrapper into the given object.
     *
     * If the given object does not implement Mol_Application_Bootstrap_Aware,
     * then the injector will do nothing. Otherwise the bootstrapper will be
     * injected.
     *
     * The inject() method always returns the object that was provided as value.
     *
     * Examples:
     * <code>
     * // Does not try to inject and returns the object:
     * $object = $injector->inject(new stdClass());
     *
     * // Does not try to inject and returns the provided value.
     * $value = $injector->inject(null);
     *
     * // $bootstrapAwareObject implements Mol_Application_Bootstrap_Aware,
     * // therefore the injector calls setBootstrap() to inject the
     * // bootstrapper and returns the object.
     * $object = $injector->inject($bootstrapAwareObject);
     * </code>
     *
     * @param Mol_Application_Bootstrap_Aware|mixed $object
     * @return Mol_Application_Bootstrap_Aware|mixed The provided object.
     */
    public function inject($object)
    {
        if ($object instanceof Mol_Application_Bootstrap_Aware) {
            $object->setBootstrap($this->bootstrapper);
        }
        return $object;
    }
    
}
