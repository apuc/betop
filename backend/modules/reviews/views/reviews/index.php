<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\reviews\models\ReviewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('reviews', 'Reviews');

?>
<div class="reviews-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a(Yii::t('reviews', 'Create Reviews'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [


	        [
		        'attribute'=>'photo',
		        'label'=>'Фото',
		        'format'=>'raw',
		        'value' => function ($model) {
		        return '<img src="'.$model->photo.'">';},
	        ],
            'name',
            'nick_name',
            'content:ntext',
            'dt_add',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {delete}'],
        ],
    ]); ?>
</div>
