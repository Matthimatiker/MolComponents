<?php

/**
 * Mol_Test_Bootstrap_Mock
 *
 * @category PHP
 * @package Mol_Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.01.2011
 */

/**
 * Class that may be used to mock bootstrappers.
 *
 * It does not implement the extensive bootstrapper interfaces, but it supports
 * the most important methods that are used by controllers to load resources
 * and options.
 *
 * @category PHP
 * @package Mol_Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.01.2011
 */
class Mol_Test_Bootstrap_Mock
{
    /**
     * The simulated resources.
     *
     * @var Mol_Option_List
     */
    protected $resources = null;

    /**
     * The simulated options.
     *
     * @var Mol_Option_List
     */
    protected $options = null;

    /**
     * Creates a mock bootstrapper.
     *
     * The arguments are used to simulate resources and options.
     *
     * @param array(string=>mixed) $resources
     * @param array(string=>mixed) $options
     */
    public function __construct(array $resources = array(), array $options = array() )
    {
        $this->resources = new Mol_Option_List(array_change_key_case($resources, CASE_LOWER));
        $this->options   = new Mol_Option_List(array_change_key_case($options, CASE_LOWER));
    }

    /**
     * See {@link Zend_Application_Bootstrap_BootstrapAbstract::hasResource()} for details.
     *
     * @param string $name
     * @return boolean
     */
    public function hasResource($name )
    {
        return $this->resources->has($this->normalize($name));
    }

    /**
     * See {@link Zend_Application_Bootstrap_BootstrapAbstract::getResource()} for details.
     *
     * @param string $name
     * @return mixed|null
     */
    public function getResource($name )
    {
        return $this->resources->get($this->normalize($name));
    }

    /**
     * See {@link Zend_Application_Bootstrap_BootstrapAbstract::hasOption()} for details.
     *
     * @param string $name
     * @return boolean
     */
    public function hasOption($name )
    {
        return $this->options->has($this->normalize($name));
    }

    /**
     * See {@link Zend_Application_Bootstrap_BootstrapAbstract::getOption()} for details.
     *
     * @param string $name
     * @return mixed|null
     */
    public function getOption($name )
    {
        return $this->options->get($this->normalize($name));
    }

    /**
     * Normalizes the name of the resource or option like the original
     * bootstrapper does.
     *
     * @param string $name
     * @return string
     */
    protected function normalize($name )
    {
        return strtolower($name);
    }

}

