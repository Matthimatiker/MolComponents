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
 * = Usage =
 *
 * == Creating a builder ==
 *
 * The most simple builder can be created without any constructor argument:
 * <code>
 * $builder = new Mol_Util_ObjectBuilder();
 * </code>
 * This builder does not enforce any type when creating objects.
 *
 * Optionally a type constraint can be passed:
 * <code>
 * $builder = new Mol_Util_ObjectBuilder('Countable');
 * </code>
 * This builder checks the type constraint *before* creating an object and
 * rejects instantiation requests for classes that do not fulfill the
 * type requirement.
 * That is especially useful if the object class was provided by configuration
 * and a common base class or interface is required.
 *
 * It is even possible to provide multiple type constraints:
 * <code>
 * $builder = new Mol_Util_ObjectBuilder(array('Traversable', 'Countable'));
 * </code>
 * In this case the builder will only instantiate classes that fulfill
 * *all* of the given type constraints.
 *
 * == Building objects ==
 *
 * The create() method is used to instantiate objects of a given class:
 * <code>
 * $array = $builder->create('SplFixedArray');
 * </code>
 *
 * Constructor arguments can be passed as second argument:
 * <code>
 * $array = $builder->create('SplFixedArray', array(100));
 * </code>
 *
 * Object creation will fail with an InvalidArgumentException
 * if the type constraints are not fulfilled:
 * <code>
 * $builder = new Mol_Util_ObjectBuilder('ArrayObject');
 * // This creation will fail:
 * $array = $builder->create('SplFixedArray', array(100));
 * </code>
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
     * Types that are required for created instances.
     *
     * A type constraint is the name of a class or interface.
     * Contains a list of all required types.
     *
     * @var array(string)
     */
    protected $typeConstraints = null;
    
    /**
     * Helper object that is used to check the type constraints.
     *
     * @var Mol_Util_TypeInspector|null
     */
    protected $typeInspector = null;
    
    /**
     * Creates a new object builder.
     *
     * If a type contraint is provided, then the builder will only create
     * objects from classes of that type.
     * If a requested instance does not meet the type requirements, then
     * an exception will be thrown.
     *
     * @param string|array(string)|null $typeConstraints A single type or a list of required types.
     * @throws InvalidArgumentException If provided type constraint is not valid.
     */
    public function __construct($typeConstraints = array())
    {
        $typeConstraints     = $this->toList($typeConstraints);
        $this->typeInspector = new Mol_Util_TypeInspector();
        $this->typeInspector->assertTypes($typeConstraints);
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
        if (!$this->isClass($class)) {
            $message = 'Valid class name expected. Received: ' . Mol_Util_Stringifier::stringify($class);
            throw new InvalidArgumentException($message);
        }
        if (!$this->fulfillsTypeConstraints($class)) {
            $format  = 'Class %s does not fulfill all type constraints: %s';
            $message = sprintf($format, $class, Mol_Util_Stringifier::stringify($this->typeConstraints));
            throw new InvalidArgumentException($message);
        }
        return $this->createInstance(new ReflectionClass($class), $constructorArguments);
    }
    
    /**
     * Converts the given value into a list of items.
     *
     * @param string|array(mixed)|null $value
     * @return array(mixed)
     */
    protected function toList($value)
    {
        if ($value === null) {
            return array();
        }
        if (is_array($value)) {
            // List provided.
            return $value;
        }
        // Single item provided.
        return array($value);
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
     * @param string $class
     * @return boolean True if all type requirements are fulfilled, false otherwise.
     */
    protected function fulfillsTypeConstraints($class)
    {
        return $this->typeInspector->is($class, $this->typeConstraints);
    }
    
    /**
     * Checks if $name is a valid type (class or interface).
     *
     * @param string $name
     * @return boolean True if $name is a type, false otherwise.
     */
    protected function isType($name)
    {
        return $this->typeInspector->isType($name);
    }
    
    /**
     * Checks if the provided value is a valid class name.
     *
     * @param string $name
     * @return boolean True if $name is a class, false otherwise.
     */
    protected function isClass($name)
    {
        return $this->typeInspector->isClass($name);
    }
    
    /**
     * Checks if the provided value is a valid interface name.
     *
     * @param string $name
     * @return boolean True if $name is an interface, false otherwise.
     */
    protected function isInterface($name)
    {
        return $this->typeInspector->isInterface($name);
    }
    
}
