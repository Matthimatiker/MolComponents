<?php

/**
 * Mol_Form_Factory
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.10.2012
 */

/**
 * Factory that creates form instances.
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.10.2012
 */
class Mol_Form_Factory
{
    
    /**
     * Map from registered aliases to form classes.
     *
     * @var array(string=>string)
     */
    protected $aliases = array();
    
    /**
     * List of registered plugins.
     *
     * @var Mol_Form_Factory_Plugin
     */
    protected $plugins = array();
    
    /**
     * Creates the requested form.
     *
     * The provided argument can be...
     * # an alias that points to a class name
     * # a class name
     * # a form instance
     *
     * If a form instance is given then it will be passed
     * to all registered plugins and returned afterwards.
     *
     * @param string|Zend_Form $aliasOrClassOrForm
     * @return Zend_Form
     */
    public function create($aliasOrClassOrForm)
    {
        
    }
    
    /**
     * Adds an alias that points to the provided form class.
     *
     * @param string $alias
     * @param string $class
     * @return Mol_Form_Factory Provides a fluent interface.
     */
    public function addAlias($alias, $class)
    {
        $this->aliases[$alias] = $class;
        return $this;
    }
    
    /**
     * Returns a list of registered aliases.
     *
     * The key is the alias, the value the form class
     * that the alias points to.
     *
     * @return array(string=>string)
     */
    public function getAliases()
    {
        return $this->aliases;
    }
    
    /**
     * Registers the provided plugin.
     *
     * @param Mol_Form_Factory_Plugin $plugin
     * @return Mol_Form_Factory Provides a fluent interface.
     */
    public function registerPlugin(Mol_Form_Factory_Plugin $plugin)
    {
        $this->plugins[] = $plugin;
        return $this;
    }
    
    /**
     * Returns a registered plugins.
     *
     * @return array(Mol_Form_Factory_Plugin)
     */
    public function getPlugins()
    {
        return $this->plugins;
    }
    
}
