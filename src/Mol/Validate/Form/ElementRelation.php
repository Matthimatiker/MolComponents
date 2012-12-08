<?php

/**
 * Mol_Validate_Form_ElementRelation
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 23.06.2012
 */

/**
 * Validator that compares the values of two different form elements.
 *
 * == Usage ==
 *
 * The validator is simply added to a form element.
 * The relation and the compared element are passed to the
 * constructor of the validator.
 *
 * Example:
 * <code>
 * // Create elements that expect date values in format yyyy-mm-dd:
 * $from = new Zend_Form_Element_Text('from);
 * $to = new Zend_Form_Element_Text('to');
 * // Ensure that the provided "to" date is only valid if it is
 * // beyond the "from" date:
 * $to->addValidator(new Mol_Validate_Form_ElementRelation('>', $from));
 * </code>
 *
 * The constructor accepts the relation first, then the compared element.
 * That order makes it easy to read the relation rule. The example above
 * tells:
 * $to > $from
 *
 * As shown relation identifiers (strings) can be provided if built-in
 * relations are used.
 * The following relation identifiers are currently supported:
 * # ==
 * # !=
 * # <
 * # >
 * # <=
 * # >=
 *
 * More specific or custom relations can be provided as object instead
 * of the relation identifier.
 *
 *
 * == Custom relations ==
 *
 * The relation validators that are used internally must implement
 * the Zend_Validate_Interface interface.
 *
 * The isValid() method should accept a second (for compability reasons
 * optional) value:
 * <code>
 * pblic function isValid($value, $other = null)
 * {
 * }
 * </code>
 *
 * The relation object is then passed to the constructor of the ElementRelation
 * validator.
 * For example we could use a custom relation validator that checks for a maximal
 * difference between two values.
 * Adding it could look like this:
 * <code>
 * $relation = new My_Custom_MaxDiffRelation(42);
 * $validator = new Mol_Validate_Form_ElementRelation($relation, $comparedElement);
 * </code>
 *
 *
 * == Error messages ==
 *
 * The ElementRelation validator will pass through the messages that are provided
 * by the internal relation validator.
 *
 * It will also translate these messages if possible/desired. Therefore the relation
 * does not need to take care of translation itself.
 *
 * Furthermore the ElementRelation supports some additional placeholders in the
 * messages.
 * Currently the following additional placeholders are supported:
 * # %compareName%  - The name of the compared element
 * # %compareLabel% - The label of the compared element
 * # %compareValue% - The value that was compared
 *
 * @category PHP
 * @package Mol_Validate
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
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
    protected $relation = null;
    
    /**
     * The element whose value is compared.
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
        'compareName'  => 'compareName',
        'compareLabel' => 'compareLabel',
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
        $this->relation = $this->toRelation($relation);
        $this->element  = $element;
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
        if (!$this->relation->isValid($value, $this->rawCompareValue)) {
            $this->addMessages($this->relation->getMessages());
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
     * @param string|Zend_Validate_Interface $relationOrIdentifier
     * @return Zend_Validate_Interface
     * @throws InvalidArgumentException If an invalid relation is provided.
     */
    protected function toRelation($relationOrIdentifier)
    {
        if (is_string($relationOrIdentifier)) {
            return $this->createRelationByIdentifier($relationOrIdentifier);
        }
        if ($relationOrIdentifier instanceof Zend_Validate_Interface) {
            return $relationOrIdentifier;
        }
        $message = 'No valid relation validator provided.';
        throw new InvalidArgumentException($message);
    }
    
    /**
     * Creates the relation validator that belongs to the provided identifier.
     *
     * @param string $identifier
     * @return Zend_Validate_Interface
     * @throws InvalidArgumentException If an invalid identifier is provided.
     */
    protected function createRelationByIdentifier($identifier)
    {
        switch ($identifier) {
            case '==':
                return new Mol_Validate_Form_Relation_Equal();
            case '!=':
                return new Mol_Validate_Form_Relation_NotEqual();
            case '>':
                return new Mol_Validate_Form_Relation_GreaterThan();
            case '>=':
                return new Mol_Validate_Form_Relation_GreaterThanOrEqual();
            case '<':
                return new Mol_Validate_Form_Relation_LessThan();
            case '<=':
                return new Mol_Validate_Form_Relation_LessThanOrEqual();
        }
        $message = Mol_Util_Stringifier::stringify($identifier) . ' is not a valid relation identifier.';
        throw new InvalidArgumentException($message);
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
            // Route message through this validator to ensure
            // that placeholders are substituted.
            $this->_messageTemplates[$key] = $message;
            $this->_error($key);
        }
    }
    
    /**
     * Returns the name of the compared element.
     *
     * @return string
     */
    protected function getCompareName()
    {
        return $this->element->getName();
    }
    
    /**
     * Returns the label of the compared element.
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
