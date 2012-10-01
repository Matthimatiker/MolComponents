<?php

/**
 * Mol_Form_FactoryTest
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.10.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the form factory.
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.10.2012
 */
class Mol_Form_FactoryTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Form_Factory
     */
    protected $factory = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->factory = new Mol_Form_Factory();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->factory = null;
        parent::tearDown();
    }
    
}
