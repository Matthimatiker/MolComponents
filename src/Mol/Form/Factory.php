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
 * == Usage ==
 *
 * === Creation ===
 *
 * The form factory does not require any constructor arguments.
 * Therefore, the following line is enough to create a new factory:
 * <code>
 * $factory = new Mol_Form_Factory();
 * </code>
 *
 * === Creating forms ===
 *
 * Without further configuration the factory is able to create forms
 * by class name:
 * <code>
 * // Creates a new Zend_Form instance.
 * $form = factory->create('Zend_Form');
 * </code>
 *
 * Each call to create() instantiates a new form, created instances
 * are not cached.
 *
 * === Aliases ===
 *
 * The method addAlias() can be used to register a form alias.
 *
 * Aliases point to form class names and can be passed to
 * create() instead of the full class name:
 * <code>
 * $factory->addAlias('login', 'My_Login_Form');
 * // Creates an instance of My_Login_Form.
 * $form = $factory->create('login');
 * </code>
 *
 * Names of form classes can also be used as alias.
 * That allows mostly transparently switching of form types by
 * configuration:
 * <code>
 * // Creates an instance of My_Login_Form.
 * $form = $factory->create('My_Login_Form');
 * $factory->addAlias('My_Login_Form', 'Another_Login_Form');
 * // Creates an instance of Another_Login_Form.
 * $form = $factory->create('My_Login_Form');
 * </code>
 *
 * === Plugins ===
 *
 * Plugins are used to improve just created forms.
 *
 * Any number of plugins can be added to the factory.
 * Instantiated forms are passed to each plugin.
 *
 * The method registerPlugin() is used to add a plugin
 * to the factory:
 * <code>
 * $factory->registerPlugin($myPluginInstance);
 * </code>
 *
 * Plugins must implement the Mol_Form_Factory_Plugin
 * interface.
 *
 * Plugins are applied in registration order.
 *
 * If an already existing form shall be enhanced by
 * plugins, then the form instance can be passed to
 * create():
 * <code>
 * $form = new Zend_Form();
 * $form = $factory->create($form);
 * </code>
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
     * Map from registered aliases to form classes or other aliases.
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
        $this->applyPlugins($form);
        return $form;
    }
    
    /**
     * Adds an alias that points to the provided form class.
     *
     * Alternatively the alias can point to another alias.
     * The factory will try to resolve alias chains at runtime.
     *
     * @param string $alias
     * @param string $aliasOrClass
     * @return Mol_Form_Factory Provides a fluent interface.
     */
    public function addAlias($alias, $aliasOrClass)
    {
        $this->aliases[$alias] = $aliasOrClass;
        return $this;
    }
    
    /**
     * Returns a list of registered aliases.
     *
     * The key is the alias, the value the form class or alias
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
     * Passes the given form to all registered plugins.
     *
     * @param Zend_Form $form
     */
    protected function applyPlugins(Zend_Form $form)
    {
        foreach ($this->plugins as $plugin) {
            /* @var $plugin Mol_Form_Factory_Plugin */
            $plugin->enhance($form);
        }
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
     * @throws RuntimeException If an alias circle is detected.
     */
    protected function resolveToClass($aliasOrClass)
    {
        /* @var array(string) List of already visited aliases. */
        $path = array();
        while (isset($this->aliases[$aliasOrClass])) {
            // Resolve existing alias.
            $path[] = $aliasOrClass;
            $aliasOrClass = $this->aliases[$aliasOrClass];
            if (in_array($aliasOrClass, $path)) {
                // Alias already visted, circle detected.
                $path[]  = $aliasOrClass;
                $message = 'Cannot resolve alias, circle detected: ' . implode(' -> ', $path);
                throw new RuntimeException($message);
            }
        }
        // $aliasOrClass is not an alias.
        return $aliasOrClass;
    }
    
}
