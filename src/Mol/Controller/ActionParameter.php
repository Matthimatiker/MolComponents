<?php

/**
 * Mol_Controller_ActionParameter
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Controller
 * @copyright Matthias Molitor 2010
 * @version $Rev: 411 $
 * @since 15.12.2010
 */

/**
 * Basic class for controllers that allows to define request parameters
 * directly as action method arguments. The controller takes care of
 * parameter validation and casts them to the expected type.
 *
 * == Usage ==
 *
 * To use the controllers functionality add the required request parameters
 * as method arguments to the action:
 * <code>
 * public function myAction( $page = 1 ) {
 *     // my code
 * }
 * </code>
 * The defined default values are used if the request does not contain
 * a parameter that is named like the argument.
 *
 * To use the parameters they must be documented in the DocBlock
 * of the action method:
 * <code>
 * /**
 *  *
 *  * @param integer $page
 *  * /
 * </code>
 * The controller uses the DocBlock to determine the expected parameter
 * type and performs a validation. If the validation was succesful
 * the parameter is casted to the required type.
 * Therefore the action method in the example will receive a real
 * integer.
 * If the validation fails an exception is thrown that should be
 * handled by the error controller.
 *
 * Currently the controller supports the following default types:
 * # integer
 * # double
 * # boolean
 * # string
 * # array (with supported types as content)
 * # mixed (avoids the arguments validation)
 *
 *
 * == Extension ==
 *
 * If needed arbitrary types may be added to the controller.
 * Therefore a validator of the type Zend_Validate_Interface must be registered
 * via registerValidator() for the new parameter type:
 * <code>
 * $controller->registerValidator(new MyDateValidator(), 'Datetime');
 * </code>
 * Thats enough to gain basic support for that type. If a action parameter
 * of the type "Datetime" is documented the controller will use the registered
 * validator to perform an argument check.
 * If the parameter is valid it will be passed to the action method. However
 * per default no filtering takes place. Therefore in this example the
 * action method will receive a string as argument.
 *
 * If an automatic conversion is desired an additional filter of the type
 * Zend_Filter_Interface must be registered for the new type:
 * <code>
 * $controller->registerFilter(new MyDateFilter(), 'Datetime');
 * </code>
 * After successful validation the filter will be applied to the parameter.
 * For example our filter could convert the string to a real Datetime object
 * that will be passed to the action.
 *
 * The registration of validators and filters may either take place inside
 * the controller class (for example in its init() or preDispatch() method)
 * or from the outside (for example by an action helper).
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Controller
 * @copyright Matthias Molitor 2010
 * @version $Rev: 411 $
 * @since 15.12.2010
 */
abstract class Mol_Controller_ActionParameter extends Zend_Controller_Action
{
    /**
     * Contains validators for the different parameter types.
     *
     * The type name is used as key, the validator as value.
     *
     * @var Mol_DataType_Map
     */
    private $validators = null;

    /**
     * Contains filters for the different parameter types.
     *
     * The type name is used as key, the filter as value.
     *
     * @var Mol_DataType_Map
     */
    private $filters = null;

    /**
     * Contains parameters and their types per method, if they where
     * already determined per reflection.
     *
     * The method name is used as key. The value is an array with
     * the parameter names as keys and their documented types as
     * values.
     *
     * @var array(string=>array(string=>string))
     */
    private $paramTypesByMethod = array();

    /**
     * Executes the given action if it is available and the required
     * parameters are provided.
     *
     * @param string $action The name of the action method.
     * @throws Mol_Controller_Exception_ActionParameter If the action cannot be executed.
     */
    public function dispatch( $action )
    {
        $this->notifyPreDispatch();
        $this->preDispatch();
        if( $this->getRequest()->isDispatched() ) {
            // preDispatch() didn't change the action, so we can continue
            $this->processAction($action);
            $this->postDispatch();
        }
        $this->notifyPostDispatch();
    }

    /**
     * Notifies the helpers about the preDispatch event.
     */
    private function notifyPreDispatch()
    {
        $this->_helper->notifyPreDispatch();
    }

    /**
     *  Notifies the helpers about the postDispatch event.
     */
    private function notifyPostDispatch()
    {
        $this->_helper->notifyPostDispatch();
    }

    /**
     * Handles the execution of the given action method.
     *
     * @param string $actionMethod
     */
    private function processAction( $actionMethod )
    {
        if( $this->hasAction($actionMethod) ) {
            $this->executeAction($actionMethod);
        } else {
            $this->__call($actionMethod, array());
        }
    }

