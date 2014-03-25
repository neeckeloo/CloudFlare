CloudFlare module for ZF2
=======================

CloudFlare module provide an object-oriented PHP wrapper for [CloudFlare API](https://www.cloudflare.com/docs/client-api.html).

[![Build Status](https://travis-ci.org/neeckeloo/CloudFlare.png)](http://travis-ci.org/neeckeloo/CloudFlare)
[![Latest Stable Version](https://poser.pugx.org/neeckeloo/cloudflare/v/stable.png)](https://packagist.org/packages/neeckeloo/cloudflare)
[![Coverage Status](https://coveralls.io/repos/neeckeloo/CloudFlare/badge.png)](https://coveralls.io/r/neeckeloo/CloudFlare)
[![Dependencies Status](https://depending.in/neeckeloo/CloudFlare.png)](http://depending.in/neeckeloo/CloudFlare)

Introduction
------------

CloudFlare module intend to provide a way to interact easily with the CloudFlare API. CloudFlare distribute your content around the world so it’s closer to your visitors (speeding up your site). The service optimizes your assets and secures your website.

Requirements
------------

* PHP 5.3 or higher

Installation
------------

CloudFlare module only officially supports installation through Composer. For Composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

Install the module:
```sh
$ php composer.phar require neeckeloo/cloudflare:dev-master
```

Enable the module by adding `CloudFlare` key to your `application.config.php` file. Customize the module by copy-pasting
the `cloudflare.global.php.dist` file to your `config/autoload` folder.

Configuration
-------------

You must specifiy your email account and CloudFlare api token to use the module.

```php
return array(
    'cloudflare' => array(
        /**
         * Define api url
         */
        // 'api_url' => 'https://www.cloudflare.com/api_json.html',

        /**
         * Define email account
         */
        // 'email' => '',

        /**
         * Define api token
         */
        // 'token' => '',
    ),
);
```
