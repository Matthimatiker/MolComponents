<?php

/**
 * Mol_Test_Controller_Action_Helper_ViewRendererTest
 *
 * @category PHP
 * @package Mol_Test
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/*
 * @since 17.01.2013
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the view renderer which is used in controller tests.
 *
 * @category PHP
 * @package Mol_Test
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/*
 * @since 17.01.2013
 */
class Mol_Test_Controller_Action_Helper_ViewRendererTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Test_Controller_Action_Helper_ViewRenderer
     */
    protected $viewRenderer = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->viewRenderer = new Mol_Test_Controller_Action_Helper_ViewRenderer();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->viewRenderer = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that access to the front controller is restricted as it
     * is a global dependency.
     */
    public function testHelperDoesNotAllowAccessToFrontController()
    {
        $this->setExpectedException('Mol_Test_Exception');
        $this->viewRenderer->getFrontController();
    }
    
}
