<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class NewAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap-grid.min.css',
        'css/service.css',
        'css/font-awesome.css',
        'css/secret-styles.css',
        'css/styles.css',
        'css/correct_main.css',
        '/css/style_chatBehance.css',
        'css/chat.css'
    ];
    public $js = [
        'js/slick.min.js',
        'js/wow.min.js',
        'js/script.js',
        '/js/chat.js',
        'https://unpkg.com/sweetalert/dist/sweetalert.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
