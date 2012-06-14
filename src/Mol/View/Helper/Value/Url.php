<?php

/**
 * View_Helper_Value_Url
 *
 * @category PHP
 * @package Mol_View
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 17.10.2010
 */

/**
 * Contains url data and generates the url if it is casted to a string.
 *
 * @category PHP
 * @package Mol_View
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 17.10.2010
 */
class Mol_View_Helper_Value_Url
{
    /**
     * The view object that is used to access other url helpers.
     *
     * @var Zend_View_Interface
     */
    protected $view = null;

    /**
     * The url parameters.
     *
     * The name is used as key, the value contains the parameter.
     *
     * @var array(string=>string)
     */
    protected $params = array();

    /**
     * The name of the route that is used.
     *
     * If $route is null then the current route is used.
     *
     * @var string|null
     */
    protected $route = null;

    /**
     * Flag that indicates if the current request params will be resetted.
     *
     * @var boolean
     */
    protected $resetParams = true;

    /**
     * The used anchor.
     *
     * Is null if no anchor is used.
     *
     * @var string|null
     */
    protected $anchor = null;

    /**
     * Creates a object that represents a url.
     *
     * @param Zend_View_Interface $view
     */
    public function __construct(Zend_View_Interface $view )
    {
        $this->view = $view;
    }

    /**
     * Adds the parameter $name with the value $value to this url.
     *
     * @param string $name
     * @param string $value
     * @return Mol_View_Helper_Value_Url Provides a fluent interface.
     */
    public function withParam($name, $value )
    {
        $this->params[$name] = (string)$value;
        return $this;
    }

    /**
     * Ensures that the route $name is used.
     *
     * @param string $name
     * @return Mol_View_Helper_Value_Url Provides a fluent interface.
     */
    public function withRoute($name )
    {
        $this->route = $name;
        return $this;
    }

    /**
     * Add the anchor $name to this url.
     *
     * @param string $name
     * @return Mol_View_Helper_Value_Url Provides a fluent interface.
     */
    public function withAnchor($name )
    {
        $this->anchor = $name;
        return $this;
    }

    /**
     * Ensures that all parameters that where present when the page was
     * requested are added to the url.
     *
     * @return Mol_View_Helper_Value_Url Provides a fluent interface.
     */
    public function keepParams()
    {
        $this->resetParams = false;
        return $this;
    }

    /**
     * Returns the url as string.
     *
     * @return string
     */
    public function __toString()
    {
        $anchor = ($this->anchor === null) ? '' : '#' . $this->anchor;
        return $this->view->url($this->params, $this->route, $this->resetParams) . $anchor;
    }

}

