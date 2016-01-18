#Description
Test exercise for Creditstar Group

#1 Setup.
Setting up is easy. You need Vagrant with VirtualBox to setup the virtual machine locally. Download and install VirtualBox https://www.virtualbox.org/wiki/Downloads and then Vagrant https://www.vagrantup.com/downloads.html

Once finished open up terminal and go to the project root.

To build your virtual machine run $ vagrant up . The script might ask you for your GitHub login credentials to download dependencies via API. Alternatively you can add your github API token to bootstrap.sh file after GITHUB_TOKEN.

Once vagrant has finished with the setup you dev environment should be all set up. You can now access it’s web server at: http://localhost:8080/web/ and phppgadmin at http://localhost:8080/phppgadmin/ (or mapped to port 5433 if you prefer to use a standalone app for db) . If those mappings don’t suit you, you can Modify the Vagrantfile file.

#2 Database

The database consists of two tables created for you Loans and Users. Each User can have multiple Loans. Each loan must have a User.

#3 Assignment

You need to create a webapp that provides

* viewing, adding, editing and removing Loans and Users in the database. Bonus for form validation.
http://www.yiiframework.com/doc-2.0/guide-start-forms.html
http://www.yiiframework.com/doc-2.0/guide-input-forms.html

* Listing out all the Loans and Users. Bonus for pagination, filtering and sorting.

http://www.yiiframework.com/doc-2.0/guide-output-pagination.html
http://www.yiiframework.com/doc-2.0/guide-output-sorting.html

* There are two Json files in the root folder of the project ( users.json and loans.json ) with predefined loans and users. You must import that data into the database programmatically. For example create a script that imports the file or use a migration

* Write a method to get user age from user personal code. All supplied personal codes are in Estonian personal code format: https://en.wikipedia.org/wiki/National_identification_number#Estonia
Display user age in user view.

http://www.yiiframework.com/doc-2.0/guide-db-migrations.html

* Style of the page should be based on recruitment.png file that is included with the project under root.

Use skeleton as much as you can. Bonus for responsiveness ( rather mandatory ) and SCSS usage.

Font used -> http://font.ubuntu.com/

* Write a test case to test if your user age calculation method returns correct age and test if user is allowed to apply for a loan (user is not underage).

* Once the assignment is done upload to a public git repository (github, bitbucket)

# Evaluation Criteria

* Is every feature working.
* Use as much Yii2 built in features. For layout use Bootstrap which comes with Yii2 OOTB
* MVC usage. Using models ( keyword here is Yii’s built in tool Gii for creating them from database tables), views and controllers correctly.
http://www.yiiframework.com/doc-2.0/ext-gii-index.html
http://www.yiiframework.com/doc-2.0/guide-structure-overview.html
* Code legibility.
* git usage. How commits are created and commented.
* The finished code should be possible to deploy and run the same way as described in: #1 Setup.

Relevant tools/helpful links:
Vagrant - https://www.vagrantup.com/downloads.html
Virtualbox(OSX) - http://download.virtualbox.org/virtualbox/4.3.28/VirtualBox-4.3.28-100309-OSX.dmg
( for windwos please go to http://download.virtualbox.org )
Github_token for bootstrap.sh - https://github.com/settings/tokens
Yii 2.0 documentation - http://www.yiiframework.com/doc-2.0/
Skeleton documentation - http://getskeleton.com/

After vagrant setup:
Database link - http://localhost:8080/phppgadmin/
Page link – http://localhost:8080/web/

When doubts or questions arise feel free to contact: helari.laurent@creditstargroup.com



Yii 2 Basic Project Template
============================

Yii 2 Basic Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
rapidly creating small projects.

The template contains the basic features including user login/logout and a contact page.
It includes all commonly used configurations that would allow you to focus on adding new
features to your application.

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-app-basic/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-app-basic/downloads.png)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-basic.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-basic)

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Install from an Archive File

Extract the archive file downloaded from [yiiframework.com](http://www.yiiframework.com/download/) to
a directory named `basic` that is directly under the Web root.

You can then access the application through the following URL:

~~~
http://localhost/basic/web/
~~~


### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
php composer.phar global require "fxp/composer-asset-plugin:~1.0.0"
php composer.phar create-project --prefer-dist --stability=dev yiisoft/yii2-app-basic basic
~~~

Now you should be able to access the application through the following URL, assuming `basic` is the directory
directly under the Web root.

~~~
http://localhost/basic/web/
~~~


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTE:** Yii won't create the database for you, this has to be done manually before you can access it.

Also check and edit the other files in the `config/` directory to customize your application.