<?php

/**
 * Mol_Test_TestData_WebControllerTestCase_GlobalsTest
 *
 * @category PHP
 * @package Mol_Test
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 30.12.2012
 */

/**
 * Helper class that is used to check the WebControllerTestCase.
 *
 * @category PHP
 * @package Mol_Test
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 30.12.2012
 */
class Mol_Test_TestData_WebControllerTestCase_GlobalsTest extends Mol_Test_WebControllerTestCase
{
    
    /**
     * Test that changes $_GET and $_POST values via request object.
     */
    public function testManipulateGlobalVariables()
    {
        $this->request->setQuery('global_get_variable', 42);
        $this->request->setPost('global_post_variable', 42);
    }
    
    /**
     * Test that adds another (global) action helper.
     */
    public function testAddActionHelper()
    {
        $helper = $this->getMock('Zend_Controller_Action_Helper_Abstract');
        Zend_Controller_Action_HelperBroker::addHelper($helper);
    }
    
    /**
     * A dummy test that does nothing.
     */
    public function testNothing()
    {
    }
    
}
