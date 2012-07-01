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
     * Checks if the factory uses the UTF-8 charset for mails per default.
     */
    public function testMailCharsetIsUtf8PerDefault()
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
    
    public function testCreateOmitsSubjectIfConfigurationIsNotAvailable()
    {
        
    }
    
    /**
     * Checks if the factory adds the configured to-recpients.
     */
    public function testCreateAddsConfiguredToRecipients()
    {
        
    }
    
    public function testCreateOmitsToRecipientsIfConfigurationIsNotAvailable()
    {
    
    }
    
    /**
     * Checks if the factory adds the configured cc-recpients.
     */
    public function testCreateAddsConfiguredCcRecipients()
    {
    
    }
    
    public function testCreateOmitsCcRecipientsIfConfigurationIsNotAvailable()
    {
    
    }
    
    /**
     * Checks if the factory adds the configured bcc-recpients.
     */
    public function testCreateAddsConfiguredBccRecipients()
    {
    
    }
    
    public function testCreateOmitsBccRecipientsIfConfigurationIsNotAvailable()
    {
    
    }
    
    /**
     * Checks if the factory sets the configured sender.
     */
    public function testCreateSetsConfiguredSender()
    {
        
    }
    
    public function testCreateOmitsSenderIfConfigurationIsNotAvailable()
    {
    
    }
    
    /**
     * Ensures that the factory uses the configured charset.
     */
    public function testCreateSetsConfiguredCharset()
    {
        
    }
    
    public function testCreateUsesDefaultCharsetIfConfigurationIsNotAvailable()
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
    
    public function testCreateOmitsTextScriptIfConfigurationIsNotAvailable()
    {
    
    }
    
    /**
     * Checks if create() renders the configured view script for the HTML version.
     */
    public function testCreateRendersConfiguredHtmlScript()
    {
        
    }
    
    public function testCreateOmitsHtmlScriptIfConfigurationIsNotAvailable()
    {
    
    }
    
}