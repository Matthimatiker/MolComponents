<?php

/**
 * Mol_View_Helper_To
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_View
 * @copyright Matthias Molitor 2010
 * @version $Rev: 414 $
 * @since 17.10.2010
 */

/**
 * View helper that simplifies generating urls within the application.
 *
 * Create a url with the parameter "confirm" within a view:
 * <code>
 * <?= $this->to('my-action', 'my-controller', 'my-module')->withParam('confirm', 1); ?>
 * </code>
 *
 * If the default module is addressed the module argument may be omitted:
 * <code>
 * <?= $this->to('my-action', 'my-controller'); ?>
 * </code>
 *
 * Multiple parameters may be added by using method chaining:
 * <code>
 * <?= $this->to('my-action', 'my-controller')->withParam('action', 'delete')->withParam('confirm', 1); ?>
 * </code>
 *
 * Special routes may be used via withRoute():
 * <code>
 * <?= $this->to('my-action', 'my-controller')->withRoute('custom'); ?>
 * </code>
 *
 * Add an anchor to the url:
 * <code>
 * <?= $this->to('my-action', 'my-controller')->withAnchor('info'); ?>
 * </code>
 *
 * Append all parameters of the current request:
 * <code>
 * <?= $this->to('my-action', 'my-controller')->keepParams(); ?>
 * </code>
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Mol_View
 * @copyright Matthias Molitor 2010
 * @version $Rev: 414 $
 * @since 17.10.2010
 */
class Mol_View_Helper_To extends Zend_View_Helper_Abstract {
    
    /**
     * Returns a url object that may be parametrized further and that
     * is automatically converted to a url string when it is printed.
     *
     * @param string $action
     * @param string $controller
     * @param string $module
     * @return Mol_View_Helper_Value_Url
     */
    public function to( $action, $controller, $module = 'default' ) {
        $url = new Mol_View_Helper_Value_Url($this->view);
        $url->withParam('action',     $action);
        $url->withParam('controller', $controller);
        $url->withParam('module',     $module);
        return $url;
    }
    
}

?>