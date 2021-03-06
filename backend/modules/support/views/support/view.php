<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SupportQuestions */
/* @var $model0 common\models\SupportAnswers */

$this->title =  'Обращение № ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('support', 'Вопрос'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<p>
    <?php if ($model->status == 3): ?>
        <?= Html::a(Yii::t('support', 'Вернуться назад'), ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Открыть обращение',\yii\helpers\Url::toRoute('/support/support/open/?id=' . $model->id),['class'=>'btn btn-warning']) ?>
    <?php else: ?>
        <?= Html::a(Yii::t('support', 'Вернуться назад'), ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Закрыть обращение',\yii\helpers\Url::toRoute('/support/support/close/?id=' . $model->id),['class'=>'btn btn-danger']) ?>

    <?php endif; ?>
</p>
<div class="support-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'description',
            'date_add',
            //'status',
            [
                'label' => 'Статус',
                'value' => function ($model) {
                    return \common\models\SupportQuestions::getStatus($model->status);
                },
            ],
        ],
    ]) ?>
</div>
<div class="support-answers">
    <?php foreach ($model->answer as $value): ?>
        <b style="color:#268bd2"><?= \common\models\SupportAnswers::getStatus($value->status); ?></b>
        <br><?= $value->text ?></br>
        <?php $date = new DateTime($value->date_add); ?>
        <i style="color: grey;"><?= $date->format('Y-m-d H:i')?></i></br><br>
    <?php endforeach;?>
</div>
<div class="support-create-answers">
    <?php if ($model->status == 3): ?>
        <h3>Обращение закрыто</h3>
    <?php else: ?>
        <?= $this->render('_form', [
            'model0' => $model0,
        ]) ?>
    <?php endif; ?>
</div>