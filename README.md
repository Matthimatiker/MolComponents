# MolComponents #

Master: [![Build Status](https://secure.travis-ci.org/Matthimatiker/MolComponents.png?branch=master)](http://travis-ci.org/Matthimatiker/MolComponents)

Library that extends the capabilities of Zend Framework 1.

## Requirements ##

MolComponents requires Zend Framework 1 (>=1.11.0 recommended, older versions should 
work as well) and at least PHP 5.3.

## Installation ##

MolComponents is installable via  [Composer](https://github.com/composer/composer).

Just require *matthimatiker/molcomponents* in your composer config :

    {
        "require": {
            "matthimatiker/molcomponents": ">=1.4.2"
        }
    }
    
Install MolComponents via 

    php composer.phar install
    
## Features ##

Here are some examples of the functionality that is provided by the library.
The components follow a use-at-will design: All features are completely optional.

Please refer to the documentation of the classes for more details.

### Parameter support in controller actions ###

By extending *Mol_Controller_ActionParameter* you are able to declare 
required parameters as action method arguments:

    /**
     * Example action.
     *
     * @param integer $page
     */
    public function myAction($page = 1) 
    {
       // my code
    }
    
The component uses the parameter documentation to determine the expected
data type. Validation is performed automatically. On success the value is 
casted to the expected type and passed to the action as argument.

### Lazy Loading of resources ###

Usually, Zend Framework 1 initializes all configured resources for each request.
Mol_Components offers a mechanism to delay resource initialization until the 
resource is really requested.

To be able to use Lazy Loading, the application bootstrapper must inherit from
``Mol_Application_Bootstrap``:

	class My_Bootstrap extends Mol_Application_Bootstrap
	{
	}

Bootstrapping works exactly like before, but now it is possible to 
activate Lazy Loading for any resource in the ``application.ini``:

    resources.log.stream.writerName          = "Stream"
    resources.log.stream.writerParams.stream = APPLICATION_PATH "/logs/application.log"
    resources.log.stream.writerParams.mode   = "a"
    resources.log.lazyLoad                   = On

In this example, the log resource is not bootstrapped for each request anymore.
Instead, it is only initialized when explicitly requested from the bootstrapper, 
for example in a controller action:

    public function myAction() 
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        $logger = $bootstrap->getResource('log');
    }

Keep in mind that some resources must be executed early, as they modify
the global state of the application and will not be retrieved explicitly
via getResource().

### Configurable mail templates ###

MolComponents provides a flexible mail configuration system.
Instead of creating ``Zend_Mail`` objects manually, it is possible
to pre-configure mail properties (default recipients, templates, 
...) and retrieve mail objects by an alias.

To use this system, the ``mailer`` resource must be activated and
configured via ``application.ini``. A path to the mail configuration
file as well as a view script path for the mail templates should be
defined:

    resources.mailer.templates[] = APPLICATION_PATH "/mails/mail-templates.ini"
    resources.mailer.scripts[]   = APPLICATION_PATH "/mails/views"

Any number of template configurations and script paths can be added.
In case of conflict, the later defined template configurations will
overwrite the settings of their predecessors.

The ``mail-templates.ini`` contains a section for each mail template.
Each template defines several mail properties:

    [registration]
    charset     = "UTF-8"
    subject     = "Registration successful"
    bcc[]       = "registration-log@my-domain.com"
    replyTo     = "registration-support@my-domain.com"
    from        = "no-reply@my-domain.com"
    script.text = "registration.txt.phtml"
    script.html = "registration.html.phtml"

The translator of the view is used to automatically translate the subject.
The named view templates are used to generate the text and html part of
the mail.

**Hint**: Section inheritance can be used to easily define default mail
properties.

Now the ``create()`` method of the bootstrapped mail factory can be used 
to create ``Zend_Mail`` objects from a template:

    public function myAction()
    {
        $factory    = $this->getInvokeArg('bootstrap')->getResource('mailer');
        $parameters = array('userName', $name);
        $mail       = $factory->create('registration', $parameters);
    }

The create() method receives a template name and (optionally) a list
of parameters that is passed to the configured content view scripts.

After creation it is possible to modify and send mails as usual:

    $mail->addTo('recipient@user.com');
    $mail->send();

### Advanced form creation ###

Many forms share the same functionality. For example CSRF tokens are
often required for security reasons. Although necessarry, these 
additional elements make testing difficult as they often depend
on global state and therefore need a special treatment in unit tests.

To overcome these problems, MolComponents provides a configurable form 
factory combined with a simple plugin system.
The factory takes care of creating ``Zend_Form`` instances and plugins
are used to deal with cross-cutting concerns.

A simple use case is the creation of aliases for form classes:

	resources.form.aliases.login        = "My_Login_Form"
    resources.form.aliases.registration = "My_Registration_Form"

Now it is possible to retrieve form instances by their alias:

    public function myAction()
    {
        $factory = $this->getInvokeArg('bootstrap')->getResource('form');
        // Creates an instance of My_Login_Form
        $loginForm = $factory->create('login');
    }

From now on changing the type of a form is just a matter of configuration.



### Validation of form element dependencies ###

### Simplified url generation ###

The view helper *Mol_View_Helper_To* may be used as an alternative to 
*Zend_View_Helper_Url* to generate urls in view scripts:

    <?= $this->to('my-action', 'my-controller', 'my-module')->withParam('confirm', 1); ?>
    
It avoids passing the required information as array and provides a fluent 
interface to make url generation more readable.

Per default all url parameters must be provided explicitly, the parameters of 
the incoming request are *not* automatically included.
