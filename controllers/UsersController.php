<?php

namespace app\controllers;

use app\models\Users;
use app\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use Yii;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    private $_old_password;
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
            ],
         [ 'access' => [
            'class' => AccessControl::class,
            'only' => ['update', 'delete','create'],
            'rules' => [
                [
                    'allow' => false,
                    'actions' => ['update','delete','create' ],
                    'roles' => ['?'],
                ],
             [
                 'allow'=> true,
                 'actions' => ['update','delete' ,'create'],
                 'roles' => ['@'], 
             ]
            ],
        ]]
    );

    }

    /**
     * Lists all Users models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
     public function actionChange_password()
     {
         $model= Yii::$app->model->identity;
         $loadedPost = $model->load(Yii::$app->request->post());
         if($loadedPost&&$model->validate()){
             $model->newPassword = $model->password;
             $model->save(false);
             return $this->$model->password;
            }
           
      return $this->render("_form", [
          'model'=>$model,
      ]);
     }
    /**
     * Displays a single Users model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
  
  public function actionCreate()
    {
        $model = new Users();
        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) { 
                if ($model->validate()) {
                    $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->newPassword);
                    $model->acess_token = password_hash(random_bytes(10),PASSWORD_DEFAULT);
                    $model->auth_key = md5(random_bytes(5));
   
                    if($model->save()){
                        return $this->redirect(['index', 'id' => $model->id, ]);
                        die();
                    }
                }
            }
        } 
        
     return $this->render('create', [
    'model' => $model,
     ]);
    }
    // /**
    //  * Updates an existing Users model.
    //  * If update is successful, the browser will be redirected to the 'view' page.
    //  * @param int $id ID
    //  * @return string|\yii\web\Response
    //  * @throws NotFoundHttpException if the model cannot be found
    //  */
 

  
    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function afterFind(){
    //     //$this->_old_password = $model->password;
    //     parent::afterFind();
    // }
  
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
        
            if ($model->validate()) {
                if(
                    $model->newPassword !== ""
                ){
                    $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->newPassword);
                }
                //$model->newPassword == "" ?null:$model->password = Yii::$app->getSecurity()->generatePasswordHash($model->newPassword);
                if($model->save()){
                    return $this->redirect(['index', 'id' => $model->id, ]);
                    die();
                }
            }
        }
        return $this->render('update', [    
            'model' => $model,
        ]);
    }
    // public function beforeSave(){
    //     if(parent::beforeSave())
    //     {
    //         //if($model->newPassword == null)
    //         //{
    //         //    $model->password = $this->_old_password;
    //         //}   
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }
    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
