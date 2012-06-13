<?php

/**
 * Mol_View_Helper_FaviconTest
 *
 * @category PHP
 * @package Mol_View
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @version $Rev: 437 $
 * @since 29.04.2011
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the Favicon view helper.
 *
 * @category PHP
 * @package Mol_View
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @version $Rev: 437 $
 * @since 29.04.2011
 */
class Mol_View_Helper_FaviconTest extends PHPUnit_Framework_TestCase
{
    /**
     * System under test.
     *
     * @var Mol_View_Helper_Favicon
     */
    protected $helper = null;

    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->helper = new Mol_View_Helper_Favicon();
        $this->helper->setView(new Zend_View());
    }

    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->helper = null;
        parent::tearDown();
    }

    /**
     * Tests if the entry method favicon() provides a fluent interface.
     */
    public function testFaviconMethodProvidesFluentInterface()
    {
        $this->assertSame($this->helper, $this->helper->favicon('/favicon.ico'));
    }

    /**
     * Ensures that the entry method favicon provides a fluent interface
     * even if the icon url is omitted.
     */
    public function testFaviconMethodProvidesFluentInterfaceIfUrlIsOmitted()
    {
        $this->assertSame($this->helper, $this->helper->favicon());
    }

    /**
     * Tests if the __toString() method generates content.
     */
    public function testToStringGeneratesContent()
    {
        $content = (string)$this->helper->favicon('/favicon.ico');
        $this->assertGreaterThan(0, strlen($content), 'Generated content is empty.');
    }

    /**
     * Tests if the __toString() method generates HTML.
     */
    public function testToStringGeneratesValidHtml()
    {
        $html = (string)$this->helper->favicon('/favicon.ico');
        // If a valid head element was created the string without
        // its tags must be empty.
        $this->assertEquals('', strip_tags($html));
    }

    /**
     * Tests if the __toString() method generates a link tag.
     */
    public function testToStringGeneratesLinkTag()
    {
        $html = (string)$this->helper->favicon('/favicon.ico');
        $this->assertStringStartsWith('<link', $html);
    }

    /**
     * Checks if the generated HTML contains the favicon url.
     */
    public function testGeneratedMarkupContainsFaviconUrl()
    {
        $html = (string)$this->helper->favicon('/favicon.ico');
        $this->assertContains('/favicon.ico', $html);
    }

    /**
     * Ensures that the last url is used if the helper was
     * called multiple times.
     */
    public function testLastFaviconUrlIsUsed()
    {
        $this->helper->favicon('/favicon.ico');
        $html = (string)$this->helper->favicon('/another_icon.ico');
        $this->assertContains('/another_icon.ico', $html);
    }

    /**
     * Ensures that the helper does not render multiple link tags if it
     * was called more often than once.
     */
    public function testHelperDoesNotRenderMultipleElementsIfItWasCalledMultipleTimes()
    {
        $this->helper->favicon('/favicon.ico');
        $html = (string)$this->helper->favicon('/another_icon.ico');
        // Generated code must not contain the url from the first call.
        $this->assertNotContains('/favicon.ico', $html);
    }

    /**
     * Ensures that the helper does nmot reset a previously provided
     * icon url if favicon() is called again without argument.
     */
    public function testHelperDoesNotResetFaviconUrlIfParameterIsOmitted()
    {
        $this->helper->favicon('/favicon.ico');
        $html = (string)$this->helper->favicon();
        $this->assertContains('/favicon.ico', $html);
    }

    /**
     * Ensures that the helper does not create any HTML if no icon url
     * was provided previously.
     */
    public function testHelperGeneratesEmptyStringIfNoIconUrlWasProvided()
    {
        $content = (string)$this->helper->favicon();
        $this->assertEquals('', $content);
    }

}

