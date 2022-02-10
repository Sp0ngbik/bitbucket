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
                'only' => ['login', 'logout', 'signup',],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup',],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout','create','update'],
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
       if(Yii::$app->request->get('login_counter')>3){
           $model->scenario = 'withCaptcha';
       }
       if (isset($_POST['LoginForm'])) {
        $model->attributes = $_POST['LoginForm'];
         
        if($model->validate()&&$model->login()){
            Yii::$app->request->post('login_counter',0);
        }else{
            $connection = Yii::$app->db;
            $connection->createCommand()->update('login_counter',['status'=>1])->execute();
        }
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
            // $model->login_counter = Yii::$app->request->post('login_counter',Yii::$app->request->get('login_counter',1)+1);

            // $model->login_counter = md5(random_bytes(15));
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
