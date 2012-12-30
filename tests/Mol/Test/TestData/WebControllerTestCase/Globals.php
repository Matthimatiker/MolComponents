<?php

/**
 * Mol_Test_TestData_WebControllerTestCase_Globals
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
class Mol_Test_TestData_WebControllerTestCase_Globals extends Mol_Test_WebControllerTestCase
{
    
    /**
     * Test that changes $_GET and $_POST values via request object.
     */
    public function testManipulateGlobalState()
    {
        $this->request->setQuery('global_get_variable', 42);
        $this->request->setPost('global_post_variable', 42);
    }
    
}
