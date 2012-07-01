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
        
    }
    
    /**
     * Creates the template configuration by merging the provided config files.
     *
     * @param array(string) $files
     * @return Zend_Config
     */
    protected function getConfig(array $files)
    {
        
    }
    
    /**
     * Returns paths to the configured template config paths.
     *
     * @return array(string)
     * @throws Zend_Application_Resource_Exception If a config file does not exist.
     */
    protected function getConfigFiles()
    {
        
    }

    /**
     * Returns the bootstrapped view.
     *
     * @return Zend_View
     */
    protected function getView()
    {
        
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
    
    }

    /**
     * Returns the configured view script paths that contain the email templates.
     *
     * @return array(string)
     */
    protected function getScriptPaths()
    {
        
    }
    
}