<?php
/**
 * Created by PhpStorm.
 * User: skat
 * Date: 27.11.18
 * Time: 9:41
 */

namespace frontend\modules\cabinet\controllers;

use common\classes\FreeCassa;
use common\models\OrdersCash;
use common\models\Settings;
use frontend\modules\api\controllers\ApiController;
use Yii;
use yii\web\Controller;


class PaymentCashController extends Controller
{

    public function actionIndex()
    {
        //$cases = Cases::findAll(['status'=>1]);
        //$res = array();
        //$defaultCase = $cases[0];
        $default_sum = 150;
        $exchange_rate = floatval(Settings::getSetting('exchange_rate_usd'));
        $default_usd = round($default_sum / floatval($exchange_rate), 6);

        $order_id = uniqid('id_', true) . '_' . Yii::$app->user->id;
        $form_sign = FreeCassa::generateSign($default_sum . '.00', FreeCassa::SECRET_1, $order_id);

        //foreach ($cases as $case)
        //{
        //   $res[$case->id."|".$case->price] = $case->__toString();
        //}

        return $this->render('pay-form', [
            'default_sum' => $default_sum,
            'merchant_id' => FreeCassa::SHOP_ID,
            'form_sign' => $form_sign,
            'order_id' => $order_id,
            'exchange_rate' => $exchange_rate,
            'default_usd' => $default_usd
        ]);
    }

    public function actionPutOrder()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $data = Yii::$app->request->post();
            if (isset($data['order_id']) && isset($data['usd']) && isset($data['amount'])) {
                $exchange_rate = floatval(Settings::getSetting('exchange_rate_usd'));
                $usd = strval(round($data['amount'] / $exchange_rate, 6));

                $model = new OrdersCash();
                $model->user_id = Yii::$app->user->id;
                $model->order_id = $data['order_id'];
                $model->usd = $usd;
                $model->amount = $data['amount'];
                $model->date = date('Y-m-d H-i-s');
                $model->is_paid = 0;
                if ($model->save()) {
                    return [
                        'code' => 200,
                        'usd' => $usd
                    ];
                } else {
                    return [
                        'code' => 100,
                        'msg' => "Не получилось сохранить ваш заказ, попробуйте, пожалуйста, позднее"
                    ];
                }
            }
            return [
                'code' => 100,
                'msg' => "Не хватает параметров"
            ];
        }
        return 100;
    }

    public function actionGetFormSecret()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $order_id = uniqid('id_', true) . '_' . Yii::$app->user->id;
            $sum = Yii::$app->request->post('sum');;
            return [
                'sign' => FreeCassa::generateSign($sum, FreeCassa::SECRET_1, $order_id),
                'code' => 200,
                'order_id' => $order_id,
            ];
        }
        return 100;
    }
}