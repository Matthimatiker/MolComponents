<?php

/**
 * TestHelper
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Tests
 * @copyright Matthias Molitor 2011
 * @version $Rev: 466 $
 * @since 22.05.2011
 */

/**
 * Helper class with static methods that support testing.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Tests
 * @copyright Matthias Molitor 2011
 * @version $Rev: 466 $
 * @since 22.05.2011
 */
class TestHelper {
    
    /**
     * Instances of this class are not allowed.
     */
    protected function __construct() {
    }
    
    /**
     * Creates a pre-configured view mock object for testing.
     *
     * @return Mol_Test_View_Mock
     */
    public static function createView() {
        $view = new Mol_Test_View_Mock();
        $view->addHelperPath(dirname(__FILE__) . '/../src/Mol/View/Helper', 'Mol_View_Helper');
        $urlHelper = new Mol_Test_View_Helper_Url();
        $view->setHelper('Url', $urlHelper);
        return $view;
    }
    
}

?>