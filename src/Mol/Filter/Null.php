<?php

/**
 * Mol_Filter_Null
 *
 * @category PHP
 * @package Mol_Filter
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 17.12.2010
 */

/**
 * Null object for filters.
 *
 * Returns the argument value without doing anything.
 *
 * Example:
 * <code>
 * $filter = new Mol_Filter_Null();
 * // Returns the integer 42.
 * $filter->filter(42);
 * // Returns the string "Hello!".
 * $filter->filter('Hello!');
 * </code>
 *
 * @category PHP
 * @package Mol_Filter
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 17.12.2010
 */
class Mol_Filter_Null implements Zend_Filter_Interface
{
    /**
     * Zend_Filter_Interface::filter()
     *
     * @param mixed $value
     * @return mixed
     */
    public function filter( $value )
    {
        return $value;
    }

}

