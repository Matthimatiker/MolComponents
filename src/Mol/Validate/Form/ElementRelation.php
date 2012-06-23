<?php

/**
 * Mol_Validate_Form_ElementRelation
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 23.06.2012
 */

/**
 * Validator that compares the values of two different form elements.
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 23.06.2012
 * @property string $compareName The name of the compared element.
 * @property string $compareLabel The label of the compared element.
 * @property string|null $compareValue The value that was compared last.
 */
class Mol_Validate_Form_ElementRelation extends Zend_Validate_Abstract
{
    
    /**
     * Identifier for failure message if no context was provided.
     *
     * @var string
     */
    const NO_CONTEXT = 'elementRelationNoContext';
    
    /**
     * Identifier for failure message if an invalid context was provided.
     *
     * @var string
     */
    const INVALID_CONTEXT = 'elementRelationInvalidContext';
    
    /**
     * Identifier for failure message if the provided context does
     * not contain the compare value.
     *
     * @var string
     */
    const NO_COMPARE_VALUE = 'elementRelationNoCompareValue';
    
    /**
     * The validator that is used to check the relation
     * of the compared values.
     *
     * @var Zend_Validate_Interface
     */
    protected $relationValidator = null;
    
    /**
     * The element use value is compared.
     *
     * @var Zend_Form_Element
     */
    protected $element = null;
    
    /**
     * Contains the compared value if it is available.
     *
     * @var string|null
     */
    protected $rawCompareValue = null;
    
    /**
     * Failure message templates.
     *
     * @var array(string=>string)
     */
    protected $_messageTemplates = array(
        self::NO_CONTEXT       => "No context provided",
        self::INVALID_CONTEXT  => "Invalid context provided",
        self::NO_COMPARE_VALUE => "Context does not contain compare value '%compareName%'"
    );
    
    /**
     * Mapping of variables that can be used in failure messages.
     *
     * @var array(string=>string)
     */
    protected $_messageVariables = array(
        'compareLabel' => 'compareLabel',
        'compareName'  => 'compareName',
        'compareValue' => 'compareValue'
    );
    
    /**
     * Creates a validator that uses the provided relation and
     * compares the validated value against the value of the given
     * form element.
     *
     * @param string|Zend_Validate_Interface $relation
     * @param Zend_Form_Element $element
     */
    public function __construct($relation, Zend_Form_Element $element)
    {
        $this->relationValidator = $this->toRelationValidator($relation);
        $this->element           = $element;
    }
    
    /**
     * Checks if the values of the two form elements fulfill the relation.
     *
     * @param mixed $value
     * @param array(string=>string)|null $context
     * @return boolean True if the element relation is fulfilled, false otherwise.
     */
    public function isValid($value, $context = null)
    {
        $this->_setValue($value);
        $this->rawCompareValue = null;
        if ($context === null) {
            $this->_error(self::NO_CONTEXT);
            return false;
        }
        if (!is_array($context)) {
            $this->_error(self::INVALID_CONTEXT);
            return false;
        }
        if (!isset($context[$this->getCompareName()])) {
            $this->_error(self::NO_COMPARE_VALUE);
            return false;
        }
        $this->rawCompareValue = $context[$this->getCompareName()];
        if (!$this->relationValidator->isValid($value, $this->rawCompareValue)) {
            $this->addMessages($this->relationValidator->getMessages());
            return false;
        }
        return true;
    }
    
    /**
     * Simulates properties that are used in message templates.
     *
     * @param string $property
     * @returnb mixed
     */
    public function __get($property)
    {
        switch ($property) {
            case 'compareName':
                return $this->getCompareName();
            case 'compareLabel':
                return $this->getCompareLabel();
            case 'compareValue':
                return $this->getCompareValue();
        }
        return parent::__get($property);
    }
    
    /**
     * Converts the relation identifier into a relation validator.
     *
     * If a validator is provided then it will be returned.
     *
     * @param string|Zend_Validate_Interface $relation
     * @return Zend_Validate_Interface
     * @throws InvalidArgumentException If an invalid identifier is provided.
     */
    protected function toRelationValidator($relation)
    {
        if (!($relation instanceof Zend_Validate_Interface)) {
            $message = 'No valid relation validator provided.';
            throw new InvalidArgumentException($message);
        }
        return $relation;
    }
    
    /**
     * Adds the provided failure messages.
     *
     * @param array(string=>string) $messages
     */
    protected function addMessages(array $messages)
    {
        foreach ($messages as $key => $message) {
            /* @var $key string */
            /* @var $message string */
            $this->_messageTemplates[$key] = $message;
            $this->_error($key);
        }
    }
    
    /**
     * Returns the name of the compoared element.
     *
     * @return string
     */
    protected function getCompareName()
    {
        return $this->element->getName();
    }
    
    /**
     * Returns the label if the compared element.
     *
     * @return string
     */
    protected function getCompareLabel()
    {
        return $this->element->getLabel();
    }
    
    /**
     * Returns the compared value.
     *
     * @return string|null
     */
    protected function getCompareValue()
    {
        if ($this->getObscureValue() && is_string($this->rawCompareValue)) {
            return str_repeat('*', strlen($this->rawCompareValue));
        }
        return $this->rawCompareValue;
    }
    
}
