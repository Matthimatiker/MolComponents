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
        
    }
    
}
