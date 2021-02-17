<?php

namespace backend\modules\settings\controllers;

use backend\modules\settings\models\Settings;
use backend\modules\settings\models\SettingsSearch;
use common\classes\ProxyApi;
use common\models\Proxy;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * SettingsController implements the CRUD actions for Settings model.
 */
class SettingsController extends Controller
{
    /**
     * {@inheritdoc}
     */


    /**
     * Lists all Settings models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SettingsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $names = Settings::find()->all();
        $names = ArrayHelper::map($names, 'key', 'key');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'names' => $names,
        ]);
    }


    public function actionFillProxy()
    {
        $proxy = file($_FILES['ipfile']['tmp_name']);

        $res = array();
        foreach ($proxy as $ip) {
            $res[] = [$ip];
        }

        $model = new Proxy();
        $model->Fill($res);

        Yii::$app->session->setFlash("success", "Адресса proxy добавленны!");
        return $this->redirect(['index']);

    }


    public function actionLoadProxyFromApi()
    {
        $res = ProxyApi::run()->parse()->all();

        $data = array();

        foreach ($res as $r) {
            $data[] = [$r->ip . ':' . $r->port];
        }

        $model = new Proxy();
        $model->Fill($data);

        Yii::$app->session->setFlash("success", "Адресса proxy добавленны!");
        return $this->redirect(['index']);
    }

    /**
     * Displays a single Settings model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Settings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Settings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Settings::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('settings', 'The requested page does not exist.'));
    }

    /**
     * Creates a new Settings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Settings();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash("success", 'Настройка добавлена');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'create' => true
        ]);
    }

    /**
     * Updates an existing Settings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash("success", 'Настройка изменена');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Settings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}
