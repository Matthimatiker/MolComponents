<?php

/**
 * Mol_Test_Http_Client_Adapter
 *
 * @category PHP
 * @package Mol_Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 05.03.2011
 */

/**
 * This class is an improved test adapter for Zend_Http_Client objects.
 *
 * In addition to iterate over a set of responses it is also possible
 * to register responses that are only delivered if the requested url
 * matches a specific pattern.
 *
 * Per default a "400 Bad Request" response is registered. It may be
 * removed by using the following code:
 * <code>
 * $adapter->setResponse(array());
 * </code>
 *
 * Specific responses can be registered for static urls:
 * <code>
 * $adapter->addResponse($myResponse, 'http://www.matthimatiker.de/index.php');
 * </code>
 *
 * If multiple responses are registered for the same url then the adapter
 * will iterate over that response set as usual:
 * <code>
 * $adapter->addResponse($myResponse, 'http://www.matthimatiker.de/index.php');
 * $adapter->addResponse($anotherResponse, 'http://www.matthimatiker.de/index.php');
 * </code>
 * The first request for "http://www.matthimatiker.de/index.php" returns
 * $myResponse. The next request to the same url will return $anotherResponse.
 * For following requests the adapter will start from the beginning.
 *
 * The character "*" may be used as wildcard when registering responses
 * for urls. Therefore it is possible to register a single response
 * for multiple urls.
 * In the following exampple a response is registered for all html pages
 * at matthimatiker.de:
 * <code>
 * $adapter->addResponse($myResponse, 'http://www.matthimatiker.de/*.html');
 * </code>
 * In this configuration the adapter will return $myResponse for
 * "http://www.matthimatiker.de/index.html" as well as for
 * "http://www.matthimatiker.de/login/start.html".
 *
 * If multiple url patterns match the same url the responses for the pattern
 * that was registered first will be returned:
 * <code>
 * $adapter->addResponse($myResponse, 'http://www.matthimatiker.de/*.html');
 * $adapter->addResponse($anotherResponse, 'http://www.matthimatiker.de/demo.*');
 * </code>
 * Requesting "http://www.matthimatiker.de/demo.html" will return $myResponse
 * in this case.
 *
 * @category PHP
 * @package Mol_Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 05.03.2011
 */
class Mol_Test_Http_Client_Adapter extends Zend_Http_Client_Adapter_Test
{
    /**
     * Contains the configured responses grouped by url pattern.
     *
     * The pattern is used as key, the value is an array of responses
     * that are registered for that pattern.
     *
     * @var array(string=>array(string))
     */
    protected $responsesByPattern = array();

    /**
     * Contains the number of requests per url pattern.
     *
     * The pattern is used as key, the value is the number of requests.
     *
     * For requests that could not be assigned to a specific pattern
     * the dummy pattern entry "default" will be used.
     *
     * @var array(string=>integer)
     */
    protected $numberOfRequestsByPattern = array();

    /**
     * The last requested uri.
     *
     * @var Zend_Uri_Http|null
     */
    protected $requestedUri = null;

    /**
     * See {@link Zend_Http_Client_Adapter_Interface::write()} for details.
     *
     * @param string $method
     * @param Zend_Uri_Http $uri
     * @param string $httpVersion
     * @param array $headers
     * @param string $body
     * @return string
     */
    public function write($method, $uri, $httpVersion = '1.1', $headers = array(), $body = '')
    {
        $request = parent::write($method, $uri, $httpVersion, $headers, $body);
        $this->requestedUri = $this->normalizeUri($uri);
        return $request;
    }

    /**
     * Normalizes the uri for internal usage.
     *
     * @param Zend_Uri_Http $uri
     * @return Zend_Uri_Http
     */
    protected function normalizeUri(Zend_Uri_Http $uri)
    {
        $defaultPorts = array(
            // Scheme => Port
            'http'  => 80,
            'https' => 443
        );
        foreach ($defaultPorts as $scheme => $port) {
            if ($uri->getScheme() === $scheme && $uri->getPort() == $port) {
                // Remove default port. Do not modify original object.
                $uri = clone $uri;
                $uri->setPort('');
                return $uri;
            }
        }
        return $uri;
    }

