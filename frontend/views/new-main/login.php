<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Вход';
$this->registerCssFile('/css/main.css', ['depends' => ['yii\bootstrap\BootstrapAsset']]);
?>
<header class="header-wrap header-wrap-auth">
    <div class="header__stars1 header__stars">
        <div class="stars"></div>
        <div class="stars2"></div>
        <div class="stars3"></div>
    </div>

    <div class="container auth-form-wrap">
        <div class="header">
          <div class="header__phone header__phone_col">
            <h1 class="auth-title">Вход</h1>
                <div class="header__phone-wrap header__phone-wrap-auth">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'email')->textInput() ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

<!--                    --><?php echo "" //$form->field($model, 'rememberMe')->checkbox() ?>

                    <div style="margin:1em 0; display: flex; justify-content: space-between">
                         <?= Html::a('Регистрация', ['site/signup'],['style'=>'color:white;']) ?>
                         <?= Html::a('Забыли пароль?', ['/request-password-reset'],['style'=>'color:white;']) ?>
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Войти', ['class' => 'btn btn-pink', 'name' => 'login-button',
                            'style'=>'margin: 10px auto']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>

            </div>
        </div>
    </div>
</header>

