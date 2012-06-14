<?php

/**
 * Mol_View_Helper_Favicon
 *
 * @category PHP
 * @package Mol_View
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 26.04.2011
 */

/**
 * Helper that generates a link tag that defines the favicon to use.
 *
 * The following examples demonstrate the usage of this helper in views.
 *
 * The icon url is given to the entry method favicon():
 * <code>
 * <!-- Generates the markup for the icon "/favicon.ico" -->
 * <?= $this->favicon('/favicon.ico'); ?>
 * </code>
 *
 * If the url is omitted the icon that was provided before will be used:
 * <code>
 * <?php $this->favicon('/favicon.ico'); ?>
 * <!-- Generates the markup for the icon "/favicon.ico" -->
 * <?= $this->favicon(); ?>
 * </code>
 *
 * If a icon url was provided multiple times the one that was given
 * last will be used:
 * <code>
 * <?php $this->favicon('/favicon.ico'); ?>
 * <?php $this->favicon('/another_favicon.ico'); ?>
 * <!-- Generates the markup for the icon "/another_favicon.ico" -->
 * <?= $this->favicon(); ?>
 * </code>
 *
 * If no icon url is provided the helper will not  generate any markup:
 * <code>
 * <!-- Generates an empty string. -->
 * <?= $this->favicon(); ?>
 * </code>
 *
 * @category PHP
 * @package Mol_View
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/MolComponents
 * @since 26.04.2011
 */
class Mol_View_Helper_Favicon extends Zend_View_Helper_Abstract
{
    /**
     * The url of the favicon.
     *
     * @var string
     */
    protected $iconUrl = null;

    /**
     * Accepts a icon url. If the url is omitted the icon that
     * was set previously will be used.
     *
     * This method is the entry point for the view helper.
     *
     * @param string $iconUrl
     * @return Mol_View_Helper_Favicon Provides a fluent interface.
     */
    public function favicon($iconUrl = null )
    {
        if ($iconUrl !== null) {
            $this->iconUrl = $iconUrl;
        }
        return $this;
    }

    /**
     * Generates the markup.
     *
     * @return string
     */
    public function __toString()
    {
        if ($this->iconUrl === null) {
            return '';
        }
        $template = '<link href="%s" rel="shortcut icon" type="image/x-icon" />';
        return sprintf($template, $this->iconUrl);
    }

}

