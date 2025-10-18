<?php

$config = [
    'id' => 'yii2-rest-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@app' => dirname(__DIR__) . '/src',
    ],
    'controllerNamespace' => 'app\Controllers',
    'container' => [
        'singletons' => [
            'app\Interfaces\CalculatorInterface' => 'app\Services\EvenNumbersCalculator',
        ],
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'test-secret-key',
            'enableCsrfValidation' => false, // Disable CSRF for REST API
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'format' => 'json', // Default response format for REST API
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                'POST api/sum-even' => 'api/sum-even',
            ],
        ],
    ],
    'params' => [],
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
    ];
}

return $config;
