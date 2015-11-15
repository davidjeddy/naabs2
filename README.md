Naabs2
======

Naabs2 is the second `Network Access and Billing System` now based on the Yii2 framework.


Badges
------

[![Stories in Ready](https://badge.waffle.io/davidjeddy/naabs2.png?label=ready&title=Ready)](https://waffle.io/davidjeddy/naabs2)


[![Throughput Graph](https://graphs.waffle.io/davidjeddy/naabs2/throughput.svg)](https://waffle.io/davidjeddy/naabs2/metrics)


DIRECTORY STRUCTURE
-------------------

```
common
    config/              shared configurations
    mail/                view files for e-mails
    models/              model classes used in both backend and frontend
console
    config/              console configurations
    controllers/         console controllers (commands)
    migrations/          database migrations
    models/              console-specific model classes
    runtime/             files generated during runtime
backend
    assets/              application assets such as JavaScript and CSS
    config/              backend configurations
    controllers/         Web controller classes
    models/              backend-specific model classes
    runtime/             files generated during runtime
    views/               view files for the Web application
    web/                 the entry script and Web resources
frontend
    assets/              application assets such as JavaScript and CSS
    config/              frontend configurations
    controllers/         Web controller classes
    models/              frontend-specific model classes
    runtime/             files generated during runtime
    views/               view files for the Web application
    web/                 the entry script and Web resources
    widgets/             frontend widgets
vendor/                  dependent 3rd-party packages
environments/            environment-based overrides
tests                    various tests for the advanced application
    codeception/         tests developed with Codeception PHP Testing Framework
```


REQUIREMENTS
------------

The minimum requirement by this application template that your Web server supports PHP 5.4.0, mycrypt, MySQL 5.4, composer.


INSTALLATION
------------

* Clone repo `git clone git@github.com:davidjeddy/naabs2.git`
* Enter project `cd naabs2`
* Initialize project `./init`
* install composer FXP `composer global require "fxp/composer-asset-plugin:~1"`
* Install 3rd party libraries `composer install --prefer-dist --profile -o -v`
* Update MySQL value of `components['db']` configuration in `common/config/main-local.php`
* Insert DB data `./yii migrate`
* Set document roots of your Web server:
    - for frontend `/path/to/yii-application/frontend/web/` and using the URL `http://frontend/`
    - for backend `/path/to/yii-application/backend/web/`   and using the URL `http://backend/`
* Optional: Remove dev / testing / setup libraries `composer install --prefer-dist --profile --no-dev -o -v`

TESTING
-------

* Added required packages for testing `composer install --prefer-dist --profile -o -v`
* Fire up php localhost in the root of the project `php -S localhost:8080 > /dev/null 2>&1 &`
* migrate DB for tests `./tests/codeception/bin/yii migrate`
* Export Composer bin path `export PATH=$PATH:./tests/codeception/bin`
* Run tests
    - Frontend `codecept build -c ./tests/codeception/frontend && codecept run -c ./tests/codeception/frontend`
    - Backend  `codecept build -c ./tests/codeception/backend  && codecept run -c ./tests/codeception/backend`


USAGE
-----

To login into the application, you need to first sign up, with any of your email address, username and password.
Then, you can login into the application with same email address and password at any time.