    /**
     * Checks if this controller declares the given action method.
     *
     * @param string $actionMethod
     * @return boolean True if the requested action is available, false otherwise.
     */
    private function hasAction( $actionMethod )
    {
        return in_array($actionMethod, $this->getClassMethods());
    }

    /**
     * Returns a list of all controller methods.
     *
     * @return array(string)
     */
    private function getClassMethods()
    {
        if( $this->_classMethods === null ) {
            $this->_classMethods = get_class_methods($this);
        }
        return $this->_classMethods;
    }

    /**
     * Executes the provided action.
     *
     * @param string $actionMethod
     */
    private function executeAction( $actionMethod )
    {
        $params = $this->getActionParameters($actionMethod);
        call_user_func_array(array( $this, $actionMethod ), $params);
    }

    /**
     * Determines the parameters that are documented for the action $actionMethod.
     *
     * To determine the parameters the method signature as well as the methods
     * DocBlock is used.
     *
     * @param string $actionMethod
     * @return array(mixed)
     * @throws Mol_Controller_Exception_ActionParameter If the parameters cannot be determined correctly.
     */
    private function getActionParameters( $actionMethod )
    {
        $info        = new ReflectionMethod(get_class($this), $actionMethod);
        $params      = $info->getParameters();
        $paramValues = array();
        foreach( $params as $param ) {
            /* @var $param ReflectionParameter */
            $paramValues[] = $this->getValueFor($param);
        }
        return $paramValues;
    }

    /**
     * Returns the value for the given method parameter.
     *
     * @param ReflectionParameter $parameter
     * @return mixed
     * @throws Mol_Controller_Exception_ParameterMissing If no parameter value is available.
     */
    private function getValueFor( ReflectionParameter $parameter )
    {
        $name  = $parameter->getName();
        $value = $this->_request->getParam($name, false);
        if( $value !== false ) {
            return $this->validateAndCast($value, $this->getTypeFor($parameter));
        }
        // The parameter is not available in the request object.
        if( !$parameter->isDefaultValueAvailable() ) {
            // No default value declared, cannot determine parameter value.
            $message = 'No default value defined for parameter "' . $name . '".';
            throw new Mol_Controller_Exception_ParameterMissing($message);
        }
        return $parameter->getDefaultValue();
    }

    /**
     * Validate $value by using the validator object for type $type. Filters
     * the value afterwards if possible.
     *
     * @param mixed $value
     * @param string $type The expected type.
     * @return mixed The filtered value.
     * @throws Mol_Controller_Exception_ParameterNotValid If the validation was not successful.
     */
    private function validateAndCast( $value, $type )
    {
        if( strpos($type, 'array') === 0 ) {
            // TODO: Handle key/value documentation: key=>value
            $typeInArray = substr($type, 6, -1);
            if( !is_array($value) ) {
                throw new Mol_Controller_Exception_ParameterNotValid('Array expected.');
            }
            foreach( $value as $key => $element ) {
                $value[$key] = $this->validateAndCast($element, $typeInArray);
            }
            return $value;
        }

        /* @var $validator Zend_Validate_Interface */
        $validator = $this->getValidatorFor($type);
        if( !$validator->isValid($value) ) {
            throw new Mol_Controller_Exception_ParameterNotValid($validator);
        }

        /* @var $filter Zend_Filter_Interface */
        $filter = $this->getFilterFor($type);
        return $filter->filter($value);
    }

    /**
     * Returns the documented type for the given parameter.
     *
     * @param ReflectionParameter $param
     * @return string The documented paramter type.
     * @throws Mol_Controller_Exception_ParameterTagMissing If the parameter was not documented correctly.
     */
    private function getTypeFor( ReflectionParameter $param )
    {
        /* @var $method ReflectionFunction */
        $method = $param->getDeclaringFunction();
        $types  = $this->getDocumentedParamsFor($method);
        if( !isset($types[$param->getName()]) ) {
            throw new Mol_Controller_Exception_ParameterTagMissing($param->getName());
        }
        return $types[$param->getName()];
    }

