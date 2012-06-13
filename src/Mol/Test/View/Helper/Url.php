<?php

/**
 * Mol_Test_View_Helper_Url
 *
 * @category PHP
 * @package Mol_Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @version $Rev: 412 $
 * @since 21.10.2010
 */

/**
 * View helper that is used to simulate the original view helper from Zend.
 *
 * Avoids dependencies to the front controller und caches call parameters
 * for later analysis.
 *
 * @category PHP
 * @package Mol_Test
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @version $Rev: 412 $
 * @since 21.10.2010
 */
class Mol_Test_View_Helper_Url extends Zend_View_Helper_Abstract
{
    /**
     * Contains the parameters that were used to call the helper.
     *
     * @var array(array(string=>mixed))
     */
    protected $callParams = array();

    /**
     * Entry point for the view helper.
     *
     * Returns an string that contains all provided options.
     * Additionally stores the parameters for later analysis, for example in
     * unit tests.
     *
     * @param array $urlOptions
     * @param mixed $name
     * @param boolean $reset
     * @param boolean $encode
     * @return string
     */
    public function url( array $urlOptions = array(), $name = null, $reset = false, $encode = true )
    {
        $this->callParams[] = array(
            'urlOptions' => $urlOptions,
            'name'       => $name,
            'reset'      => $reset,
            'encode'     => $encode
        );
        // Generate a mock url that contains all given options.
        $optionNames = array_keys($urlOptions);
        $url         = '';
        foreach ($optionNames as $optionName) {
            $url .= $optionName . ':' . $urlOptions[$optionName] . '/';
        }
        return rtrim($url, '/');
    }

    /**
     * Returns the number of calls to the helper.
     *
     * @return integer
     */
    public function getNumberOfCalls()
    {
        return count($this->callParams);
    }

    /**
     * Returns the parameters that were used for call $callNumber.
     *
     * Counting starts at 0. If no parameters for the requested call
     * are available then null is returned.
     *
     * @param integer $callNumber
     * @return array(string=>mixed)|null
     */
    public function getParamsOfCall( $callNumber )
    {
        if (!isset($this->callParams[$callNumber])) {
            return null;
        }
        return $this->callParams[$callNumber];
    }

}