    /**
     * See {@link Zend_Http_Client_Adapter_Interface::read()} for details.
     *
     * @return string
     * @throws RuntimeException If no response is available.
     */
    public function read()
    {
        foreach ($this->getPatterns() as $pattern) {
            /* @var $pattern string */
            if (!$this->matches($pattern)) {
                continue;
            }
            $this->countRequest($pattern);
            return $this->next($pattern);
        }
        $this->countRequest('default');
        if (count($this->responses) === 0) {
            $message = 'Cannot handle request for "' . $this->requestedUri . '".' . PHP_EOL
                     . 'No response available, please provide at least one default response.';
            throw new RuntimeException($message);
        }
        return parent::read();
    }

    /**
     * Checks if the given pattern matches the last requested uri.
     *
     * @param string $pattern
     * @return boolean
     */
    protected function matches($pattern)
    {
        if (empty($pattern)) {
            return false;
        }
        $uri = $this->requestedUri->getUri();
        return preg_match($this->toRegExp($pattern), $uri) > 0;
    }

    /**
     * Converts the url pattern string to a regular expression.
     *
     * @param string $pattern
     * @return string
     */
    private function toRegExp($pattern)
    {
        $regExp = '/^' . preg_quote($pattern, '/') . '$/';
        // Replace escaped "*" by a pattern, that matches zero to
        // unlimited arbitrary characters.
        $regExp = str_replace('\*', '.*', $regExp);
        return $regExp;
    }

    /**
     * Zend_Http_Client_Adapter_Test::addResponse()
     *
     * @param string|Zend_Http_Response $response
     * @param string|null $urlPattern
     */
    public function addResponse($response, $urlPattern = null)
    {
        if ($urlPattern === null) {
            parent::addResponse($response);
        }
        if (!isset($this->responsesByPattern[$urlPattern])) {
            $this->responsesByPattern[$urlPattern] = array();
        }
        if ($response instanceof Zend_Http_Response) {
            $response = $response->asString("\r\n");
        }
        $this->responsesByPattern[$urlPattern][] = $response;
    }

    /**
     * Returns the next response for the given pattern.
     *
     * @param string $pattern
     * @return string
     */
    protected function next($pattern)
    {
        $response = array_shift($this->responsesByPattern[$pattern]);
        array_push($this->responsesByPattern[$pattern], $response);
        return $response;
    }

    /**
     * Returns the number of requests that matched the provided pattern.
     *
     * @param string $pattern
     * @return integer
     * @throws RuntimeException If the pattern is unknown.
     */
    public function getNumberOfRequestsFor($pattern)
    {
        if (!in_array($pattern, $this->getPatterns())) {
            throw new RuntimeException('Unknown pattern "' . $pattern . '".');
        }
        if (!isset($this->numberOfRequestsByPattern[$pattern])) {
            return 0;
        }
        return $this->numberOfRequestsByPattern[$pattern];
    }

    /**
     * Returns the number of all requests.
     *
     * @return integer
     */
    public function getNumberOfRequests()
    {
        return array_sum($this->numberOfRequestsByPattern);
    }

    /**
     * Increments the request counter for the given pattern.
     *
     * @param string $pattern
     */
    protected function countRequest($pattern)
    {
        if (!isset($this->numberOfRequestsByPattern[$pattern])) {
            $this->numberOfRequestsByPattern[$pattern] = 0;
        }
        $this->numberOfRequestsByPattern[$pattern]++;
    }

    /**
     * Returns an array that contains all patterns with
     * registered responses.
     *
     * @return array(string)
     */
    private function getPatterns()
    {
        return array_keys($this->responsesByPattern);
    }

}

