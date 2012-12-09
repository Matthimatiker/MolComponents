<?php

/**
 * Mol_Util_Math
 *
 * @category PHP
 * @package Mol_Util
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 22.06.2012
 */

/**
 * Provides mathematical helper methods.
 *
 * @category PHP
 * @package Mol_Util
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 22.06.2012
 */
class Mol_Util_Math
{
    
    /**
     * Returns the sign of the value.
     *
     * This method returns:
     *
     * * -1 if $value < 0
     * *  0 if $value = 0
     * *  1 if $value > 0
     *
     * @param integer|double $value
     * @return integer -1 if $value < 0, 0 if $value == 0 and 1 if $value > 0.
     * @throws InvalidArgumentException If no integer or double is provided.
     */
    public static function sign($value)
    {
        if (!is_int($value) && !is_double($value)) {
            throw new InvalidArgumentException('Integer or double expected.');
        }
        if ($value > 0) {
            return 1;
        }
        if ($value < 0) {
            return -1;
        }
        return 0;
    }
    
    /**
     * Checks if the provided value is even.
     *
     * Example:
     *
     *     // Returns true:
     *     Mol_Util_Math::isEven(2);
     *     // Returns false:
     *     Mol_Util_Math::isEven(7);
     *
     * @param integer $value
     * @return boolean True if $value is even, false otherwise.
     * @throws InvalidArgumentException If no integer is provided.
     */
    public static function isEven($value)
    {
        if (!is_int($value)) {
            throw new InvalidArgumentException('Integer expected.');
        }
        // Check the last bit to determine if the value is even.
        return ($value & 1) === 0;
    }
    
    /**
     * Checks if the provided value is odd.
     *
     * Example:
     *
     *     // Returns true:
     *     Mol_Util_Math::isOdd(3);
     *     // Returns false:
     *     Mol_Util_Math::isOdd(6);
     *
     * @param integer $value
     * @return boolean True if $value is odd, false otherwise.
     * @throws InvalidArgumentException If no integer is provided.
     */
    public static function isOdd($value)
    {
        if (!is_int($value)) {
            throw new InvalidArgumentException('Integer expected.');
        }
        // Check the last bit to determine if the value is odd.
        return ($value & 1) === 1;
    }
    
}
