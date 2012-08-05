<?php

/**
 * Mol_Util_ObjectBuilder
 *
 * @category PHP
 * @package Mol_Util
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 05.08.2012
 */

/**
 * Creates instances of other classes.
 *
 * Optionally enforces a provided type constraint *before* creating
 * an object.
 * That is especially useful if the object class was provided by configuration
 * and a common base class or interface is required.
 *
 * @category PHP
 * @package Mol_Util
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 05.08.2012
 */
class Mol_Util_ObjectBuilder
{
    
    /**
     * Creates a new object builder.
     *
     * If a type contraint is provided then the builder
     * will only create objects from classes of that type.
     * If a requested instance does not meet the type
     * requirement then an exception will be thrown.
     *
     * @param string|null $typeConstraint
     * @throws InvalidArgumentException If provided type is not a class or interface.
     */
    public function __construct($typeConstraint = null)
    {
        
    }
    
    /**
     * Creates an instance of the provided class.
     *
     * @param string $class That class that should be instantiated.
     * @param array(mixed) $constructorArguments Constructor arguments for creation.
     * @throws InvalidArgumentException If the provided class does not meet the type requirements.
     */
    public function create($class, array $constructorArguments = array())
    {
        
    }
    
}
