<?php

/**
 * Mol_Form_Decorator_Captcha_WordTest
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
     * System under test.
     *
     * @var Mol_Form_Decorator_Captcha_Word
     */
    protected $decorator = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        // Usually a captcha element is rendered by the decorator,
        // but for testing a text field is just as well.
        // Using a text field avoids a dependency to the session.
        $element = new Zend_Form_Element_Text('my_captcha');
        $element->setAttrib('id', 'my-id');
        $element->setView(new Zend_View());
        $this->decorator = new Mol_Form_Decorator_Captcha_Word();
        $this->decorator->setElement($element);
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->decorator = null;
        parent::tearDown();
    }
    
    /**
     * Checks if the correct ID is passed to the label decorator
     * of the rendered element.
     */
    public function testDecoratorAssignsCorrectIdToLabelDecorator()
    {
        $this->render();
        
        $assignedId = $this->decorator->getElement()->getDecorator('Label')->getOption('id');
        $this->assertEquals('my-id-input', $assignedId);
    }
    
    /**
     * Ensures that the decorator works if the element does not use
     * a label decorator.
     */
    public function testDecoratorWorksIfElementHasNoLabelDecorator()
    {
        $this->decorator->getElement()->removeDecorator('Label');
        
        $this->setExpectedException(null);
        $this->render();
    }
    
    /**
     * Ensures that the decorator does not assign the same ID to the hidden
     * and the text input field.
     */
    public function testDecoratorDoesNotAssignSameIdToHiddenAndTextField()
    {
        $markup = $this->render();
        $ids    = $this->getIdsByElementName($markup);
        
        $this->assertArrayHasKey($this->getHiddenFieldName(), $ids);
        $this->assertArrayHasKey($this->getTextFieldName(), $ids);
        $this->assertNotEquals($ids[$this->getHiddenFieldName()], $ids[$this->getTextFieldName()]);
    }
    
    /**
     * Checks if the ID with suffix "-input" is assigned to the text field.
     */
    public function testDecoratorAssignsIdWithInputSuffixToTextField()
    {
        $markup = $this->render();
        $ids    = $this->getIdsByElementName($markup);
        
        $this->assertArrayHasKey($this->getTextFieldName(), $ids);
        $this->assertStringEndsWith('-input', $ids[$this->getTextFieldName()]);
    }
    
    /**
     * Ensures that the sam ID is assigned to the label and the text field.
     */
    public function testDecoratorAssignsSameIdToLabelAndTextField()
    {
        $markup = $this->render();
        $ids    = $this->getIdsByElementName($markup);
        
        $labelId = $this->decorator->getElement()->getDecorator('Label')->getOption('id');
        $this->assertArrayHasKey($this->getTextFieldName(), $ids);
        $this->assertEquals($labelId, $ids[$this->getTextFieldName()]);
    }
    
    /**
     * Ensures that the decorator does not break the provided content string if it contains
     * the element ID.
     */
    public function testDecoratorDoesNotDestroyInitialContentIfItContainsIdAsString()
    {
        $content = '<img src="/captchas/my-id/images" />';
        $markup  = $this->render($content);
        
        $this->assertContains($content, $markup);
    }
    
    /**
     * Checks if the decorator works with an element that does not define an ID
     * explicitly.
     */
    public function testDecoratorWorksIfElementDoesNotProvideIdExplicitly()
    {
        $this->decorator->getElement()->setAttrib('id', null);
        
        $this->setExpectedException(null);
        $this->render();
    }
    
    /**
     * Ensures that the decorator assigns valid IDs to the different parts if
     * the element does not provide an ID explicitly.
     */
    public function testDecoratorAssignsValidIdsIfElementDoesNotProvideIdExplicitly()
    {
        $this->decorator->getElement()->setAttrib('id', null);
        
        $markup = $this->render();
        $ids    = $this->getIdsByElementName($markup);
        
        $this->assertArrayHasKey($this->getHiddenFieldName(), $ids);
        $this->assertArrayHasKey($this->getTextFieldName(), $ids);
        // IDs of text and hidden field must differ.
        $this->assertNotEquals($ids[$this->getHiddenFieldName()], $ids[$this->getTextFieldName()]);
        // ID of label and text field must be equal.
        $labelId = $this->decorator->getElement()->getDecorator('Label')->getOption('id');
        $this->assertEquals($labelId, $ids[$this->getTextFieldName()]);
    }
    
    /**
     * Ensures that the decorator assigns correct IDs if the name and the ID of
     * the rendered element are equal.
     */
    public function testDecoratorAssignsCorrectIdsIfElementNameAndIdAreEqual()
    {
        $this->decorator->getElement()->setAttrib('id', 'my_captcha');
        
        $markup = $this->render();
        $ids    = $this->getIdsByElementName($markup);
        
        $this->assertArrayHasKey($this->getHiddenFieldName(), $ids);
        $this->assertArrayHasKey($this->getTextFieldName(), $ids);
        // IDs of text and hidden field must differ.
        $this->assertNotEquals($ids[$this->getHiddenFieldName()], $ids[$this->getTextFieldName()]);
        // ID of label and text field must be equal.
        $labelId = $this->decorator->getElement()->getDecorator('Label')->getOption('id');
        $this->assertEquals($labelId, $ids[$this->getTextFieldName()]);
    }
    
    /**
     * Returns the expected name if the rendered hidden field.
     *
     * @return string
     */
    protected function getHiddenFieldName()
    {
        return $this->decorator->getElement()->getFullyQualifiedName() . '[id]';
    }
    
    /**
     * Returns the expected name if the rendered text field.
     *
     * @return string
     */
    protected function getTextFieldName()
    {
        return $this->decorator->getElement()->getFullyQualifiedName() . '[input]';
    }
    
    /**
     * Extracts the IDs of named elements from the provided markup.
     *
     * @param string $markup
     * @return array(string=>string) List with names as key and IDs as value.
     */
    protected function getIdsByElementName($markup)
    {
        $pattern = '/<.*name="(?P<name>.*?)".*id="(?P<id>.*?)".*>/';
        $matches = array();
        preg_match_all($pattern, $markup, $matches, PREG_SET_ORDER);
        $idsByName = array();
        foreach ($matches as $match) {
            /* @var $match array(string=>string) */
            $idsByName[$match['name']] = $match['id'];
        }
        return $idsByName;
    }
    
    /**
     * Uses the decorator to render the element.
     *
     * @param string $content The input content.
     * @return string The rendered markup.
     */
    protected function render($content = 'hello world')
    {
        $markup = $this->decorator->render($content);
        $this->assertInternalType('string', $markup);
        return $markup;
    }
    
}
