<?php

/**
 * Mol_View_Helper_To
 *
 * @category PHP
 * @package Mol_View
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 17.10.2010
 */

/**
 * View helper that simplifies generating urls within the application.
 *
 * Create a url with the parameter "confirm" within a view:
 *
 *     <?= $this->to('my-action', 'my-controller', 'my-module')->withParam('confirm', 1); ?>
 *
 * If the default module is addressed the module argument may be omitted:
 *
 *     <?= $this->to('my-action', 'my-controller'); ?>
 *
 * Multiple parameters may be added by using method chaining:
 *
 *     <?= $this->to('my-action', 'my-controller')->withParam('action', 'delete')->withParam('confirm', 1); ?>
 *
 * Special routes may be used via withRoute():
 *
 *     <?= $this->to('my-action', 'my-controller')->withRoute('custom'); ?>
 *
 * Add an anchor to the url:
 *
 *     <?= $this->to('my-action', 'my-controller')->withAnchor('info'); ?>
 *
 * Append all parameters of the current request:
 *
 *     <?= $this->to('my-action', 'my-controller')->keepParams(); ?>
 *
 * @category PHP
 * @package Mol_View
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2010-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 17.10.2010
 */
class Mol_View_Helper_To extends Zend_View_Helper_Abstract
{
    /**
     * Returns a url object that may be parametrized further and that
     * is automatically converted to a url string when it is printed.
     *
     * @param string $action
     * @param string $controller
     * @param string $module
     * @return Mol_View_Helper_Value_Url
     */
    public function to($action, $controller, $module = 'default')
    {
        $url = new Mol_View_Helper_Value_Url($this->view);
        $url->withParam('action', $action);
        $url->withParam('controller', $controller);
        $url->withParam('module', $module);
        $url->withRoute('default');
        return $url;
    }

}

