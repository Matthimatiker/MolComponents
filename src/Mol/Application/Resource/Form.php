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
     * # a string (plugin class, no options)
     * # an array
     *   # class (string, plugin class)
     *   # options (array, plugin options, optional)
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
        return $this->getPluginBuilder()->create($class, array($options));
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
    
}
