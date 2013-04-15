<?php

/**
 * Mol_Util_TypeInspector
 *
 * @category PHP
 * @package Mol_Util
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 06.11.2012
 */

/**
 * Helper class that is able to perform type checks.
 *
 * This class operates on class and interface names, objects
 * do not have to be created to perform checks.
 *
 * # Usage #
 *
 * A new type inspector is simply created without any argument:
 *
 *     $inspector = new Mol_Util_TypeInspector();
 *
 * Although there is currently no internal class state, an inspector
 * object must be created to use the class.
 * This is intended, as for example a cache for already checked types
 * might be added in the future. Such a feature should not lead to
 * global attributes later.
 *
 * ## Checking types ##
 *
 * The TypeInspector provides several methods to check types by name.
 *
 * Simple checks test for classes and interfaces:
 *
 *     // Returns true.
 *     $isClass = $inspector->isClass('ArrayObject');
 *     // Returns false.
 *     $isInterface = $inspector->isInterface('ArrayObject');
 *
 * The method isType() can be used if it is not important
 * whether a class or interface name is provided:
 *
 *     $isClassOrInterface = $inspector->isType('ArrayObject');
 *
 * The is() method can be used to perform complex type checks.
 * It checks if a given type fulfills all provided type constraints:
 *
 *     // Returns true, as ArrayObject is Traversable as well as Countable.
 *     $constraintsFulfilled = $inspector->is('ArrayObject', array('Traversable', 'Countable'));
 *     // Returns false, as ArrayObject is Countable, but it is not an instance of SplStack.
 *     $constraintsFulfilled = $inspector->is('ArrayObject', array('Countable', 'SplStack'));
 *
 * For convenience, also a single type constraint can be passed to is().
 * The following checks are equivalent:
 *
 *     $inspector->is('ArrayObject', array('Countable'));
 *     $inspector->is('ArrayObject', 'Countable');
 *
 * ## Asserting type rules ##
 *
 * Besides methods for type checks, there are also methods that can
 * be used to assert certain type conditions.
 *
 * The assertion methods throw an InvalidArgumentException if the
 * requested condition does not hold. Otherwise they will do
 * nothing.
 *
 * There are several assertion methods to apply simple type rules:
 *
 *     // Throws an exception if ArrayObject is not a class.
 *     $inspector->assertClass('ArrayObject');
 *     // Throws an exception if ArrayAccess is not an interface.
 *     $inspector->assertInterface('ArrayAccess');
 *     // Throws an exception if SplStack is neither a class nor an interface.
 *     $inspector->assertType('SplStack');
 *
 * The assertTypes() method can be used to check a list of types at once:
 *
 *     // Throws an exception if any of the entries is neither class nor interface.
 *     $inspector->assertTypes(array('ArrayObject', 'ArrayAccess', 'SplStack'));
 *
 * Like is(), assertFulfills() can be used to check complex type rules:
 *
 *     // Throws an exception if ArrayObject does not fulfill all of the
 *     // provided type constraints.
 *     $this->assertFulfills('ArrayObject', array('Countable', 'Traversable'));
 *
 * @category PHP
 * @package Mol_Util
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 06.11.2012
 */
class Mol_Util_TypeInspector
{
    
    /**
     * Checks if $name is fulfills all of the given type constraints.
     *
     * A single type can be provided as second argument:
     *
     *     // Checks if ArrayObject is of type Countable
     *     $result = $inspector->is('ArrayObject', 'Countable');
     *
     * It is also possible to check multiple constraints at once:
     *
     *     // Checks if ArrayObject is of type Traversable *and* Countable
     *     $result = $inspector->is('ArrayObject', array('Traversable', 'Countable'));
     *
     * @param string $name The name of the type.
     * @param string|array(string) $typeOrListOfTypes
     * @return boolean True if $name fulfills all type constraints, false otherwise.
     * @throws InvalidArgumentException If $name is not a string or if invalid types are provided.
     */
    public function is($name, $typeOrListOfTypes)
    {
        $this->assertString($name);
        $listOfTypes = is_array($typeOrListOfTypes) ? $typeOrListOfTypes : array($typeOrListOfTypes);
        $this->assertTypes($listOfTypes);
        if (!$this->isType($name)) {
            return false;
        }
        return $this->fulfillsConstraints(new ReflectionClass($name), $listOfTypes);
    }
    
    /**
     * Checks if $name is a type.
     *
     * Classes and interfaces are recognized as types.
     *
     * @param string $name The name of the type.
     * @return boolean True if $name is a type, false otherwise.
     * @throws InvalidArgumentException If $name is not a string.
     */
    public function isType($name)
    {
        return $this->isClass($name) || $this->isInterface($name);
    }
    
