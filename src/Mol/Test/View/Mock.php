<?php

/**
 * Mol_Test_View_Mock
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Test
 * @copyright Matthias Molitor 2010
 * @version $Rev: 464 $
 * @since 21.10.2010
 */

/**
 * Mock object that can be used as view.
 *
 * Allows the injection of view helpers to avoid dependencies and therefore
 * simplify testing.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_Test
 * @copyright Matthias Molitor 2010
 * @version $Rev: 464 $
 * @since 21.10.2010
 */
class Mol_Test_View_Mock extends Zend_View {

    /**
     * The mocked view helpers.
     *
     * @var array(mixed)
     */
    protected $mockedHelpers = array();

    /**
     * See {@link Zend_View_Abstract::getHelpers()} for details.
     *
     * @return array(mixed)
     */
    public function getHelpers() {
        return array_merge(parent::getHelpers(), $this->mockedHelpers);
    }

    /**
     * See {@link Zend_View_Abstract::getHelper()} for details.
     *
     * @param string $name
     * @return object
     * @throws Zend_Loader_Exception If the requested helper is not available.
     */
    public function getHelper( $name ) {
        $name = $this->normalizeHelperName($name);
        if( isset($this->mockedHelpers[$name]) ) {
            return $this->mockedHelpers[$name];
        }
        // Try to load the default Zend view helper.
        try {
            $helper = parent::getHelper($name);
        } catch( Zend_Loader_Exception $e ) {
            $message  = 'ViewMock does not support helper "' . $name . '".';
            $message .= 'Use setHelper($name, $helper) to provide a helper manually.';
            throw new Zend_Loader_Exception($message, null, $e);
        }
        return $helper;
    }

    /**
     * Injects a view helper that may be used in views later.
     *
     * @param string $name
     * @param mixed $helper The helper object.
     * @throws Zend_View_Exception If no object was provided.
     */
    public function setHelper( $name, $helper ) {
        if( !is_object($helper) ) {
            throw new Zend_View_Exception('Helper object expected.');
        }
        if( method_exists($helper, 'setView') ) {
            $helper->setView($this);
        }
        $name = $this->normalizeHelperName($name);
        $this->mockedHelpers[$name] = $helper;
    }

    /**
     * Normalizes the helper name.
     *
     * @param string $name
     * @return string
     */
    private function normalizeHelperName( $name ) {
        return strtolower(substr($name, 0, 1)) . substr($name, 1);
    }

}

?>