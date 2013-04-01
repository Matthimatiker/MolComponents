<?php

/**
 * Mol_Form_Factory_Plugin_UniqueId
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.04.2013
 */

/**
 * Plugins that sets unique IDs for each form elements.
 *
 * Assigning unique IDs avoids clashes if the same form is rendered
 * twice on the same page or if different forms contain elements
 * with the same name.
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.04.2013
 */
class Mol_Form_Factory_Plugin_UniqueId extends Mol_Form_Factory_Plugin_AbstractPlugin
{
    
    /**
     * Adds unique IDs to all elements in the given form.
     *
     * @param Zend_Form $form
     */
    public function enhance(Zend_Form $form)
    {
        foreach ($form->getSubForms() as $subForm) {
            /* @var $subForm Zend_Form */
            $this->enhance($subForm);
        }
        foreach ($form->getElements() as $element) {
            /* @var $element Zend_Form_Element */
            $this->updateId($element);
        }
    }
    
    /**
     * Updates the ID of the given element.
     *
     * @param Zend_Form_Element $element
     */
    protected function updateId(Zend_Form_Element $element)
    {
        $currentId = $element->getId();
        $newId     = $currentId . '-' . uniqid();
        $element->setAttrib('id', $newId);
    }
    
}
