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
        $previousId      = $element->getId();
        $element->setAttrib('id', '__ID__');
        
        // Use the original decorator to create the markup.
        $markup = parent::render('__CONTENT__');
        
        // Restore the original ID.
        $element->setAttrib('id', $previousIdValue);
        // Assign correct ID to Label decorator if necessary.
        $labelDecorator = $element->getDecorator('Label');
        if ($labelDecorator !== false) {
            $labelDecorator->setOption('id', $previousId . '-input');
        }
        
        // Insert correct ID values. It is assumed that the hidden field is rendered first.
        $parts  = explode('__ID__', $markup, 3);
        $markup = $parts[0] . $previousId . '-id' . $parts[1] . $previousId . '-input' . $parts[2];
        // Insert the original content.
        $markup = str_replace('__CONTENT__', $content, $markup);
        
        return $markup;
    }
    
}
