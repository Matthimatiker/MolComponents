<?php

/**
 * Mol_Application_BootstrapTest
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 15.07.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the bootstrapper with lazy loading support.
 *
 * @category PHP
 * @package Mol_Bootstrap
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 15.07.2012
 */
class Mol_Application_BootstrapTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Ensures that the lazyLoad option is not passed to resource plugins.
     */
    public function testBootstrapperDoesNotPassLazyLoadOptionToResource()
    {
        
    }
    
    public function testBootstrapperDoesNotApplyLazyLoadingIfLazyLoadOptionIsNotProvided()
    {
        
    }
    
    public function testBootstrapperDoesNotApplyLazyLoadingIfLazyLoadOptionIsFalse()
    {
        
    }
    
    public function testBootstrapperAppliesLazyLoadingIfLazyLoadOptionIsTrue()
    {
        
    }
    
    public function testGetResourceReturnsCorrectValueIfResourceWasNotLazyLoaded()
    {
        
    }
    
    public function testGetResourceReturnsCorrectValueIfResourceIsLazyLoaded()
    {
        
    }
    
}
