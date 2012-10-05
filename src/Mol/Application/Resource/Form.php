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
        return array();
    }
    
    /**
     * Creates the plugins that are registered at the factory.
     *
     * @return array(Mol_Form_Factory_Plugin)
     */
    protected function createPlugins()
    {
        return array();
    }
    
}
