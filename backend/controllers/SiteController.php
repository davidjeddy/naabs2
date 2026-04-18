<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

use common\models\LoginForm;
use common\models\UserDetails;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['logout', 'index'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                    [
                        'actions' => ['login', 'error'],
                        'allow'   => true,
                        'roles'   => ['?'],
                    ],
                    [
                        'allow' => (boolean)UserDetails::find()
                            ->where(['>=', 'role', 20])
                            ->andWhere(['id' => Yii::$app->user->id])
                            ->one(),
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * [actionLogin description]
     * @return [type] [description]
     */
    public function actionLogin()
    {
       if (!\Yii::$app->user->isGuest) {
          return $this->goHome();
       }
     
       $model = new LoginForm();
       if ($model->load(Yii::$app->request->post()) && $model->loginAdmin()) {
          return $this->goBack();
       } else {
           return $this->render('login', [
              'model' => $model,
           ]);
       }
    }
}
