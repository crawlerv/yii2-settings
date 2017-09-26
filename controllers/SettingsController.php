<?php

//namespace backend\controllers;
namespace crawlerv\settings\controllers;

use Yii;
use common\models\Settings;
use common\models\SettingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SettingsController implements the CRUD actions for Settings model.
 */
class SettingsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Settings models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SettingsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Settings model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
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
            if (\Yii::$app->cache && \Yii::$app->settings && \Yii::$app->settings->cachePrefix) {
                \Yii::$app->cache->flush();
                foreach (Settings::find()->active()->asArray()->all() as $set) {
                    $data[$set['key']] = $set['value'];
                    \Yii::$app->cache->set(\Yii::$app->settings->cachePrefix, $data);
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Settings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (\Yii::$app->cache && \Yii::$app->settings && \Yii::$app->settings->cachePrefix) {
                \Yii::$app->cache->flush();
                foreach (Settings::find()->active()->asArray()->all() as $set) {
                    $data[$set['key']] = $set['value'];
                    \Yii::$app->cache->set(\Yii::$app->settings->cachePrefix, $data);
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
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
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        if (\Yii::$app->cache && \Yii::$app->settings && \Yii::$app->settings->cachePrefix) {
            \Yii::$app->cache->flush();
            foreach (Settings::find()->active()->asArray()->all() as $set) {
                $data[$set['key']] = $set['value'];
                \Yii::$app->cache->set(\Yii::$app->settings->cachePrefix, $data);
            }
        }

        return $this->redirect(['index']);
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

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
