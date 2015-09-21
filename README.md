# yii2-cms
CMS based on Yii 2 framework

Yii 2 CMS Based upon Practical-B Application Template
======================================

Yii2 CMS is being developed as an alternative to all the heavy CMS out there that provide more than ever wanted,
without giving the flexibility required by a web developer to build a site with simple forms for an admin or a
moderator to add content and nothing more. Based on the [Yii Framework](http://www.yiiframework.com/) and the
[Yii 2 Practical-B Application Template](https://github.com/kartik-v/yii2-app-practical-b/) by
[Kartik Visweswaran](https://github.com/kartik-v).


What does it provide?
---------------------
Models created with migrations for posts, photo upload, redactor plugin for editing. 


Yii2-practical-b
---------------------

The [Yii 2 Practical-B Application Template](https://github.com/kartik-v/yii2-app-practical-b/) is a skeleton Yii 2 application based on the 
[yii2-basic template](https://github.com/yiisoft/yii2-app-basic/) best for
rapidly creating small projects. The template allows a **practical** method to directly 
access the application from the app root.

The template contains the basic features including user login/logout and a contact page.
It includes all commonly used configurations that would allow you to focus on adding new
features to your application.

SOME KEY ADDITIONS
-------------------

1. [User Module](https://github.com/dektrium/yii2-user)
2. [RBAC Module](https://github.com/dektrium/yii2-rbac)
3. [Redactor Plugin](https://github.com/yiidoc/yii2-redactor)

DIRECTORY STRUCTURE
-------------------

```
    /                   contains the entry script and web resources
    assets/             contains the web runtime assets
    assets_b/           contains application assets such as JavaScript and CSS
    commands/           contains console commands (controllers)
    config/             contains application configurations
    controllers/        contains Web controller classes
    mail/               contains view files for e-mails
    models/             contains model classes
    runtime/            contains files generated during runtime
    tests/              contains various tests for the yii2-practical-b application
    vendor/             contains dependent 3rd-party packages
    views/              contains view files for the Web application
```

REQUIREMENTS
------------

The minimum requirement by this application template is that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Install from an Archive File

Will support this after first release.


### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this application template using the following command:

~~~
php composer.phar global require "fxp/composer-asset-plugin:1.0.0"
php composer.phar create-project --prefer-dist romdim/yii2-cms yii2-cms
~~~

Now you should be able to access the application through the following URL, assuming `yii2-cms` is the directory
directly under the Web root.

~~~
http://localhost/yii2-cms
~~~


CONFIGURATION
-------------

### Cookie Validation Key

Edit the file `config/web.php` with a cookie validation key, for example:
`8qMRb7Z4pO9uQ6180jVq8L10KMprgbd2`

**NOTE:** You can generate random keys [here](http://randomkeygen.com/)!

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
	'class' => 'yii\db\Connection',
	'dsn' => 'mysql:host=localhost;dbname=yii2cms',
	'username' => 'root',
	'password' => '1234',
	'charset' => 'utf8',
];
```

**NOTE:** Yii won't create the database for you, this has to be done manually before you can access it.

Also check and edit the other files in the `config/` directory to customize your application.

### Updating database schema

After you downloaded and configured yii2-cms, the last thing you need to do is updating your database schema by applying
the migration:

```bash
$ php yii migrate/up
```

### Administering users

By applying the migrations above, an admin, an editor and the according roles are created.
Admin's role is hardcoded in the user module within the `web.php`. The editor role is applied to both the aforementioned new users.

Login with:
~~~
admin
admin
~~~
or
~~~
editor
editor
~~~

As an admin you can manage the users at page:

~~~
http://localhost/yii2-cms/user/admin
~~~


### Setting Upload Folder

if you want to change the upload directory.
to path/to/uploadfolder
default value `@webroot/uploads`

```
    'modules' => [
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@webroot/path/to/uploadfolder',
            'uploadUrl' => '@web/path/to/uploadfolder',
            'imageAllowExtensions'=>['jpg','png','gif']
        ],
    ],
```

note: You need to create uploads folder and chmod and set security for folder upload
reference: [Protect Your Uploads Folder with .htaccess](http://tomolivercv.wordpress.com/2011/07/24/protect-your-uploads-folder-with-htaccess/),
[How to Setup Secure Media Uploads](http://digwp.com/2012/09/secure-media-uploads/)

### Using Redactor in forms

Config view/form

```
<?= $form->field($model, 'body')->widget(\yii\redactor\widgets\Redactor::className()) ?>
```