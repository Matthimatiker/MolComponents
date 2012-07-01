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
    
    public function testCreateThrowsExceptionIfTemplateDoesNotExist()
    {
        
    }
    
    public function testCreateReturnsMailObjectsIfNoTemplateIsProvided()
    {
        
    }
    
    public function testMailCharsetIsUtf8PerDefault()
    {
        
    }
    
    public function testCreateSetsConfiguredSubject()
    {
        
    }
    
    public function testCreateTranslatesSubject()
    {
        
    }
    
    public function testCreateAddsConfiguredToRecipients()
    {
        
    }
    
    public function testCreateAddsConfiguredCcRecipients()
    {
    
    }
    
    public function testCreateAddsConfiguredBccRecipients()
    {
    
    }
    
    public function testCreateSetsConfiguredSender()
    {
        
    }
    
    public function testCreateSetsConfiguredCharset()
    {
        
    }
    
    public function testCreateThrowsExceptionIfConfiguredViewScriptIsNotAvailable()
    {
    
    }
    
    public function testCreatePassesParametersToView()
    {
    
    }
    
    public function testCreateRendersConfiguredTextScript()
    {
        
    }
    
    public function testCreateRendersConfiguredHtmlScript()
    {
        
    }
    
}