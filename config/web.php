<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'site/contact',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'indonesiaberbicara2014',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'admin' => [
            'class' => 'yii\web\User',
            'identityClass' => 'app\models\Admin',
            'enableAutoLogin' => true,
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
                    'levels' => ['error'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'backend' => 'backend/home/index',
                'backend/logout' => 'backend/login/logout',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>'
            ]
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '1554153538205725',
                    'clientSecret' => '5c10ecc71b18b672904e0fbe3f7c5b10',
                ],
                'google' => [
                    'class' => 'yii\authclient\clients\GoogleHybrid',
                    'clientId' => '698810963131-k55f74b8fqmeldov66t7ktngr9k7c4ih.apps.googleusercontent.com',
                    'clientSecret' => 'qg2rC_LrMWGV4sUxRU5JvoOH',
					'viewOptions' => [
						'widget' => [
							'class' => 'yii\authclient\widgets\GooglePlusButton',
							'buttonHtmlOptions' => [
								'data-approvalprompt' => 'force'
							],
						],
					],
                ],
                'twitter' => [
                    'class' => 'yii\authclient\clients\Twitter',
					'consumerKey' => $params['twitterApiKey'],
					'consumerSecret' => $params['twitterApiSecret'],
                ]
            ]
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'admin-lte-crud' => '@app/giitemplate/crud/admin-lte',
                ]
            ]
        ]
    ];
}

return $config;
