<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'lanhuwei',
    'name' => '蓝护卫',
    'language' => 'zh-CN',
    'timeZone' => 'Asia/Chongqing',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
            'cookieValidationKey' => 'yfraudcookie',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'identityCookie' =>[
                'name' => '_frontendUser',
                'path' => '/advanced/frontend',
            ]
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            //'useFileTransport' => true,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.qq.com',
                'username' => 'lanhuwei@qq.com',
                'password' => 'lanHw.123',
                'port' => '465',
                'encryption' => 'ssl',
            ],
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
        'urlManager' => [
            'suffix' => '.html',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [
                [
                    'pattern' => '/',
                    'route' => '/site/index',
                ],
                //列表
                [
                    'pattern' => '/<controller:(fraudinfo|post)>/<action:(index|view)>/<id:\d+>',
                    'route' => '/<controller>/<action>',
                ],
                //列表分页
                [
                    'pattern' => '/<controller:(fraudinfo|post)>/<action:(index|view)>/page/<page:\d+>',
                    'route' => '/<controller>/<action>',
                ],
                //单页
                [
                    'pattern' => '/<controller:(page)>/<action:(view)>/<name:\w+>',
                    'route' => '/<controller>/<action>',
                ],


                //首页、通用
                [
                    'pattern' => '/<controller:\w+>/<action:\w+>/',
                    'route' => '/<controller>/<action>',
                ],


                [
                    'pattern' => '/admin',
                    'route' => '/admin/default/index',
                ],
                [
                    'pattern' => '/admin/<controller:\w+>/<action:\w+>',
                    'route' => '/admin/<controller>/<action>',
                ],
//				[
//                    'pattern' => '/fraud/<controller:\w+>/<action:\w+>',
//                    'route' => '/fraud/<controller>/<action>',
//                ],
//				[
//                    'pattern' => '/cms/<controller:\w+>/<action:\w+>',
//                    'route' => '/cms/<controller>/<action>',
//                ],
//                [
//                    'pattern' => '/post/<controller:\w+>/<action:\w+>_<id:\d+>_<page:\d+>',
//                    'route' => '/post/<controller>/<action>',
//                ],
//				[
//                    'pattern' => '/user/<controller:\w+>/<action:\w+>',
//                    'route' => '/user/<controller>/<action>',
//                ],
            ]
        ],
        'db' => require(__DIR__ . '/db.php'),
        'view' => [
            'class' => 'app\modules\admin\base\BaseBackView',
        ],
    ],

    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'superUserIds' => [1]
        ],
        'vpn' => [
            'class' => 'app\modules\vpn\Module',
        ],
        'fraud' => [
            'class' => 'app\modules\fraud\Module',
        ],
        'cms' => [
            'class' => 'app\modules\cms\Module',
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    //$config['bootstrap'][] = 'debug';
    //$config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';

    $config['modules']['gii'] = 'yii\gii\Module';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'admin' => [
                'class' => 'app\gii\admin\Generator',

            ],
        ]
    ];
}

return $config;
