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
 * Optionally enforces provided type constraints *before* creating
 * an object.
 * That is especially useful if the object class was provided by configuration
 * and a common base class or interface is required.
 * It is also possible to require multiple interfaces to be implemented.
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
     * Type that is required for created instances.
     *
     * A type constraint is the name of a class or interface.
     * Contains null if no type is required.
     *
     * @var string|null
     */
    protected $typeConstraints = null;
    
    /**
     * Creates a new object builder.
     *
     * If a type contraint is provided then the builder
     * will only create objects from classes of that type.
     * If a requested instance does not meet the type
     * requirement then an exception will be thrown.
     *
     * @param string|array(string)|null $typeConstraints
     * @throws InvalidArgumentException If provided type is not a class or interface.
     */
    public function __construct($typeConstraints = null)
    {
        if ($typeConstraints !== null && !$this->isType($typeConstraints)) {
            $message = 'Type constraint must be a class or interface name.';
            throw new InvalidArgumentException($message);
        }
        $this->typeConstraints = $typeConstraints;
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
        $reflection = $this->toReflectionClass($class);
        if (!$this->fulfillsTypeConstraint($reflection)) {
            $format  = 'Class %s is not of required type %s.';
            $message = sprintf($format, $reflection->getName(), $this->typeConstraints);
            throw new InvalidArgumentException($message);
        }
        return $this->createInstance($reflection, $constructorArguments);
    }
    
    /**
     * Creates a reflection object for the provided class.
     *
     * @param string $name The name of the class.
     * @return ReflectionClass
     * @throws InvalidArgumentException If no valid class name is provided.
     */
    protected function toReflectionClass($name)
    {
        if (!$this->isClass($name)) {
            $message = 'Valid class name expected. Received: "' . $name . '"';
            throw new InvalidArgumentException($message);
        }
        return new ReflectionClass($name);
    }
    
    /**
     * Uses the provided constructor arguments to create a new instance
     * of the given class type.
     *
     * @param ReflectionClass $class
     * @param array(mixed) $constructorArguments
     * @return object An instance of the requested class.
     * @throws BadMethodCallException If constructor arguments are missing.
     */
    protected function createInstance(ReflectionClass $class, array $constructorArguments)
    {
        if (!$class->isInstantiable()) {
            $message = 'Class ' . $class->getName() . ' is not instantiable.';
            throw new BadMethodCallException($message);
        }
        /* @var $constructor ReflectionMethod|null */
        $constructor = $class->getConstructor();
        if ($constructor !== null && $constructor->getNumberOfRequiredParameters() > count($constructorArguments)) {
            $format            = '%s requires at least %s parameters for construction, but only %s were provided.';
            $requiredArguments = $constructor->getNumberOfRequiredParameters();
            $message           = sprintf($format, $class->getName(), $requiredArguments, count($constructorArguments));
            throw new BadMethodCallException($message);
        }
        return $class->newInstanceArgs($constructorArguments);
    }
    
    /**
     * Checks if the provided class fulfills the type requirements.
     *
     * @param ReflectionClass $class
     * @return boolean True if the requirements are fulfilled, false otherwise.
     */
    protected function fulfillsTypeConstraint(ReflectionClass $class)
    {
        if ($this->typeConstraints === null) {
            // No requirements available.
            return true;
        }
        if ($this->isInterface($this->typeConstraints) && $class->implementsInterface($this->typeConstraints)) {
            // Class implements the required interface.
            return true;
        }
        if ($class->isSubclassOf($this->typeConstraints)) {
            // Class is a subclass of the required type.
            return true;
        }
        if ($class->getName() === $this->typeConstraints) {
            // Class equals required type.
            return true;
        }
        // Type requirements not fulfilled.
        return false;
    }
    
    /**
     * Checks if $name is a valid type (class or interface).
     *
     * @param string $name
     * @return boolean True if $name is a type, false otherwise.
     */
    protected function isType($name)
    {
        return $this->isClass($name) || $this->isInterface($name);
    }
    
    /**
     * Checks if the provided value is a valid class name.
     *
     * @param string $name
     * @return boolean True if $name is a class, false otherwise.
     */
    protected function isClass($name)
    {
        return class_exists($name, true);
    }
    
    /**
     * Checks if the provided value is a valid interface name.
     *
     * @param string $name
     * @return boolean True if $name is an interface, false otherwise.
     */
    protected function isInterface($name)
    {
        return interface_exists($name, true);
    }
    
}
