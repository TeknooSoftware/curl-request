Teknoo Software - Curl Request library
=================================

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/e1d89bb2-c878-4b50-bbb2-15045a9ba740/mini.png)](https://insight.sensiolabs.com/projects/e1d89bb2-c878-4b50-bbb2-15045a9ba740) [![Build Status](https://travis-ci.org/TeknooSoftware/curl-request.svg?branch=master)](https://travis-ci.org/TeknooSoftware/curl-request)

Welcome and thank you to having downloaded this library. This library allows you to easily create and execute HTTP Requests with cURL. 
It was a fork from zeroem/curl-bundle". Symfony dependencies has been removed, and this lib has been redesigned.

Simple example
--------------

    $generator = new Teknoo\Curl\RequestGenerator();
    
    $request = $generator->getRequest();
    
    //Fetch the URL http://teknoo.it with a GET Method.
    $request->setUrl('http://teknoo.it')
        ->setMethod('GET');
        
    echo $request->execute();    

Installation & Requirements
---------------------------
To install this library with composer, run this command :

    composer require teknoo/curl-request

This library requires :

* PHP 5.4+
* cUrl extension

Quick Howto
-----------
Quick How-to to learn how use this library : [Startup](docs/quick-startup.md).

API Documentation
-----------------
Generated documentation from the library with PhpDocumentor : [Open](https://cdn.rawgit.com/TeknooSoftware/curl-request/master/docs/api/index.html).

Credits
-------

* Richard Déloge - <richarddeloge@gmail.com> - Lead developer.
* Teknoo Software - <http://teknoo.software>.

About Teknoo Software
---------------------
**Teknoo Software** is a PHP software editor, founded by Richard Déloge. 
Teknoo Software's DNA is simple : Provide to our partners and to the community a set of high quality services or software,
 sharing knowledge and skills.
 
License
-------
States is licensed under the MIT and GPL3+ Licenses - see the licenses folder for details

Contribute :)
-------------

You are welcome to contribute to this project. [Fork it on Github](CONTRIBUTING.md)
