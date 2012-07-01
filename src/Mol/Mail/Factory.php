<?php

/**
 * Mol_Mail_Factory
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
 * Factory that uses template configurations to create pre-filled mail objects.
 *
 * @category PHP
 * @package Mol_Mail
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 01.07.2012
 */
class Mol_Mail_Factory
{
    
    /**
     * Creates the factory.
     *
     * @param Zend_Config $templates The template configurations.
     * @param Zend_View $view View that is used to render mail contents.
     */
    public function __construct(Zend_Config $templates, Zend_View $view)
    {
        
    }
    
    /**
     * Uses the provided template to create a pre-configured mail object.
     *
     * If $template is null then a mail object without further configuration
     * will be returned.
     *
     * The provided parameters will be passed to the view scripts that
     * are used to render the mail contents (if configured).
     *
     * @param string|null $template The name of the template.
     * @param array(string=>mixed) $parameters The view parameters.
     * @return Zend_Mail
     */
    public function create($template = null, array $parameters = array())
    {
        
    }
    
    /**
     * Uses the given configuration to prepare a mail object.
     *
     * @param Zend_Config $configuration The template configuration.
     * @param array(string=>mixed) $parameters The view parameters.
     * @return Zend_Mail The configured mail object.
     */
    protected function createMailFrom(Zend_Config $configuration, array $parameters)
    {
        
    }
    
    /**
     * Returns the configuration of the provided template.
     *
     * @param string $template The name of the template.
     * @return Zend_Config
     * @throws InvalidArgumentException If the template does not exist.
     */
    protected function getConfigFor($template)
    {
        
    }
    
    /**
     * Creates a mail object without further configuration.
     *
     * Can be overwritten to work with more specific mail objects.
     *
     * @return Zend_Mail
     */
    protected function createMail()
    {
        
    }
    
}
