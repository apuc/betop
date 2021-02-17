<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\accounts\controllers\AccountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('accounts', 'Accounts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-index">

    <h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a(Yii::t('accounts', 'Parse Account'), ['parse-account'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('accounts', 'Parse Works'), ['parse-works'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'image',
                'filter'=>false,
                'format'=>'raw',
                'value'=>function($data){
                    return Html::img($data->image,['width'=>100,'height'=>'100']);
                }
            ],
            [
                'attribute'=>'display_name',
                'filter'    => kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'display_name',
                    'data' => $display_names,
                    'options' => ['placeholder' => 'Начните вводить...','class' => 'form-control'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            [
                'attribute'=>'user_id',
                'value'=>function($data){
                    return $data->user['email'];
                },
                'filter'    => kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'user_id',
                    'data' => $users,
                    'options' => ['placeholder' => 'Начните вводить...','class' => 'form-control'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            [
                'attribute'=>'url',
                'filter'=>false,
                'format'=>'raw',
                'value'=>function($data){
                    return Html::a('ссылка',$data->url,['target'=>'_blank']);
                }
            ],

            [
               'attribute'=>'behance_id',
               'filter'=>false
            ],

//            [
//                'format'=>'raw',
//                'value'=>function($data){
//                    return Html::a('Обновить работы','/cabinet/accounts/parse?id='.$data->id.'&url='.$data->url,['class'=>'btn btn-primary']);
//                }
//            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{delete}'
            ],
        ],
    ]); ?>
</div>
