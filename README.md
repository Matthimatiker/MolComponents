# MolComponents #

Master: [![Build Status](https://secure.travis-ci.org/Matthimatiker/MolComponents.png?branch=master)](http://travis-ci.org/Matthimatiker/MolComponents)

Library that extends the capabilities of Zend Framework 1.

## Requirements ##

MolComponents requires Zend Framework 1 (1.11.* recommended, older versions should work as well) 
and at least PHP 5.2 (5.3 recommended).

## Installation ##

MolComponents is installable via  [Composer](https://github.com/composer/composer).

Add the github repository to your composer config and require
*Matthimatiker/MolComponents*:

    {
        "repositories": [
             {
                 "type": "vcs",
                 "url": "https://github.com/Matthimatiker/MolComponents"
             }
        ],
        "require": {
            "Matthimatiker/MolComponents" : "dev-master"
        }
    }
    
Install MolComponents via 

    php composer.phar install
    
## Features ##

Here are some examples of the functionality that is provided by the library.

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

### Simplified url generation ###

The view helper *Mol_View_Helper_To* may be used as an alternative to 
*Zend_View_Helper_Url* to generate urls in view scripts:

    <?= $this->to('my-action', 'my-controller', 'my-module')->withParam('confirm', 1); ?>
    
It avoids passing the required information as array and provides a fluent 
interface to make url generation more readable.

Per default all url parameters must be provided explicitly, the parameters of 
the incoming request are *not* automatically included.
