<?php

/**
 * Mol_Mail_Factory
 *
 * @category PHP
 * @package Mol_Mail
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 01.07.2012
 */

/**
 * Factory that uses template configurations to create pre-filled mail objects.
 *
 * == Configuration ==
 *
 * The factory expects a list of template configurations as first constructor
 * parameter:
 * <code>
 * $settings = array(
 *     'invitation' => array(
 *         'subject' => 'Please visit our site'
 *     ),
 *     'registration' => array(
 *         'subject' => 'Thank you for registration'
 *     )
 * );
 * $factory = new Mol_Mail_Factory(new Zend_Config($settings), $view);
 * </code>
 * The key equals the name of the template ("invitation" and "registration"
 * this example). The template settings are assigned as value.
 *
 * Each template configuration may contain the following settings:
 * # charset     (string)        - Charset of the email.
 * # subject     (string)        - Subject line, will automatically be translated.
 * # to          (array(string)) - List of default "to" recipients
 * # cc          (array(string)) - List of default "cc" recipients
 * # bcc         (array(string)) - List of default "bcc" recipients
 * # sender      (string)        - Sender address
 * # script.text (string)        - Template that renders the text part
 * # script.html (string)        - Template that renders the HTML part
 *
 * Template settings example:
 * <code>
 * $settings = array(
 *     'charset' => 'UTF-8',
 *     'subject' => 'Hello world!',
 *     'to' => array(
 *         'user@example.org',
 *         'second-user@example.org'
 *     ),
 *     'cc' => array(
 *         'another.user@example.org'
 *     ),
 *     'bcc' => array(
 *         'archive@example.com'
 *     ),
 *     'sender' => 'mailer@example.org',
 *     'script' => array(
 *         'text' => 'hello.text.phtml',
 *         'html' => 'hello.html.phtml'
 *     )
 * );
 * </code>
 *
 * @category PHP
 * @package Mol_Mail
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 01.07.2012
 */
class Mol_Mail_Factory
{
    
    /**
     * The configured templates.
     *
     * @var Zend_Config
     */
    protected $templates = null;
    
    /**
     * The view that is used for view script rendering
     * and whose translator is used to translate subjects.
     *
     * @var Zend_View
     */
    protected $view = null;
    
    /**
     * Creates the factory.
     *
     * @param Zend_Config $templates The template configurations.
     * @param Zend_View $view View that is used to render mail contents.
     */
    public function __construct(Zend_Config $templates, Zend_View $view)
    {
        $this->templates = $templates;
        $this->view      = $view;
    }
    
    /**
     * Uses the provided template to create a pre-configured mail object.
     *
     * If $template is null then a mail object without further configuration
     * will be returned.
     *
     * The provided parameters will be passed to the view scripts that
     * are used to render the mail contents (if configured).
     *
     * @param string|null $template The name of the template.
     * @param array(string=>mixed) $parameters The view parameters.
     * @return Zend_Mail
     */
    public function create($template = null, array $parameters = array())
    {
        if ($template === null) {
            // Create mail without template.
            return $this->createMail($this->getDefaultCharset());
        }
        $template = $this->getConfigFor($template);
        return $this->createMailFrom($template, $parameters);
    }
    
    /**
     * Uses the given configuration to prepare a mail object.
     *
     * @param Zend_Config $configuration The template configuration.
     * @param array(string=>mixed) $parameters The view parameters.
     * @return Zend_Mail The configured mail object.
     */
    protected function createMailFrom(Zend_Config $configuration, array $parameters)
    {
        $charset = $configuration->get('charset', $this->getDefaultCharset());
        $mail    = $this->createMail($charset);
        if (isset($configuration->subject)) {
            $mail->setSubject($this->translate($configuration->subject));
        }
        if (isset($configuration->to)) {
            $mail->addTo($configuration->to->toArray());
        }
        if (isset($configuration->cc)) {
            $mail->addCc($configuration->cc->toArray());
        }
        if (isset($configuration->bcc)) {
            $mail->addBcc($configuration->bcc->toArray());
        }
        if (isset($configuration->sender)) {
            $mail->setFrom($configuration->sender);
        }
        if (isset($configuration->script->text)) {
            $mail->setBodyText($this->render($configuration->script->text, $parameters));
        }
        if (isset($configuration->script->html)) {
            $mail->setBodyHtml($this->render($configuration->script->html, $parameters));
        }
        return $mail;
    }
    
    /**
     * Returns the configuration of the provided template.
     *
     * @param string $template The name of the template.
     * @return Zend_Config
     * @throws InvalidArgumentException If the template does not exist.
     */
    protected function getConfigFor($template)
    {
        if (!isset($this->templates->{$template})) {
            $message = 'The template "' . $template . '" does not exist.';
            throw new InvalidArgumentException($message);
        }
        return $this->templates->get($template);
    }
    
    /**
     * Renders the provided script.
     *
     * @param string $script
     * @param array(string=>mixed) $parameters
     * @return string The rendered content.
     */
    protected function render($script, array $parameters)
    {
        $this->view->clearVars();
        $this->view->assign($parameters);
        return $this->view->render($script);
    }
    
    /**
     * Creates a mail object without further configuration.
     *
     * Can be overwritten to work with more specific mail objects.
     *
     * @param string $charset
     * @return Zend_Mail
     */
    protected function createMail($charset)
    {
        return new Zend_Mail($charset);
    }
    
    /**
     * Uses the view translator to translate the provided message id.
     *
     * @param string $messageId
     * @return string
     */
    protected function translate($messageId)
    {
        return $this->view->translate($messageId);
    }
    
    /**
     * Returns the default mail charset.
     *
     * @return string
     */
    protected function getDefaultCharset()
    {
        return $this->view->getEncoding();
    }
    
}
