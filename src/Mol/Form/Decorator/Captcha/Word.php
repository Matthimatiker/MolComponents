<?php

/**
 * Mol_Form_Decorator_Captcha_Word
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 07.04.2013
 */

/**
 * A captcha decorator that fixes problems regarding ID rendering.
 *
 * # Usage #
 *
 * To use this decorator the prefix path of the captcha element
 * must be configured properly:
 *
 *     $captcha->addPrefixPath('Mol_Form_Decorator_Captcha', '/path/to/decorator/directory', 'decorator');
 *
 * Alternatively a decorator instance can be assigned directly, although this
 * might mess up the rather complex ordering of the captcha decorators and is
 * therefore not recommended:
 *
 *     $decorator = new Mol_Form_Decorator_Captcha_Word();
 *     $captcha->addDecorator($decorator);
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 07.04.2013
 */
class Mol_Form_Decorator_Captcha_Word extends Zend_Form_Decorator_Captcha_Word
{
    
    /**
     * Placeholder that is temporarily used for the content.
     *
     * @var string
     */
    const PLACEHOLDER_CONTENT = '__CONTENT__';
    
    /**
     * Placeholder that is temporarily used for the ID.
     *
     * @var string
     */
    const PLACEHOLDER_ID = '__ID__';
    
    /**
     * Suffix for the ID that is assigned to the hidden field.
     *
     * @var string
     */
    const HIDDEN_FIELD_ID_SUFFIX = '-id';
    
    /**
     * Suffix for the ID that is assigned to the text field.
     *
     * @var string
     */
    const TEXT_FIELD_ID_SUFFIX = '-input';
    
    /**
     * Suffix for the ID that is assigned to the HtmlTag that is rendered
     * around the captcha input fields.
     *
     * @var string
     */
    const HTML_TAG_ID_SUFFIX = '-element';
    
    /**
     * Renders the captcha and ensures that IDs are assigned correctly.
     *
     * @param string $content
     * @return string
     */
    public function render($content)
    {
        // Use a placeholders for ID and content that are replaced
        // after ID correction.
        $element         = $this->getElement();
        $previousIdValue = $element->getAttrib('id');
        $element->setAttrib('id', self::PLACEHOLDER_ID);
        
        // Use the original decorator to create the markup.
        $markup = parent::render(self::PLACEHOLDER_CONTENT);
        
        // Restore the original ID.
        $element->setAttrib('id', $previousIdValue);
        
        $this->assignIdToLabelDecorator();
        $this->fixIdOfHtmlTagDecorator();
        
        $markup = $this->fixIds($markup);
        
        return $this->restoreContent($markup, $content);
    }
    
    /**
     * Restores the original content in the given markup.
     *
     * @param string $markup
     * @param string $content
     * @return string
     */
    protected function restoreContent($markup, $content)
    {
        return str_replace(self::PLACEHOLDER_CONTENT, $content, $markup);
    }
    
    /**
     * Inserts correct ID values.
     *
     * @param string $markup
     * @return string The fixed markup.
     */
    protected function fixIds($markup)
    {
        $id = $this->getElement()->getId();
        // It is assumed that the hidden field is rendered first.
        $parts  = explode(self::PLACEHOLDER_ID, $markup, 3);
        $markup = $parts[0] . $id . self::HIDDEN_FIELD_ID_SUFFIX
                . $parts[1] . $id . self::TEXT_FIELD_ID_SUFFIX
                . $parts[2];
        return $markup;
    }
    
    /**
     * Assign the correct ID to the Label decorator if necessary.
     */
    protected function assignIdToLabelDecorator()
    {
        $element   = $this->getElement();
        $decorator = $element->getDecorator('Label');
        if ($decorator !== false) {
            $decorator->setOption('id', $element->getId() . self::TEXT_FIELD_ID_SUFFIX);
        }
    }
    
    /**
     * Fixes the ID of the HtmlTag decorator.
     *
     * Per default the assigned ID depends on the element name,
     * but the element ID should be used instead.
     */
    protected function fixIdOfHtmlTagDecorator()
    {
        $element   = $this->getElement();
        $decorator = $element->getDecorator('HtmlTag');
        $invalidId = $element->getName() . self::HTML_TAG_ID_SUFFIX;
        if ($decorator !== false && $decorator->getOption('id') === $invalidId) {
            $decorator->setOption('id', $element->getId() . self::HTML_TAG_ID_SUFFIX);
        }
    }
    
}
