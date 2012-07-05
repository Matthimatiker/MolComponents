<?php

/**
 * Mol_Test_Bootstrap
 *
 * @category PHP
 * @package Mol_Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 05.07.2012
 */

/**
 * A bootstrapper that supports simulation of resources and is used for testing.
 *
 * @category PHP
 * @package Mol_Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 05.07.2012
 */
class Mol_Test_Bootstrap extends Zend_Application_Bootstrap_BootstrapAbstract
{
    // @todo do not share resources (custom container)
    // @todo do not force users to create instances of Zend_Application as constructor argument
    // @todo simulation of resources
}
