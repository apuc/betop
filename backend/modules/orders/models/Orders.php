<?php

namespace backend\modules\orders\models;

use backend\modules\balance\models\Balance;
use backend\modules\cases\models\Cases;
use common\models\Debug;
use common\models\History;
use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $accounts_id
 * @property int $cases_id
 * @property int $status
 * @property string $dt_add
 */
class Orders extends \common\models\Orders
{
	public function beforeSave( $insert ) {
		$post = Yii::$app->request->post()['Orders'];
		if($this->getStatus($this->id)) {
			Yii::$app->session->setFlash('error', "Заказ уже был выполнен!");
			return false;
		}
		if($post['status']) {
			$case = Cases::find()->where(['id' => $post['cases_id']])->one();
			$bal = Balance::find()->where(['accounts_id' => $post['accounts_id']])->one();
			$history = new History();
			if($bal) {
				$bal->likes = $bal->likes + $case->likes;
				$bal->views = $bal->views + $case->views;
				$history->name = $history::TRANSFER_TO_BALANCE;
				$history->description = $history::TRANSFER_TO_BALANCE. ' просмотров = '. $case->views. ', лайков = '.$case->likes;
				$history->accounts_id = $bal->accounts_id;
			} else {
				$bal = new Balance();
				$bal->accounts_id = $post['accounts_id'];
				$bal->likes = $case->likes;
				$bal->views = $case->views;
				$history->name = $history::CREATE_BALANCE;
				$history->description = $history::TRANSFER_TO_BALANCE. ' просмотров = '. $case->views. ', лайков = '.$case->likes;
				$history->accounts_id = $bal->accounts_id;
			}
			$bal->save();
			$history->save();
			Yii::$app->session->setFlash('success', "Заказ выполнен!");
		} else {
			Yii::$app->session->setFlash('error', "Заказ не выполнен!");
			return false;
		}
			return parent::beforeSave( $insert ); // TODO: Change the autogenerated stub
	}
	
	public function getStatus ($id) {
		if(Orders::findOne(['id' => $id]) && Orders::findOne(['id' => $id])->status == 1 ) {
			return true;
		}
		return false;
	}
}