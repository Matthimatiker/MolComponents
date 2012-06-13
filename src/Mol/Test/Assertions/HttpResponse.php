<?php

/**
 * Mol_Test_Assertions_HttpResponse
 *
 * @category PHP
 * @package Mol_Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 02.07.2011
 */

/**
 * Encapsulates assertions regarding the response object.
 *
 * Testcases may return an instance of Mol_Test_Assertions_HttpResponse to
 * support speaking method calls:
 * <code>
 * // assertResponse() returns an instance of Mol_Test_Assertions_Response
 * $this->assertResponse()->contains('Hello!');
 * </code>
 *
 * @category PHP
 * @package Mol_Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 02.07.2011
 */
class Mol_Test_Assertions_HttpResponse
{
    /**
     * The tested response.
     *
     * @var Zend_Controller_Response_Http
     */
    protected $response = null;

    /**
     * Creates the assertion tester for the given response.
     *
     * @param Zend_Controller_Response_Http $response
     */
    public function __construct($response)
    {
        PHPUnit_Framework_Assert::assertType('Zend_Controller_Response_Http', $response);
        $this->response = $response;
    }

    /**
     * Asserts that the response returns the provided HTTP code.
     *
     * @param integer $expected The HTTP code.
     */
    public function hasCode( $expected )
    {
        $message = 'Unexpected response code.';
        PHPUnit_Framework_Assert::assertEquals($expected, $this->response->getHttpResponseCode(), $message);
    }

    /**
     * Asserts that the response contains the expected header.
     *
     * The content of the header is not checked.
     *
     * @param string $name The header name.
     */
    public function hasHeader( $name )
    {
        $message = 'Header "' . $name . '" not found.';
        PHPUnit_Framework_Assert::assertGreaterThan(0, count($this->getHeaders($name)), $message);
    }

    /**
     * Asserts that the response does not contain the provided header.
     *
     * @param string $name The header name.
     */
    public function notHasHeader( $name )
    {
        $message = 'Header "' . $name . '" found.';
        PHPUnit_Framework_Assert::assertEquals(0, count($this->getHeaders($name)), $message);
    }

    /**
     * Asserts that the response contains exactly one
     * header of type $name and that this header equals
     * $expected.
     *
     * @param string $name
     * @param string $expected
     */
    public function headerEquals( $name, $expected )
    {
        $headers         = $this->getHeaders($name);
        $numberOfHeaders = count($headers);
        $message         = 'Expected exactly 1 header of type "' . $name . '", but found ' . $numberOfHeaders . '.';
        PHPUnit_Framework_Assert::assertEquals(1, $numberOfHeaders, $message);
        PHPUnit_Framework_Assert::assertEquals($expected, current($headers), 'Unexpected header content.');
    }

    /**
     * Returns all headers of type $name.
     *
     * Example:
     * <code>
     * $headers = $this->getHeaders('Content-Type');
     * </code>
     *
     * @param string $name
     * @return array(string) All matching header values.
     */
    protected function getHeaders( $name )
    {
        $headers = array();
        foreach ($this->response->getHeaders() as $headerData) {
            /* @var $headerData array */
            if ($headerData['name'] === $name) {
                $headers[] = $headerData['value'];
            }
        }
        return $headers;
    }

    /**
     * Asserts that the reponse body contains the expected text.
     *
     * @param string $needle The text.
     */
    public function contains( $needle )
    {
        $message = 'Response does not contain the expected content.';
        PHPUnit_Framework_Assert::assertContains($needle, $this->response->getBody(), $message);
    }

    /**
     * Asserts that the reponse body does not contain the provided text.
     *
     * @param string $needle The text.
     */
    public function notContains( $needle )
    {
        $message = 'Response contains unexpected content.';
        PHPUnit_Framework_Assert::assertNotContains($needle, $this->response->getBody(), $message);
    }

    /**
     * Asserts that the response contains an image.
     *
     * Also checks if the header settings are compatible to
     * the delivered image.
     */
    public function containsImage()
    {
        $content = $this->response->getBody();
        PHPUnit_Framework_Assert::assertFalse(empty($content), 'Response is empty.');
        $info = getimagesize(new Mol_Util_StringStream($content));
        PHPUnit_Framework_Assert::assertTrue($info !== false, 'No image found.');
        $this->headerEquals('Content-Type', $info['mime']);
    }

    /**
     * Asserts that the response contains JSON data.
     *
     * Also checks if the content type header is compatible
     * to JSON data.
     */
    public function containsJson()
    {
        $content = $this->response->getBody();
        try {
            Zend_Json::decode($content);
        } catch( Zend_Json_Exception $e ) {
            PHPUnit_Framework_Assert::fail('Invalid JSON data found: ' . $e->getMessage());
        }
        $this->headerEquals('Content-Type', 'application/json');
    }

}

