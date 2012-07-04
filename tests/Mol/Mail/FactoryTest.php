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
     * System under test.
     *
     * @var Mol_Mail_Factory
     */
    protected $factory = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->factory = new Mol_Mail_Factory($this->createConfig(), $this->createView());
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->factory = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that create() throws an exception if the provided template
     * does not exist.
     */
    public function testCreateThrowsExceptionIfTemplateDoesNotExist()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->factory->create('missing');
    }
    
    /**
     * Ensures that create() returns a simple mail object without further
     * configuration if no template (parameter === null) is provided.
     */
    public function testCreateReturnsMailObjectsIfNoTemplateIsProvided()
    {
        $mail = $this->factory->create();
        $this->assertInstanceOf('Zend_Mail', $mail);
    }
    
    /**
     * Checks if the factory uses the view charset for mails per default.
     */
    public function testMailCharsetEqualsViewEncodingPerDefault()
    {
        $mail = $this->factory->create();
        $this->assertInstanceOf('Zend_Mail', $mail);
        $this->assertEquals('UTF-8', $mail->getCharset());
    }
    
    /**
     * Checks if the factory sets the configured subject.
     */
    public function testCreateSetsConfiguredSubject()
    {
        $mail = $this->factory->create('hello');
        $this->assertInstanceOf('Zend_Mail', $mail);
        $this->assertEquals('Hello world!', $mail->getSubject());
    }
    
    /**
     * Ensures that the configured subject is translated.
     */
    public function testCreateTranslatesSubject()
    {
        $mail = $this->factory->create('subject-translation');
        $this->assertInstanceOf('Zend_Mail', $mail);
        $this->assertEquals('translated', $mail->getSubject());
    }
    
    /**
     * Ensures that the factory omits the subject if no configuration is
     * available in the requested template.
     */
    public function testCreateOmitsSubjectIfConfigurationIsNotAvailable()
    {
        $mail = $this->factory->create('empty');
        $this->assertInstanceOf('Zend_Mail', $mail);
        $this->assertEmpty($mail->getSubject());
    }
    
    /**
     * Checks if the factory adds the configured to-recpients.
     */
    public function testCreateAddsConfiguredToRecipients()
    {
        $mail = $this->factory->create('hello');
        $this->assertHasHeader($mail, 'To', 2);
        $recipients = $mail->getRecipients();
        $this->assertContains('user@example.org', $recipients);
        $this->assertContains('second-user@example.org', $recipients);
    }
    
    /**
     * Ensures that the factory omits the to-recipients if no configuration is
     * available in the requested template.
     */
    public function testCreateOmitsToRecipientsIfConfigurationIsNotAvailable()
    {
        $mail = $this->factory->create('empty');
        $this->assertHasHeader($mail, 'To', 0);
        $this->assertEquals(array(), $mail->getRecipients());
    }
    
    /**
     * Checks if the factory adds the configured cc-recpients.
     */
    public function testCreateAddsConfiguredCcRecipients()
    {
        $mail = $this->factory->create('hello');
        $this->assertHasHeader($mail, 'Cc', 1);
        $recipients = $mail->getRecipients();
        $this->assertContains('another.user@example.org', $recipients);
    }
    
    /**
     * Ensures that the factory omits the cc-recipients if no configuration is
     * available in the requested template.
     */
    public function testCreateOmitsCcRecipientsIfConfigurationIsNotAvailable()
    {
        $mail = $this->factory->create('empty');
        $this->assertHasHeader($mail, 'Cc', 0);
        $this->assertEquals(array(), $mail->getRecipients());
    }
    
    /**
     * Checks if the factory adds the configured bcc-recpients.
     */
    public function testCreateAddsConfiguredBccRecipients()
    {
        $mail = $this->factory->create('hello');
        $this->assertHasHeader($mail, 'Bcc', 1);
    }
    
    /**
     * Ensures that the factory omits the bcc-recipients if no configuration is
     * available in the requested template.
     */
    public function testCreateOmitsBccRecipientsIfConfigurationIsNotAvailable()
    {
        $mail = $this->factory->create('empty');
        $this->assertHasHeader($mail, 'Bcc', 0);
        $this->assertEquals(array(), $mail->getRecipients());
    }
    
    /**
     * Checks if the factory sets the configured sender.
     */
    public function testCreateSetsConfiguredSender()
    {
        $mail = $this->factory->create('hello');
        $this->assertInstanceOf('Zend_Mail', $mail);
        $this->assertEquals('mailer@example.org', $mail->getFrom());
    }
    
    /**
     * Ensures that the factory omits the sender if no configuration is
     * available in the requested template.
     */
    public function testCreateOmitsSenderIfConfigurationIsNotAvailable()
    {
        $mail = $this->factory->create('empty');
        $this->assertInstanceOf('Zend_Mail', $mail);
        $this->assertNull($mail->getFrom());
    }
    
    /**
     * Ensures that the factory uses the configured charset.
     */
    public function testCreateSetsConfiguredCharset()
    {
        $mail = $this->factory->create('hello');
        $this->assertInstanceOf('Zend_Mail', $mail);
        $this->assertEquals('ISO-8859-1', $mail->getCharset());
    }
    
    /**
     * Ensures that create() uses the view charset if the requested
     * template does not provide a configuration value.
     */
    public function testCreateUsesViewCharsetIfConfigurationIsNotAvailable()
    {
        $mail = $this->factory->create('empty');
        $this->assertInstanceOf('Zend_Mail', $mail);
        $this->assertEquals('UTF-8', $mail->getCharset());
    }
    
    /**
     * Ensures that create() throws an exception if a configured text view script
     * does not exist.
     */
    public function testCreateThrowsExceptionIfConfiguredTextViewScriptIsNotAvailable()
    {
        $this->setExpectedException('Zend_View_Exception');
        $this->factory->create('invalid-text-script');
    }
    
    /**
     * Ensures that create() throws an exception if a configured html view script
     * does not exist.
     */
    public function testCreateThrowsExceptionIfConfiguredHtmlViewScriptIsNotAvailable()
    {
        $this->setExpectedException('Zend_View_Exception');
        $this->factory->create('invalid-html-script');
    }
    
    /**
     * Checks if create() renders the configured view script for the text version.
     */
    public function testCreateRendersConfiguredTextScript()
    {
        $mail = $this->factory->create('hello');
        $this->assertInstanceOf('Zend_Mail', $mail);
        $this->assertEquals('Text template', $mail->getBodyText(true));
    }
    
    /**
     * Ensures that the factory omits rendering the text template if it
     * is not configured in the requested template.
     */
    public function testCreateOmitsTextScriptIfConfigurationIsNotAvailable()
    {
        $mail = $this->factory->create('empty');
        $this->assertInstanceOf('Zend_Mail', $mail);
        $this->assertEmpty($mail->getBodyText(true));
    }
    
    /**
     * Checks if create() renders the configured view script for the HTML version.
     */
    public function testCreateRendersConfiguredHtmlScript()
    {
        $mail = $this->factory->create('hello');
        $this->assertInstanceOf('Zend_Mail', $mail);
        $this->assertEquals('HTML template', $mail->getBodyHtml(true));
    }
    
    /**
     * Ensures that the factory omits rendering the HTML template if it
     * is not configured in the requested template.
     */
    public function testCreateOmitsHtmlScriptIfConfigurationIsNotAvailable()
    {
        $mail = $this->factory->create('empty');
        $this->assertInstanceOf('Zend_Mail', $mail);
        $this->assertEmpty($mail->getBodyHtml(true));
    }
    
    /**
     * Checks if create() passes the provided params to the text script.
     */
    public function testCreatePassesParametersToTextView()
    {
        $mail = $this->factory->create('view-parameters', array('param' => 'testing'));
        $this->assertInstanceOf('Zend_Mail', $mail);
        $body = $mail->getBodyText(true);
        $this->assertInternalType('string', $body);
        $this->assertContains('testing', $body);
    }
    
    /**
     * Checks if create() passes the provided params to the HTML script.
     */
    public function testCreatePassesParametersToHtmlView()
    {
        $mail = $this->factory->create('view-parameters', array('param' => 'testing'));
        $this->assertInstanceOf('Zend_Mail', $mail);
        $body = $mail->getBodyHtml(true);
        $this->assertInternalType('string', $body);
        $this->assertContains('testing', $body);
    }
    
    /**
     * Creates template configurations for testing.
     *
     * @return Zend_Config
     */
    protected function createConfig()
    {
        $templates = array(
            // Template with all possible settings.
            'hello' => array(
                'charset' => 'ISO-8859-1',
                'subject' => 'Hello world!',
                'to' => array(
                    'user@example.org',
                    'second-user@example.org'
                ),
                'cc' => array(
                    'another.user@example.org'
                ),
                'bcc' => array(
                    'archive@example.com'
                ),
                'sender' => 'mailer@example.org',
                'script' => array(
                    'text' => 'hello.text.phtml',
                    'html' => 'hello.html.phtml'
                )
            ),
            // An empty template.
            'empty' => array(),
            'invalid-text-script' => array(
                'script' => array(
                    'text' => 'missing.phtml'
                )
            ),
            'invalid-html-script' => array(
                'script' => array(
                    'html' => 'missing.phtml'
                )
            ),
            'view-parameters' => array(
                'script' => array(
                    'text' => 'parameter.phtml',
                    'html' => 'parameter.phtml'
                )
            ),
            'subject-translation' => array(
                'subject' => 'subjectMsgId'
            )
        );
        return new Zend_Config($templates);
    }
    
    /**
     * Creates a view for testing.
     *
     * @return Zend_View
     */
    protected function createView()
    {
        $view = new Zend_View();
        $view->setEncoding('UTF-8');
        $view->setScriptPath(dirname(__FILE__) . '/TestData');
        
        // Register a translator for testing.
        $translatorOptions = array(
            'adapter' => 'array',
            'content' =>  array('subjectMsgId' => 'translated'),
            'locale'  => 'en'
        );
        $translator = new Zend_Translate($translatorOptions);
        $view->registerHelper(new Zend_View_Helper_Translate($translator), 'translate');
        
        return $view;
    }
    
    /**
     * Asserts that the mail has the expected number of headers
     * of type $name.
     *
     * @param Zend_Mail $mail
     * @param string $name
     * @param integer $expectedNumber
     */
    protected function assertHasHeader($mail, $name, $expectedNumber)
    {
        $this->assertInstanceOf('Zend_Mail', $mail);
        $headers = $mail->getHeaders();
        $this->assertArrayHasKey($name, $headers);
        $message = 'Unexpected number of headers of type "' . $name . '".';
        $this->assertEquals($expectedNumber, count($headers[$name]), $message);
    }
    
}