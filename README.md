Naabs2
======

Naabs2 is the second `Network Access and Billing System` now based on the Yii2 framework.


Badges
======

[![Stories in Ready](https://badge.waffle.io/davidjeddy/naabs2.png?label=ready&title=Ready)](https://waffle.io/davidjeddy/naabs2)


DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
tests                    contains various tests for the advanced application
    codeception/         contains tests developed with Codeception PHP Testing Framework
```


REQUIREMENTS
------------

The minimum requirement by this application template that your Web server supports PHP 5.4.0, mycrypt, MySQL 5.4.


INSTALLATION
------------

* `git clone git@github.com:davidjeddy/naabs2.git {destination}`
* `./init`
* `php composer.phar global require "fxp/composer-asset-plugin:1.0.0-beta4"`
* `php composer.phar install --prefer-dist --profile -o`
* Create database in MySQL and adjust the `components['db']` configuration in `common/config/main-local.php`
* `./yii migrate` to apply migrations. This will create tables needed for the application to work
* Set document roots of your Web server:
    - for frontend `/path/to/yii-application/frontend/web/` and using the URL `http://frontend/`
    - for backend `/path/to/yii-application/backend/web/` and using the URL `http://backend/`

USAGE
---------------

To login into the application, you need to first sign up, with any of your email address, username and password.
Then, you can login into the application with same email address and password at any time.


[![Throughput Graph](https://graphs.waffle.io/davidjeddy/naabs2/throughput.svg)](https://waffle.io/davidjeddy/naabs2/metrics)