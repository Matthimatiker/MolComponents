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
     * The builder that is used to create forms.
     *
     * Contains null if the builder was not created yet.
     *
     * @var Mol_Util_ObjectBuilder|null
     */
    protected $builder = null;
    
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
        $form = $this->toForm($aliasOrClassOrForm);
        foreach ($this->plugins as $plugin) {
            /* @var $plugin Mol_Form_Factory_Plugin */
            $plugin->enhance($form);
        }
        return $form;
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
    
    /**
     * Converts the given alias, class or form instance
     * to a form object.
     *
     * @param string|Zend_Form $aliasOrClassOrForm
     * @return Zend_Form
     * @throws InvalidArgumentException If an invalid alias or class name is provided.
     */
    protected function toForm($aliasOrClassOrForm)
    {
        if ($aliasOrClassOrForm instanceof Zend_Form) {
            // Form instance provided.
            return $aliasOrClassOrForm;
        }
        if (is_string($aliasOrClassOrForm)) {
            // Alias or class name provided.
            $class = $this->resolveToClass($aliasOrClassOrForm);
            return $this->createForm($class);
        }
        $message = 'Expected alias or class name or Zend_Form instance, but received '
                 . 'argument of type "' . gettype($aliasOrClassOrForm) . '".';
        throw new InvalidArgumentException($message);
    }
    
    /**
     * Creates an instance of the given form class.
     *
     * @param string $class
     * @return Zend_Form
     */
    protected function createForm($class)
    {
        return $this->getFormBuilder()->create($class);
    }
    
    /**
     * Returns the builder object that is used to create form instances.
     *
     * If the builder does not exist yet it will be created.
     *
     * @return Mol_Util_ObjectBuilder
     */
    protected function getFormBuilder()
    {
        if ($this->builder === null) {
            $this->builder = new Mol_Util_ObjectBuilder('Zend_Form');
        }
        return $this->builder;
    }
    
    /**
     * Resolves the given alias to a class name.
     *
     * Returns the input value if no such alias exists.
     *
     * @param string $aliasOrClass
     * @return string The class name.
     */
    protected function resolveToClass($aliasOrClass)
    {
        if (isset($this->aliases[$aliasOrClass])) {
            // Resolve existing alias.
            return $this->aliases[$aliasOrClass];
        }
        // Alias does not exist.
        return $aliasOrClass;
    }
    
}
