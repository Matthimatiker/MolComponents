<?php

/**
 * Mol_Form_Factory_Plugin_UniqueId
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.04.2013
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Mol_Form_Factory_Plugin_UniqueId
 *
 * @category PHP
 * @package Mol_Form
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.04.2013
 */
class Mol_Form_Factory_Plugin_UniqueIdTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Form_Factory_Plugin_UniqueId
     */
    protected $plugin = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->plugin = new Mol_Form_Factory_Plugin_UniqueId();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->plugin = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that the generated ID starts with the original ID.
     */
    public function testGeneratedIdStartsWithOriginalId()
    {
        $form = $this->createForm();
        $form->getElement('content')->setAttrib('id', 'custom');
        
        $this->plugin->enhance($form);
        
        $this->assertStringStartsWith('custom', $form->getElement('content')->getId());
    }
    
    /**
     * Ensures that elements with the same name get different IDs.
     */
    public function testElementsWithSameNameReceiveDifferentIds()
    {
        $first  = $this->createForm();
        $second = $this->createForm();
        
        $this->plugin->enhance($first);
        $this->plugin->enhance($second);
        
        $this->assertNotEquals($first->getElement('content')->getId(), $second->getElement('content')->getId());
    }
    
    /**
     * Ensures that elements in sub forms also get unique IDs.
     */
    public function testElementsInSubFormsReceiveUniqueIds()
    {
        $form = $this->createForm();
        $subForm = $this->createForm('test');
        $form->addSubForm($subForm, 'testForm');
        $previousId = $subForm->getElement('test')->getId();
        
        $this->plugin->enhance($form);
        
        $this->assertNotEquals($previousId, $subForm->getElement('test')->getId());
    }
    
    /**
     * Ensures that elements with the same name which are located in form
     * and sub form do not get the same ID.
     */
    public function testIdsOfElementsWithSameNameInFormAndSubFormDoNotClash()
    {
        $form = $this->createForm();
        $subForm = $this->createForm();
        $form->addSubForm($subForm, 'testForm');
        
        $this->plugin->enhance($form);
        
        $this->assertNotEquals($form->getElement('content')->getId(), $subForm->getElement('content')->getId());
    }
    
    /**
     * Creates a form that contains an element with the provided name.
     *
     * @param string $elementName
     * @return Zend_Form
     */
    protected function createForm($elementName = 'content')
    {
        $form    = new Zend_Form();
        $element = new Zend_Form_Element_Text($elementName);
        $form->addElement($element);
        return $form;
    }
    
}