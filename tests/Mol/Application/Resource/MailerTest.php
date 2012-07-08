<?php

/**
 * Mol_Application_Resource_MailerTest
 *
 * @category PHP
 * @package Mol_Mail
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 05.07.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the mailer resource.
 *
 * @category PHP
 * @package Mol_Mail
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 05.07.2012
 */
class Mol_Application_Resource_MailerTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var Mol_Application_Resource_Mailer
     */
    protected $resource = null;
    
    /**
     * The bootstrapper that is used to simulate resources.
     *
     * @var Mol_Test_Bootstrap
     */
    protected $bootstrapper = null;

    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->bootstrapper = $this->createBootstrapper();
        $this->resource     = new Mol_Application_Resource_Mailer();
        $this->resource->setBootstrap($this->bootstrapper);
        $this->resource->setOptions($this->createOptions());
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->resource     = null;
        $this->bootstrapper = null;
        parent::tearDown();
    }
    
    /**
     * Checks if init() returns a mail factory.
     */
    public function testInitReturnsFactory()
    {
        $factory = $this->resource->init();
        $this->assertInstanceOf('Mol_Mail_Factory', $factory);
    }
    
    /**
     * Ensures that the resource creates a factory even if neither template
     * configurations nor script paths were provided.
     */
    public function testInitReturnsFactoryEvenIfNoOptionsWereProvided()
    {
        // Equals the following configuration:
        // resources.mailer = On
        $this->resource->setOptions(array(true));
        $factory = $this->resource->init();
        $this->assertInstanceOf('Mol_Mail_Factory', $factory);
    }
    
    /**
     * Ensures that an exception is thrown if a referenced template configuration
     * file does not exist.
     */
    public function testResourceThrowsExceptionIfReferencedConfigurationFileDoesNotExist()
    {
        $this->setExpectedException('Zend_Application_Resource_Exception');
        $options = $this->createOptions();
        $options['templates'] = array($this->toPath('missing.ini'));
        $this->resource->setOptions($options);
        $this->resource->init();
    }
    
    /**
     * Ensures that the original view that is provided by the bootstrapper
     * is not modified.
     */
    public function testResourceDoesNotModifyScriptPathOfOriginalView()
    {
        $previous = $this->getView()->getScriptPaths();
        $this->resource->init();
        $this->assertEquals($previous, $this->getView()->getScriptPaths());
    }
    
    /**
     * Ensures that the templates in the first configuration file are not lost
     * when the second one is added.
     */
    public function testTemplatesFromPreviousConfigurationsAreNotLost()
    {
        $factory = $this->resource->init();
        $this->assertInstanceOf('Mol_Mail_Factory', $factory);
        $mail = $factory->create('a');
        $this->assertInstanceOf('Zend_Mail', $mail);
        $this->assertEquals('Mail A', $mail->getSubject());
    }
    
    /**
     * Checks if the templates from the second configuration file are added.
     */
    public function testTemplatesFromFollowingConfigurationsAreAdded()
    {
        $factory = $this->resource->init();
        $this->assertInstanceOf('Mol_Mail_Factory', $factory);
        $mail = $factory->create('c');
        $this->assertInstanceOf('Zend_Mail', $mail);
        $this->assertEquals('Mail C', $mail->getSubject());
    }
    
    /**
     * Ensures that the second configuration file overwrites the template settings in
     * the first one if both declare the same template.
     */
    public function testFollowingTemplateConfigurationsOverwritePreviousOnesIfConflictOccurs()
    {
        $factory = $this->resource->init();
        $this->assertInstanceOf('Mol_Mail_Factory', $factory);
        $mail = $factory->create('b');
        $this->assertInstanceOf('Zend_Mail', $mail);
        $this->assertEquals('Mail B, modified', $mail->getSubject());
    }
    
    /**
     * Ensures that the resource uses the configured script paths.
     */
    public function testResourceSetsConfiguredScriptPaths()
    {
        $factory = $this->resource->init();
        $this->assertInstanceOf('Mol_Mail_Factory', $factory);
        $view = $factory->getView();
        $this->assertInstanceOf('Zend_View', $view);
        $expected = array($this->getTestDataPath() . '/');
        $this->assertEquals($expected, $view->getScriptPaths());
    }
    
    /**
     * Ensures that the resource does not pass the original view
     * to the mail factory.
     */
    public function testResourceDoesNotInjectOriginalViewIntoFactory()
    {
        $factory = $this->resource->init();
        $this->assertInstanceOf('Mol_Mail_Factory', $factory);
        $view = $factory->getView();
        $this->assertNotSame($this->getView(), $view);
    }
    
    /**
     * Ensures that the resource accepts a single template configuration
     * file as "templates" option.
     */
    public function testResourceAcceptsSingleTemplateFileAsArgument()
    {
        
    }
    
    /**
     * Ensures that the resource accepts a single view script path
     * as "scripts" option.
     */
    public function testResourceAcceptsSingleScriptPathAsArgument()
    {
        
    }
    
    /**
     * Creates a bootstrapper for testing.
     *
     * @return Mol_Test_Bootstrap
     */
    protected function createBootstrapper()
    {
        $bootstrapper = Mol_Test_Bootstrap::create();
        $bootstrapper->simulateResource('view', new Zend_View());
        return $bootstrapper;
    }
    
    /**
     * Returns the simulated view.
     *
     * @return Zend_View
     */
    protected function getView()
    {
        return $this->bootstrapper->getResource('view');
    }
    
    /**
     * Creates resource options for testing.
     *
     * @return array(string=>mixed)
     */
    protected function createOptions()
    {
        $options = array(
            'templates' => array(
                $this->toPath('mailer-a.ini'),
                $this->toPath('mailer-b.ini')
            ),
            'scripts' => array(
               $this->getTestDataPath()
            )
        );
        return $options;
    }
    
    /**
     * Returns the path to the provided test file.
     *
     * Test files are located in TestData/Mailer.
     *
     * @param string $file The file name.
     * @return string
     */
    protected function toPath($file)
    {
        return $this->getTestDataPath() . '/' . $file;
    }
    
    /**
     * Returns the path of the test data directory.
     *
     * @return string
     */
    protected function getTestDataPath()
    {
        return dirname(__FILE__) . '/TestData/Mailer';
    }
    
}
