<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Accounts */

$this->title = 'Добавление аккаунта';
$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
