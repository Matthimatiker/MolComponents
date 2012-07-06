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
        $this->resource->setOptions(array());
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
        
    }
    
    /**
     * Ensures that the original view that is provided by the bootstrapper
     * is not modified.
     */
    public function testResourceDoesNotModifyScriptPathOfOriginalView()
    {
        
    }
    
    /**
     * Checks if the resource merges the configured config files.
     */
    public function testResourceMergesProvidedConfigurationFiles()
    {
        
    }
    
    /**
     * Ensures that the resource uses the configured script paths.
     */
    public function testResourceSetsConfiguredScriptPaths()
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
    
}
