<?php

/**
 * Mol_DataType_Map
 *
 * @category PHP
 * @package Mol_DataType
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 23.12.2010
 */

/**
 * A hash map implementation that returns a configured standard value
 * if no value is defined for a requested key.
 *
 * Configure a default value:
 *
 *     // Returns 0 per default.
 *     $map = new Mol_DataType_Map(array(), 0);
 *     $map['x'] = 5;
 *     // Prints 5.
 *     echo $map['x'];
 *     // Prints the default value 0.
 *     echo $map['y'];
 *
 * Register a value for multiple keys:
 *
 *     // Registers 42 for the keys a, b and c.
 *     $map->register(42, array('a', 'b', 'c'));
 *
 * @category PHP
 * @package Mol_DataType
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 23.12.2010
 */
class Mol_DataType_Map extends ArrayObject
{
    /**
     * The default value that is returned if no more specific
     * value is available.
     *
     * @var mixed
     */
    protected $defaultValue = null;

    /**
     * Creates a key/value map that is initially filled with the values
     * provided in $initialValues.
     *
     * The parameter $defaultValue defines the value that is returned
     * if a not existing key is accessed.
     *
     * @param array(mixed) $initialValues
     * @param mixed $defaultValue
     */
    public function __construct(array $initialValues = array(), $defaultValue = null)
    {
        $this->defaultValue = $defaultValue;
        parent::__construct($initialValues);
        $this->setFlags(self::ARRAY_AS_PROPS);
    }

    /**
     * See {@link ArrayObject::offsetGet()} for details.
     *
     * @param mixed $index
     * @return mixed
     */
    public function offsetGet($index)
    {
        if (!isset($this[$index])) {
            return $this->defaultValue;
        }
        return parent::offsetGet($index);
    }

    /**
     * Registers $value for one or many keys.
     *
     * Register the value for a single key:
     *
     *     $map->register('value', 'key');
     *
     * Register the value for multiple keys:
     *
     *     $map->register('value', array('key1', 'key2'));
     *
     * @param mixed $value
     * @param array(mixed)|mixed $keys
     */
    public function register($value, $keys)
    {
        if (!is_array($keys)) {
            // Single key provided.
            $keys = array($keys);
        }
        foreach ($keys as $key) {
            $this[$key] = $value;
        }
    }

}

