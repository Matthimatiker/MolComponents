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
     * <code>
     * // Checks if ArrayObject is of type Countable
     * $result = $inspector->is('ArrayObject', 'Countable');
     * </code>
     *
     * It is also possible to check multiple constraints at once:
     * <code>
     * // Checks if ArrayObject is of type Travaersable *and* Countable
     * $result = $inspector->is('ArrayObject', array('Traversable', 'Countable'));
     * </code>
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
        $this->assertContainsOnlyTypes($listOfTypes);
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
     * @return boolean True if $name is a class, false othwerwise.
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
     * @return boolean True if $name is an interface, false othwerwise.
     * @throws InvalidArgumentException If $name is not a string.
     */
    public function isInterface($name)
    {
        $this->assertString($name);
        return interface_exists($name, true);
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
        $format  = 'String expected, bt received: %s';
        $message = sprintf($format, Mol_Util_Stringifier::stringify($value));
        throw new InvalidArgumentException($message);
    }
    
    /**
     * Asserts that the given list contains only type names.
     *
     * @param array(string) $listOfTypes
     * @throws InvalidArgumentException If one of the items is not a type.
     */
    protected function assertContainsOnlyTypes(array $listOfTypes)
    {
        $validTypes = array_filter($listOfTypes, array($this, 'isType'));
        if (count($validTypes) === count($listOfTypes)) {
            // All types in the given list are valid.
            return;
        }
        $invalidTypes = array_diff($listOfTypes, $validTypes);
        $message      = 'The following types are not valid: ' . Mol_Util_Stringifier::stringify($invalidTypes);
        throw new InvalidArgumentException($message);
    }
    
}
