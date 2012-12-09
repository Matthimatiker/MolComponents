<?php

/**
 * Mol_Application_Resource_Form
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
 * Initializes the form factory.
 *
 * This resource allows the configuration of aliases and
 * factory plugins.
 *
 * # Usage #
 *
 * ## Activation ##
 *
 * The following line is enough to activate the form factory:
 *
 *     resources.form = On
 *
 * ## Adding aliases ##
 *
 * Additionally aliases can be configured:
 *
 *     resources.form.aliases.login        = "My_Login_Form"
 *     resources.form.aliases.registration = "My_Registration_Form"
 *
 * The alias must be used as key, the form class that it
 * points to as value.
 *
 * ## Configuring plugins ##
 *
 * To enhance form that are created by the factory, plugins can
 * be used.
 *
 * The following line activates a plugin without providing
 * further plugin options:
 *
 *     resources.form.plugins.myPlugin = "My_Form_Factory_Plugin"
 *
 * Any key can be used for plugin registration, but the value
 * must be the name of a class that implements the interface
 * Mol_Form_Factory_Plugin.
 *
 * To provide additional plugin options, the configuration
 * must use the "class" and "options" keys:
 *
 *     resources.form.plugins.myPlugin.class = "My_Form_Factory_Plugin"
 *     resources.form.plugins.myPlugin.options.name   = "Earl"
 *     resources.form.plugins.myPlugin.options.filter = On
 *
 * In this case the name of the plugin class is assigned to
 * the "class" key. The "options" key must be any map or
 * array of plugin options. These options will be directly
 * passed to the plugin constructor.
 *
 * ## Bootstrapper injection into plugins ##
 *
 * If the plugin class implements Mol_Application_Bootstrap_Aware,
 * then the resource will inject the bootstrapper into the created
 * plugin.
 *
 * @category PHP
 * @package Mol_Form
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 01.10.2012
 */
class Mol_Application_Resource_Form extends Zend_Application_Resource_ResourceAbstract
{
    
    /**
     * Builder that is used to create plugins or null if it
     * was not created yet.
     *
     * @var Mol_Util_ObjectBuilder|null
     */
    protected $pluginBuilder = null;
    
    /**
     * Injector that is used to push the bootstrapper into plugins or
     * null if the injector was not created yet.
     *
     * @var Mol_Application_Bootstrap_Injector|null
     */
    protected $bootstrapInjector = null;
    
    /**
     * Creates a pre-configured form factory.
     *
     * @return Mol_Form_Factory
     */
    public function init()
    {
        $factory = $this->createFactory();
        foreach ($this->createAliases() as $alias => $class) {
            /* @var $alias string */
            /* @var $class string */
            $factory->addAlias($alias, $class);
        }
        foreach ($this->createPlugins() as $plugin) {
            /* @var $plugin Mol_Form_Factory_Plugin */
            $factory->registerPlugin($plugin);
        }
        return $factory;
    }
    
    /**
     * Creates a form factory.
     *
     * @return Mol_Form_Factory
     */
    protected function createFactory()
    {
        return new Mol_Form_Factory();
    }
    
    /**
     * Creates a map of aliases that will be added to the factory.
     *
     * @return array(string=>string)
     */
    protected function createAliases()
    {
        $options = $this->getOptions();
        if (!isset($options['aliases'])) {
            return array();
        }
        return $options['aliases'];
    }
    
    /**
     * Creates the plugins that are registered at the factory.
     *
     * @return array(Mol_Form_Factory_Plugin)
     * @throws Zend_Application_Resource_Exception If plugin creation fails.
     */
    protected function createPlugins()
    {
        $options = $this->getOptions();
        if (!isset($options['plugins'])) {
            return array();
        }
        $plugins = array();
        foreach ($options['plugins'] as $pluginConfig) {
            /* @var $pluginConfig string|array(string=>mixed) */
            try {
                $plugins[] = $this->toPlugin($pluginConfig);
            } catch (InvalidArgumentException $e) {
                throw new Zend_Application_Resource_Exception('Cannot create plugin.', 0, $e);
            }
        }
        return $plugins;
    }
    
    /**
     * Uses the given configuration to create a factory plugin.
     *
     * The configuration can be:
     *
     * * a string (plugin class, no options)
     * * an array with the following keys:
     *   * class (string, plugin class)
     *   * options (array, plugin options, optional)
     *
     * @param string|array(string=>mixed) $config
     * @return Mol_Form_Factory_Plugin
     * @throws Zend_Application_Resource_Exception If an invalid configuration is provided.
     */
    protected function toPlugin($config)
    {
        if (is_string($config)) {
            // Plugin class provided.
            return $this->createPlugin($config, array());
        }
        if (!isset($config['class'])) {
            $message = 'Plugin class is not configured.';
            throw new Zend_Application_Resource_Exception($message);
        }
        if (!isset($config['options'])) {
            $config['options'] = array();
        }
        if (!is_array($config['options'])) {
            $message = 'Plugin options must be provided as array.';
            throw new Zend_Application_Resource_Exception($message);
        }
        return $this->createPlugin($config['class'], $config['options']);
    }
    
    /**
     * Uses the given class and options to create a plugin instance,
     *
     * @param string $class
     * @param array(string=>mixed) $options
     * @return Mol_Form_Factory_Plugin
     */
    protected function createPlugin($class, array $options)
    {
        $plugin = $this->getPluginBuilder()->create($class, array($options));
        return $this->getBootstrapInjector()->inject($plugin);
    }
    
    /**
     * Returns the builder that is used to create plugin instances.
     *
     * @return Mol_Util_ObjectBuilder
     */
    protected function getPluginBuilder()
    {
        if ($this->pluginBuilder === null) {
            $this->pluginBuilder = new Mol_Util_ObjectBuilder('Mol_Form_Factory_Plugin');
        }
        return $this->pluginBuilder;
    }
    
    /**
     * Returns the injector that is used to push the bootstrapper into plugins.
     *
     * @return Mol_Application_Bootstrap_Injector
     */
    protected function getBootstrapInjector()
    {
        if ($this->bootstrapInjector === null) {
            $this->bootstrapInjector = new Mol_Application_Bootstrap_Injector($this->getBootstrap());
        }
        return $this->bootstrapInjector;
    }
    
}