    /**
     * Checks if $name is a class.
     *
     * @param string $name The class name.
     * @return boolean True if $name is a class, false otherwise.
     * @throws InvalidArgumentException If $name is not a string.
     */
    public function isClass($name)
    {
        $this->assertString($name);
        return class_exists($name, true);
    }
    
    /**
     * Checks if $name is an interface.
     *
     * @param string $name The interface name.
     * @return boolean True if $name is an interface, false otherwise.
     * @throws InvalidArgumentException If $name is not a string.
     */
    public function isInterface($name)
    {
        $this->assertString($name);
        return interface_exists($name, true);
    }
    
    /**
     * Asserts that the given type fulfills all provided type constraints.
     *
     * @param string|mixed $name A type name.
     * @param array(string|mixed) $typeConstraints List of type constraints.
     * @throws InvalidArgumentException If at least one constraint is not fulfilled.
     */
    public function assertFulfills($name, array $typeConstraints)
    {
        if ($this->is($name, $typeConstraints)) {
            return;
        }
        $format      = '%s does not fulfill all of the following type constraints: %s';
        $constraints = Mol_Util_Stringifier::stringify($typeConstraints);
        $message     = sprintf($format, Mol_Util_Stringifier::stringify($name), $constraints);
        throw new InvalidArgumentException($message);
    }
    
    /**
     * Asserts that all items in the given list are valid type names.
     *
     * @param array(string|mixed) $types
     * @throws InvalidArgumentException If at least one entry is not a valid type.
     */
    public function assertTypes(array $types)
    {
        $validTypes = array_filter($types, array($this, 'isType'));
        if (count($validTypes) === count($types)) {
            // All types in the given list are valid.
            return;
        }
        $invalidTypes = array_diff($types, $validTypes);
        $message      = 'The following entries are no type names: ' . Mol_Util_Stringifier::stringify($invalidTypes);
        throw new InvalidArgumentException($message);
    }
    
    /**
     * Asserts that $name is a valid type (class or interface).
     *
     * @param string|mixed $name
     * @throws InvalidArgumentException If $name is not a valid type.
     */
    public function assertType($name)
    {
        if ($this->isType($name)) {
            return;
        }
        $message = Mol_Util_Stringifier::stringify($name) . ' is not a valid type (class or interface) name.';
        throw new InvalidArgumentException($message);
    }
    
    /**
     * Asserts that a class with the provided name exists.
     *
     * @param string|mixed $name
     * @throws InvalidArgumentException If $name is not a valid class.
     */
    public function assertClass($name)
    {
        if ($this->isClass($name)) {
            return;
        }
        $message = Mol_Util_Stringifier::stringify($name) . ' is not a valid class name.';
        throw new InvalidArgumentException($message);
    }
    
    /**
     * Asserts that an interface with the provided name exists.
     *
     * @param string|mixed $name
     * @throws InvalidArgumentException If $name is not a valid interface.
     */
    public function assertInterface($name)
    {
        if ($this->isInterface($name)) {
            return;
        }
        $message = Mol_Util_Stringifier::stringify($name) . ' is not a valid interface name.';
        throw new InvalidArgumentException($message);
    }
    
    /**
     * Checks if the provided type fulfills all given type constraints.
     *
     * @param ReflectionClass $type
     * @param array(string) $constraints The type constraints.
     * @return boolean True if all constraints are fulfilled, false otherwise.
     */
    protected function fulfillsConstraints(ReflectionClass $type, array $constraints)
    {
        foreach ($constraints as $constraint) {
            /* @var string $constraint */
            if (!$this->fulfillsConstraint($type, $constraint)) {
                return false;
            }
        }
        // Type requirements fulfilled.
        return true;
    }
    
    /**
     * Checks if the provided type fulfills the given type constraint.
     *
     * @param ReflectionClass $type
     * @param string $constraint The type constraint.
     * @return boolean True if the constraint is fulfilled, false otherwise.
     */
    protected function fulfillsConstraint(ReflectionClass $type, $constraint)
    {
        if ($this->isInterface($constraint) && $type->implementsInterface($constraint)) {
            // Type implements the required interface.
            return true;
        }
        if ($type->isSubclassOf($constraint)) {
            // Type is a subclass of the required type.
            return true;
        }
        if ($type->getName() === $constraint) {
            // Type equals required type.
            return true;
        }
        return false;
    }
    
    /**
     * Asserts that the given value is a string.
     *
     * @param mixed $value
     * @throws InvalidArgumentException If $value is not a string.
     */
    protected function assertString($value)
    {
        if (is_string($value)) {
            return;
        }
        $format  = 'String expected, but received: %s';
        $message = sprintf($format, Mol_Util_Stringifier::stringify($value));
        throw new InvalidArgumentException($message);
    }
    
}
