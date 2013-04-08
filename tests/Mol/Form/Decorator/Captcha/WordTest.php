<?php

/**
 * Mol_Form_Decorator_Captcha_Word
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 07.04.2013
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Checks the captcha word decorator.
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 07.04.2013
 */
class Mol_Form_Decorator_Captcha_WordTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Checks if the correct ID is passed to the label decorator
     * of the rendered element.
     */
    public function testDecoratorAssignsCorrectIdToLabelDecorator()
    {
        
    }
    
    /**
     * Ensures that the decorator works if the element does not use
     * a label decorator.
     */
    public function testDecoratorWorksIfElementHasNoLabelDecorator()
    {
        
    }
    
    /**
     * Ensures that the decorator does not assign the same ID to the hidden
     * and the text input field.
     */
    public function testDecoratorDoesNotAssignSameIdToHiddenAndTextField()
    {
        
    }
    
    /**
     * Checks if the ID with suffix "-input" is assigned to the text field.
     */
    public function testDecoratorAssignsIdWithInputSuffixToTextField()
    {
        
    }
    
    /**
     * Ensures that the decorator does not break the provided content string if it contains
     * the element ID.
     */
    public function testDecoratorDoesNotDestroyInitialContentIfItContainsIdAsString()
    {
        
    }
    
    /**
     * Checks if the decorator works with an element that does not define an ID
     * explicitly.
     */
    public function testDecoratorWorksIfElementDoesNotProvideIdExplicitly()
    {
        
    }
    
}
