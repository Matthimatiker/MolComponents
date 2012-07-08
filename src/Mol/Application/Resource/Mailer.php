<?php

/**
 * Mol_Application_Resource_Mailer
 *
 * @category PHP
 * @package Mol_Mail
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 01.07.2012
 */

/**
 * Initializes a mail factory that is used to create mails by templates.
 *
 * This resource depends on the following resources:
 * # view - Used for rendering mail templates.
 *
 * @category PHP
 * @package Mol_Mail
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 01.07.2012
 */
class Mol_Application_Resource_Mailer extends Zend_Application_Resource_ResourceAbstract
{
    
    /**
     * Creates a factory that is used for mail creation.
     *
     * @return Mol_Mail_Factory
     */
    public function init()
    {
        $templates = $this->getConfig($this->getConfigFiles());
        $view      = $this->prepare($this->getView());
        return $this->createFactory($templates, $view);
    }
    
    /**
     * Creates a mail factory that uses the provided template configurations
     * and renders mails via the given view object.
     *
     * @param Zend_Config $templates
     * @param Zend_View $view
     * @return Mol_Mail_Factory
     */
    protected function createFactory(Zend_Config $templates, Zend_View $view)
    {
        return new Mol_Mail_Factory($templates, $view);
    }
    
    /**
     * Creates the template configuration by merging the provided config files.
     *
     * @param array(string) $files
     * @return Zend_Config
     */
    protected function getConfig(array $files)
    {
        $templates = new Zend_Config(array(), true);
        foreach ($files as $file) {
            /* @var $file string */
            $config = new Zend_Config_Ini($file);
            $templates->merge($config);
        }
        return $templates;
    }
    
    /**
     * Returns paths to the configured template config paths.
     *
     * @return array(string)
     * @throws Zend_Application_Resource_Exception If a config file does not exist.
     */
    protected function getConfigFiles()
    {
        $files = $this->asList('templates');
        $valid = array_filter($files, 'is_file');
        if (count($valid) !== count($files)) {
            // At least one path does not point to an existing file.
            $notExisting = array_diff($files, $valid);
            $message = 'The following mail template configuration files do not exist: ' . implode(', ', $notExisting);
            throw new Zend_Application_Resource_Exception($message);
        }
        return $files;
    }

    /**
     * Returns the bootstrapped view.
     *
     * @return Zend_View
     */
    protected function getView()
    {
        $this->getBootstrap()->bootstrap('view');
        return $this->getBootstrap()->getResource('view');
    }
    
    /**
     * Prepares the view for usage as mail template renderer.
     *
     * Clones the provided view to avoid interference with default view
     * rendering (actions, layout, ...) and sets the configured script
     * paths.
     *
     * @param Zend_View $view
     * @return Zend_View
     */
    protected function prepare(Zend_View $view)
    {
        $view = clone $view;
        /* @var $view Zend_View */
        $view->setScriptPath($this->getScriptPaths());
        return $view;
    }

    /**
     * Returns the configured view script paths that contain the email templates.
     *
     * @return array(string)
     */
    protected function getScriptPaths()
    {
        return $this->asList('scripts');
    }
    
    /**
     * Returns the contents of the option $name as list.
     *
     * Returns an empty array if the option was not provided.
     *
     * @param string $name The option name.
     * @return array(string)
     */
    protected function asList($name)
    {
        $options = $this->getOptions();
        if (!isset($options[$name])) {
            return array();
        }
        if (!is_array($options[$name])) {
            return array($options[$name]);
        }
        return $options[$name];
    }
    
}