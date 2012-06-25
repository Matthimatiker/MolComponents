<?php

/**
 * Mol_Filter_Cast
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
 * Filter that casts values to the type that was specified in the constructor.
 *
 * Example:
 * <code>
 * $filter = new Mol_Filter_Cast('integer');
 * // Returns the integer 42.
 * $filter->filter('42');
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
class Mol_Filter_Cast implements Zend_Filter_Interface
{
    /**
     * The type this filter converts the values to.
     *
     * @var string
     */
    protected $type = null;

    /**
     * Creates the filter.
     *
     * The parameter $type is used to tell the filter to which type
     * it should cast given values.
     * The following types are supported:
     * # boolean
     * # integer
     * # float
     * # double
     * # string
     * # array
     * # object
     * # null
     *
     * @param string $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Casts the value into the type that was passed to the constructor.
     *
     * @param mixed $value
     * @return mixed The converted value.
     */
    public function filter($value)
    {
        settype($value, $this->type);
        return $value;
    }

}

