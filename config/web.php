<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'app-practical-b',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['admin'],
            'enableConfirmation' => false,
            // To be changed after initial admin setup
            'enableUnconfirmedLogin' => true,
            'enableRegistration' => true,

            'mailer' => [
                'sender'                => 'no-reply@myhost.com', // or ['no-reply@myhost.com' => 'Sender name']
                'welcomeSubject'        => 'Welcome subject',
                'confirmationSubject'   => 'Confirmation subject',
                'reconfirmationSubject' => 'Email change subject',
                'recoverySubject'       => 'Recovery subject',
            ],
        ],
        'rbac' => [
            'class' => 'dektrium\rbac\Module',
        ],
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'widgetClientOptions' => [
                'plugins' => ['underline', 'imagemanager', 'filemanager', 'video', 'clips', 'fontcolor']
            ],
            'imageUploadRoute' => ['/uploads/images/index.php'],
            'fileUploadRoute' => ['/uploads/files/index.php'],
            'imageManagerJsonRoute' => ['/uploads/images/images.json'],
            'fileManagerJsonRoute' => ['/uploads/files/files.json'],
            'imageAllowExtensions' => ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg'],
            'fileAllowExtensions' => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']
        ],

        'datecontrol' =>  [
            'class' => 'kartik\datecontrol\Module',

            // format settings for displaying each date attribute
            'displaySettings' => [
                'date' => 'dd-MM-yyyy',
                'time' => 'H:i:s A',
                'datetime' => 'd-m-Y H:i:s A',
            ],

            // format settings for saving each date attribute
            'saveSettings' => [
                'date' => 'yyyy-MM-dd',
                'time' => 'H:i:s',
                'datetime' => 'Y-m-d H:i:s',
            ],

            'ajaxConversion' => true,

            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;