<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name' => 'betop',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
	    'cabinet' => [
		    'class' => 'frontend\modules\cabinet\Cabinet',
		    'layout' => 'new',

	    ],
        'api' => [
            'class' => 'frontend\modules\api\Api',
        ],
        'queue' => [
            'class' => 'frontend\modules\queue\Queue',
        ],
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
            'cookieValidationKey' => $params['cookieValidationKey'],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced',
            'cookieParams' =>[
                'httpOnly' => true,
                //'domain' => $params['cookieDomain'],
            ]
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'new-main/index',
                '/social/<slug>' => 'new-main/social',
	            'cabinet' => '/cabinet/cabinet',
	            'signup' => '/site/signup',
	            'reset-password' => '/site/reset-password',
	            'request-password-reset' => '/site/request-password-reset',
	            'account-confirm' => '/site/account-confirm',
                //'behance' => '/site/index',
                //'behance/chat' => '/new-main/chat',
                'about' => 'new-main/about'
            ],
        ],

    ],
    'params' => $params,
];
