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
        
    }
    
}
