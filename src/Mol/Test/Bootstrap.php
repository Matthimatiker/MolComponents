<?php

/**
 * Mol_Test_Bootstrap
 *
 * @category PHP
 * @package Mol_Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 05.07.2012
 */

/**
 * A bootstrapper that supports simulation of resources and is used for testing.
 *
 * # Usage #
 *
 * The static create() method may be used to instantiate a new bootstrapper:
 *
 *     $bootstrapper = Mol_Test_Bootstrap::create();
 *
 * This helper method automatically creates an Zend_Application object
 * that is required as constructor argument for bootstrappers.
 *
 * The method simulateResource() is used to simulated arbitrary resources:
 *
 *     $bootstrapper->simulateResource('view', new Zend_View());
 *
 * After resource injection the usual boostrapper methods may be used
 * to retrieve the simulated values:
 *
 *     $view = $bootstrapper->getResource('view');
 *
 * @category PHP
 * @package Mol_Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 05.07.2012
 */
class Mol_Test_Bootstrap extends Zend_Application_Bootstrap_BootstrapAbstract
{
    
    /**
     * Creates a pre-configured boostrapper.
     *
     * @return Mol_Test_Bootstrap
     */
    public static function create()
    {
        $application = new Zend_Application('testing', array());
        return new self($application);
    }
    
    /**
     * Creates the bootstrapper.
     *
     * @param Zend_Application|Zend_Application_Bootstrap_Bootstrapper $application
     */
    public function __construct($application)
    {
        parent::__construct($application);
        // Uses a simple container that is not global.
        $this->setContainer(new stdClass());
    }
    
    /**
     * Simulates the resource with the provided name.
     *
     * The bootstrapper will behave as if the resource was already initialized.
     *
     * @param string $name The name of the resource.
     * @param mixed $result The result of the resource that  will be stored in the container.
     * @return Mol_Test_Bootstrap Provides a fluent interface.
     */
    public function simulateResource($name, $result = null)
    {
        $name = strtolower($name);
        $this->_markRun($name);
        $this->getContainer()->{$name} = $result;
        return $this;
    }
    
    /**
     * Run method as required by the interface.
     *
     * Simply does nothing.
     */
    public function run()
    {
    }
    
}
