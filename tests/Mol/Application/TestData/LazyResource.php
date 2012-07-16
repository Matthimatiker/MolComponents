<?php

/**
 * Mol_Application_Bootstrap_TestData_LazyResource
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 16.07.2012
 */

/**
 * Resource that is used for testing.
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 16.07.2012
 */
class Mol_Application_Bootstrap_TestData_LazyResource extends Zend_Application_Resource_ResourceAbstract
{
    
    /**
     * Returns the configured return value (if provided).
     *
     * If no return value is provided then the resource itself will be returned.
     *
     * @return mixed|Mol_Application_Bootstrap_TestData_LazyResource
     */
    public function init()
    {
        $options = $this->getOptions();
        return isset($options['return']) ? $options['return'] : $this;
    }
    
}
