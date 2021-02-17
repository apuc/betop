<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\historycash\models\HistoryCashSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('history-cash', 'История наличных');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
            [
                'attribute' => 'user_id',
                'value' => function ($data) {
                    return $data->user['email'];
                },
                'filter' => kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'user_id',
                    'data' => $users,
                    'options' => ['placeholder' => 'Начните вводить...', 'class' => 'form-control'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],

            [
                'attribute' => 'type',
                'filter' => false,
            ],
            [
                'attribute' => 'description',
                'filter' => false
            ],
            [
                'attribute' => 'dt_add',
                'filter' => false
            ],
            [
                'attribute' => 'amount',
                'value' => function($data){
                   return strval(round($data['amount'] / \common\models\Settings::getSetting('balance_exponent'), 3));
                },
                'filter' => false
            ],

        ],
    ]); ?>
</div>
