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
        
        $markup = $this->fixIds($markup);
        
        // Insert the original content.
        $markup = str_replace(self::PLACEHOLDER_CONTENT, $content, $markup);
        
        return $markup;
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
        $element        = $this->getElement();
        $labelDecorator = $element->getDecorator('Label');
        if ($labelDecorator !== false) {
            $labelDecorator->setOption('id', $element->getId() . self::TEXT_FIELD_ID_SUFFIX);
        }
    }
    
}
