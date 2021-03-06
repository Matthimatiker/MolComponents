<?php

/**
 * Initializes the test environment.
 *
 * @category PHP
 * @package MolComponents
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 12.06.2012
 */

/** Initialize autoloader. */
require_once(dirname(__FILE__) . '/../vendor/autoload.php');

// Disable circular reference garbage collection as this
// sometimes leads to crashes (noticed on Windows as well
// as on Ubuntu systems).
gc_disable();