    /**
     * Returns the documented parameter types for the provided action method.
     *
     * The parameter name is used as key, the documented type is used as value.
     *
     * @param ReflectionMethod $action
     * @return array(string=>string)
     * @throws Mol_Controller_Exception_DocBlockMissing If the action is not documented.
     */
    private function getDocumentedParamsFor( ReflectionMethod $action )
    {
        $methodName = $action->getName();
        if( isset($this->paramTypesByMethod[$methodName]) ) {
            return $this->paramTypesByMethod[$methodName];
        }
        $comment = $action->getDocComment();
        if( $comment === false ) {
            $message = 'Missing DocBlock for method "' . $methodName . '".';
            throw new Mol_Controller_Exception_DocBlockMissing($message);
        }
        $regExp  = '/\* @param\s+(?P<type>\S+)\s+\$(?P<name>\S+)(\s|$)/';
        $matches = array();
        preg_match_all($regExp, $comment, $matches, PREG_SET_ORDER);
        $params = array();
        foreach( $matches as $match ) {
            $params[$match['name']] = $match['type'];
        }
        $this->paramTypesByMethod[$methodName] = $params;
        return $this->paramTypesByMethod[$methodName];
    }

    /**
     * Registers a validator for the given parameter types.
     *
     * The validator may be registered either for a single type...
     * <code>
     * $controller->registerValidator($myValidator, 'myType');
     * </code>
     *
     * ... or for multiple types at once by passing an array:
     * <code>
     * $controller->registerValidator($myValidator, array('myType', 'anotherType'));
     * </code>
     *
     * @param Zend_Validate_Interface $validator
     * @param string|array(string) $typeOrTypeList
     * @return Mol_Controller_ActionParameter Provides a Fluent Interface.
     */
    public function registerValidator( Zend_Validate_Interface $validator, $typeOrTypeList )
    {
        $this->validators()->register($validator, $typeOrTypeList);
        return $this;
    }

    /**
     * Returns the validator for the given type.
     *
     * @param string $type
     * @return Zend_Validate_Interface
     */
    private function getValidatorFor( $type )
    {
        return $this->validators()->{$type};
    }

    /**
     * Returns a map that contains all registered validators.
     *
     * @return Mol_DataType_Map
     */
    private function validators()
    {
        if( $this->validators === null) {
            $message          = 'No validator for the documented type available.';
            $default          = new Mol_Validate_False($message, 'missingTypeValidator');
            $this->validators = new Mol_DataType_Map(array(), $default);
            $this->registerDefaultValidators($this->validators);
        }
        return $this->validators;
    }

    /**
     * Registers the default validators.
     *
     * @param Mol_DataType_Map $validators
     */
    private function registerDefaultValidators( Mol_DataType_Map $validators )
    {
        $validators->register(new Zend_Validate_Int(),       array('int', 'integer'));
        $validators->register(new Zend_Validate_Float('en'), array('float', 'double'));
        $validators->register(new Mol_Validate_Boolean(),    array('bool', 'boolean'));
        $validators->register(new Mol_Validate_String(),     array('string'));
        // Mixed must be validated by the action that receives them.
        $validators->register(new Mol_Validate_True(),       array('mixed'));
    }

    /**
     * Registers a filter for the given parameter types.
     *
     * The filter may be registered either for a single type...
     * <code>
     * $controller->registerFilter($myFilter, 'myType');
     * </code>
     *
     * ... or for multiple types at once by passing an array:
     * <code>
     * $controller->registerValidator($myFilter, array('myType', 'anotherType'));
     * </code>
     *
     * @param Zend_Filter_Interface $filter
     * @param string|array(string) $typeOrTypeList
     * @return Mol_Controller_ActionParameter Bietet ein Fluent Interface.
     */
    public function registerFilter( Zend_Filter_Interface $filter, $typeOrTypeList )
    {
        $this->filters()->register($filter, $typeOrTypeList);
        return $this;
    }

    /**
     * Returns the filter for the given type.
     *
     * @param string $type
     * @return Zend_Filter_Interface
     */
    private function getFilterFor( $type )
    {
        return $this->filters()->{$type};
    }

    /**
     * Returns a map that contains all registered filters.
     *
     * @return Mol_DataType_Map
     */
    private function filters()
    {
        if( $this->filters === null) {
            $this->filters = new Mol_DataType_Map(array(), new Mol_Filter_Null());
            $this->registerDefaultFilters($this->filters);
        }
        return $this->filters;
    }

    /**
     * Registers the default filters.
     *
     * @param Mol_DataType_Map $filters
     */
    private function registerDefaultFilters( Mol_DataType_Map $filters )
    {
        $filters->register(new Mol_Filter_Cast('integer'), array('int', 'integer'));
        $filters->register(new Mol_Filter_Cast('double'),  array('float', 'double'));
        $options = array(
            'type'   => Zend_Filter_Boolean::ALL,
            'locale' => 'en'
        );
        $booleanFilter = new Zend_Filter_Boolean($options);
        $filters->register($booleanFilter, array('bool', 'boolean'));
    }

}

