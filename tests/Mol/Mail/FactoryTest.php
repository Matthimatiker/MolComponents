<?php

/**
 * Mol_Mail_FactoryTest
 *
 * @category PHP
 * @package Mol_Mail
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 01.07.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the mail factory.
 *
 * @category PHP
 * @package Mol_Mail
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 01.07.2012
 */
class Mol_Mail_FactoryTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Ensures that create() throws an exception if the provided template
     * does not exist.
     */
    public function testCreateThrowsExceptionIfTemplateDoesNotExist()
    {
        
    }
    
    /**
     * Ensures that create() returns a simple mail object without further
     * configuration if no template (parameter === null) is provided.
     */
    public function testCreateReturnsMailObjectsIfNoTemplateIsProvided()
    {
        
    }
    
    /**
     * Checks if the factory uses the view charset for mails per default.
     */
    public function testMailCharsetEqualsViewEncodingPerDefault()
    {
        
    }
    
    /**
     * Checks if the factory sets the configured subject.
     */
    public function testCreateSetsConfiguredSubject()
    {
        
    }
    
    /**
     * Ensures that the configured subject is translated.
     */
    public function testCreateTranslatesSubject()
    {
        
    }
    
    /**
     * Ensures that the factory omits the subject if no configuration is
     * available in the requested template.
     */
    public function testCreateOmitsSubjectIfConfigurationIsNotAvailable()
    {
        
    }
    
    /**
     * Checks if the factory adds the configured to-recpients.
     */
    public function testCreateAddsConfiguredToRecipients()
    {
        
    }
    
    /**
     * Ensures that the factory omits the to-recipients if no configuration is
     * available in the requested template.
     */
    public function testCreateOmitsToRecipientsIfConfigurationIsNotAvailable()
    {
    
    }
    
    /**
     * Checks if the factory adds the configured cc-recpients.
     */
    public function testCreateAddsConfiguredCcRecipients()
    {
    
    }
    
    /**
     * Ensures that the factory omits the cc-recipients if no configuration is
     * available in the requested template.
     */
    public function testCreateOmitsCcRecipientsIfConfigurationIsNotAvailable()
    {
    
    }
    
    /**
     * Checks if the factory adds the configured bcc-recpients.
     */
    public function testCreateAddsConfiguredBccRecipients()
    {
    
    }
    
    /**
     * Ensures that the factory omits the bcc-recipients if no configuration is
     * available in the requested template.
     */
    public function testCreateOmitsBccRecipientsIfConfigurationIsNotAvailable()
    {
    
    }
    
    /**
     * Checks if the factory sets the configured sender.
     */
    public function testCreateSetsConfiguredSender()
    {
        
    }
    
    /**
     * Ensures that the factory omits the sender if no configuration is
     * available in the requested template.
     */
    public function testCreateOmitsSenderIfConfigurationIsNotAvailable()
    {
    
    }
    
    /**
     * Ensures that the factory uses the configured charset.
     */
    public function testCreateSetsConfiguredCharset()
    {
        
    }
    
    /**
     * Ensures that create() uses the view charset if the requested
     * template does not provide a configuration value.
     */
    public function testCreateUsesViewCharsetIfConfigurationIsNotAvailable()
    {
    
    }
    
    /**
     * Ensures that create() throws an exception if a configured view script
     * does not exist.
     */
    public function testCreateThrowsExceptionIfConfiguredViewScriptIsNotAvailable()
    {
    
    }
    
    /**
     * Checks if create() passes the provided params to the view object.
     */
    public function testCreatePassesParametersToView()
    {
    
    }
    
    /**
     * Checks if create() renders the configured view script for the text version.
     */
    public function testCreateRendersConfiguredTextScript()
    {
        
    }
    
    /**
     * Ensures that the factory omits rendering the text template if it
     * is not configured in the requested template.
     */
    public function testCreateOmitsTextScriptIfConfigurationIsNotAvailable()
    {
    
    }
    
    /**
     * Checks if create() renders the configured view script for the HTML version.
     */
    public function testCreateRendersConfiguredHtmlScript()
    {
        
    }
    
    /**
     * Ensures that the factory omits rendering the HTML template if it
     * is not configured in the requested template.
     */
    public function testCreateOmitsHtmlScriptIfConfigurationIsNotAvailable()
    {
    
    }
    
}