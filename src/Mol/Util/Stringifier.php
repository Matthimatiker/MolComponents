<?php

/**
 * Mol_Util_Stringifier
 *
 * @category PHP
 * @package Mol_Util
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 31.10.2012
 */

/**
 * Class that converts data into simple strings.
 *
 * This class does *not* serialize data, the generated strings
 * are just meant for output.
 *
 * @category PHP
 * @package Mol_Util
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 31.10.2012
 */
class Mol_Util_Stringifier
{
    
    /**
     * Stringifies the given value.
     *
     * @param array(mixed)|object|string|integer|double|boolean|null|resource $value
     * @return string
     */
    public static function stringify($value)
    {
        if ($value === null) {
            return 'null';
        }
        if (is_string($value)) {
            return '"' . $value . '"';
        }
        if (is_bool($value)) {
            return ($value) ? 'true' : 'false';
        }
        if (is_object($value)) {
            return get_class($value);
        }
        if (is_resource($value)) {
            return self::stringifyResource($value);
        }
        if (is_array($value)) {
            return self::stringifyArray($value);
        }
        // It is a simple type that can be rendered directly.
        return $value;
    }
    
    /**
     * Creates a string representation of the given resource.
     *
     * @param resource $resource
     * @return string
     */
    protected static function stringifyResource($resource)
    {
        $type = get_resource_type($resource);
        if ($type === 'stream') {
            $metaData = stream_get_meta_data($resource);
            $type = $metaData['stream_type'] . ' ' . $type . ' (' . $metaData['uri'] . ')';
        }
        return $type;
    }
    
    /**
     * Creates a string representation of the given array.
     *
     * Distinguishes between numerical and associative arrays.
     *
     * @param array(mixed) $array
     * @return string
     */
    protected static function stringifyArray(array $array)
    {
        if (self::isNumericalIndexed($array)) {
            $values = array_map(array(__CLASS__, 'stringify'), array_values($array));
            return '[' . implode(', ', $values) . ']';
        }
        $stringifiedItems = array();
        foreach ($array as $key => $value) {
            $stringifiedItems[] = self::stringify($key) . ': ' . self::stringify($value);
        }
        return '{' . implode(', ', $stringifiedItems) . '}';
    }
    
    /**
     * Checks if the given array is numerical indexed.
     *
     * Keys of numerical arrays are starting at 0 and they are
     * increasing in steps of 1.
     *
     * @param array(mixed) $array
     * @return boolean True if the array is numerical indexed, false otherwise.
     */
    protected static function isNumericalIndexed(array $array)
    {
        $numberOfElements = count($array);
        $keys = array_keys($array);
        // Calculate a checksum and check if the keys
        // sum up correctly.
        return array_sum($keys) == (($numberOfElements - 1) / 2.0) * $numberOfElements;
    }
    
    /**
     * Stringifies an exception and all of its inner exceptions.
     *
     * In contrast to stringify() this specialized method returns
     * much more information about the given exception.
     *
     * @param Exception $exception
     * @return string
     */
    public static function stringifyException(Exception $exception)
    {
        $level = 0;
        $stringified = '';
        while ($exception !== null) {
            $representation = 'Type: '    . get_class($exception)          . PHP_EOL
                            . 'Code: '    . $exception->getCode()          . PHP_EOL
                            . 'Message: ' . $exception->getMessage()       . PHP_EOL
                            . 'Trace: '   . ltrim(self::indent($exception->getTraceAsString(), '       '));
            $indention      = ltrim(str_repeat('>', $level) . ' ');
            $stringified   .= self::indent($representation, $indention) . PHP_EOL;
            $exception      = (method_exists($exception, 'getPrevious')) ? $exception->getPrevious() : null;
            $level++;
        }
        return $stringified;
    }
    
    /**
     * Prepends the given prefix to each line of the provided text.
     *
     * @param string $text
     * @param string $prefix
     * @return string
     */
    protected static function indent($text, $prefix)
    {
        // Unify line endings.
        $text  = str_replace("\r\n", "\n", $text);
        $lines = explode("\n", $text);
        return $prefix . implode(PHP_EOL . $prefix, $lines);
    }
    
}
