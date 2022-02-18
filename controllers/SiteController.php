<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\NewUser;
use app\models\Users;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login', 'logout', 'signup','transfer'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup',],
                        'roles' => ['?'],
                    ],
                    ['allow'=>false,
                'actions'=>['transfer'],
            'roles'=>['?']],
                    [
                        'allow' => true,
                        'actions' => ['logout','create','update','transfer'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
 
        public function actionTransfer(){
            $model = new LoginForm();
            $user = new NewUser;
            $model->scenario = 'fieldsUsername';
            if($model->load(Yii::$app->request->post())){
                $currentUsername = NewUser::findByUsername($model->currentUser);
                $userSend = NewUser::findByUsername($model->usernameSend);
                if(!$currentUsername){
                    $model->addError('currentUser','No username found');
                } else if(password_verify($model->password,$currentUsername->password)){
                     if(!$userSend){
                    $model->addError('usernameSend','No username found');
                }  else if($model->valueToSend > $currentUsername->balance){
                    $model->addError('valueToSend','Not enough balance'); 
                }else if($currentUsername==$userSend){
                    $model->addError('usernameSend','You cant transfer balance to yourself');
                }else if($model->valueToSend<=-1){
                   $model->addError('valueToSend','You cant transfer negative or null balance');
                }else if(
                    $model||!$this->hasErrors()
                ){  
                    $currentUsername->balance -=  $model->valueToSend;
                    $currentUsername->update();
                    $userSend->balance +=  $model->valueToSend;
                    $userSend->update();
                    return $this->refresh();
                }}else{
                    $model->addError('password','Incorrect password');
                }
              
                
            }
            return $this->render('transfer',['model'=>$model]);
            }
    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $model = new LoginForm();
       
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
     
 
  
      
        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }
  //First of all, Yii::app()->user->setState() is from Yii1, and Yii::$app->request->cookies is from Yii2.
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionRegister(){
{
    $model = new NewUser();

    if ($model->load(Yii::$app->request->post())) {
        if ($model->validate()) {
            // form inputs are valid, do something here
            $model->username = $_POST['NewUser']['username'];
            $model->password = Yii::$app->getSecurity($_POST["NewUser"]["password"])->generatePasswordHash($model->password);
            $model->auth_key = md5(random_bytes(5));
            $model->acess_token = password_hash(random_bytes(10),PASSWORD_DEFAULT);
 
            if($model->save()){
                return $this->redirect(['login', 'id' => $model->id, ]);
                die();
            }
        }
    }

    return $this->render('register', [
        'model' => $model,
    ]);
}}
}
