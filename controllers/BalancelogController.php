<?php

namespace app\controllers;

use app\models\Balancelog;
use app\models\Users;
use app\models\TransferForm;
use app\models\NewUser;
use app\models\BalancelogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BalancelogController implements the CRUD actions for Balancelog model.
 */
class BalancelogController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**  
     * Lists all Balancelog models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BalancelogSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Balancelog model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $log = Balancelog::findOne(['id' => $id]);
        $arrayLog = BalanceLog::find()->where(['username' => $log->username])->all();
        $arrayLogRecieves = BalanceLog::find()->where(['username_send' => $log->username])->all();
        $searchModel = new BalancelogSearch();
        $dataProvider = $searchModel->searchUserSend($arrayLog);
        $dataProviderReciever = $searchModel->searchUserRecieve($arrayLogRecieves);
        return $this->render('view', [
            'arrayLogRecieves' => $arrayLogRecieves,
            'arrayLog' => $arrayLog,
            'dataProvider' => $dataProvider,
            'dataProviderReciever' => $dataProviderReciever,
            'log' => $log,

        ]);
    }

    /**
     * Creates a new Balancelog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Balancelog();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Balancelog model.
     * If update is successful, the browser will be redirected to the 'view' page. 
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */


    /**
     * Deletes an existing Balancelog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $logReturnBalance = BalanceLog::findOne(['id' => $id]);
        $userReturnBalance = Users::findOne(['username' => $logReturnBalance->username]);
        $userLoseBalance = Users::findOne(['username' => $logReturnBalance->username_send]);

        if ($this->findModel($id)->delete()) {
            $userReturnBalance->balance = $userReturnBalance->balance + $logReturnBalance->changing_value;
            $userReturnBalance->update();
            $userLoseBalance->balance = $userLoseBalance->balance - $logReturnBalance->changing_value;
            $userLoseBalance->update();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Balancelog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Balancelog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Balancelog::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
