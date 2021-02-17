<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\works\models\Works */

$this->title = Yii::t('frontend', 'Create Works');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Works'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="works-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
