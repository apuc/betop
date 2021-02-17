<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\queue\controllers\QueueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('queue', 'Queues');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="queue-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('queue', 'Create Queue'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'label'=>'Картинка',
                'format'=>'raw',
                'value'=>function($data){
                    return Html::img($data->work['image'],['width'=>150,'height'=>150]);
                }
            ],
            [
               'attribute'=>'work_id',
               'value'=>function($data){
                    return $data->work['name'];
               },
                'filter'    => kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'work_id',
                    'data' => $works,
                    'options' => ['placeholder' => 'Начните вводить...','class' => 'form-control'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            [
               'label'=> 'Аккаунт',
               'value'=>function($m){
                    if(!empty($m->work))
                        return $m->work->account->user['email'];
               }
            ],
            [
               'attribute'=>'likes_work',
               'filter'=>false
            ],
            [
                'attribute'=>'views_work',
                'filter'=>false
            ],
            [
                'attribute'=>'account_views',
                'filter'=>false
            ],
            [    'class' => 'yii\grid\ActionColumn',
                 'template'=>'{update} {delete}'
            ],
        ],
    ]); ?>
</div>
