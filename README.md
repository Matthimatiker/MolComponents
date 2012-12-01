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

### Simplified url generation ###

The view helper *Mol_View_Helper_To* may be used as an alternative to 
*Zend_View_Helper_Url* to generate urls in view scripts:

    <?= $this->to('my-action', 'my-controller', 'my-module')->withParam('confirm', 1); ?>
    
It avoids passing the required information as array and provides a fluent 
interface to make url generation more readable.

Per default all url parameters must be provided explicitly, the parameters of 
the incoming request are *not* automatically included.
