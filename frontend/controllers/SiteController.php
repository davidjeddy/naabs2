<?php

namespace frontend\controllers;

use common\models\AppData;
use common\models\LoginForm;
use common\models\TimeAmountOptions;
use common\models\User;
use common\models\UserDetails;

use frontend\models\ContactForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;

use Yii;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

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
               'only' => ['logout', 'signup', 'tos', 'account', 'billing'],
               'rules' => [
                   [
                       'actions' => ['tos', 'signup'],
                       'allow' => true
                   ],
                   [
                       'actions' => ['logout', 'account', 'billing'],
                       'allow' => true,
                       'roles' => ['@'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['supportEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionTos()
    {
        $tos_data = AppData::find()->where(['key' => 'tos'])->one();

        return $this->render('tos', [
            'tos_data' => $tos_data->getAttribute('value'),
        ]);
    }

    public function actionAccount()
    {
        $details  = UserDetails::findOne(['user_id' => Yii::$app->user->identity->id]);

        if (Yii::$app->request->post()) {
            $details->setAttributes(Yii::$app->request->post()['UserDetails']);
            $details->save();
        }

        return $this->render('account', [
            'details' => $details,
        ]);
    }

    /**
     *
     * @todo  find how how to get the next inserted ID, reserve it, and save both User and UserDetails at the same time.
     * @return [type] [description]
     */
    public function actionSignup()
    {
        $signupform  = new SignupForm();
        $userDetails = new UserDetails();

        $data = Yii::$app->request->post();

        if ($signupform->load($data)) {

            if ($user = $signupform->signup()) {
                // get the users ID fron the users TBO && add it to the users details TBO obj
                $data['UserDetails']['user_id'] = $user->getAttribute('id');
                $userDetails->load($data);

                if ($userDetails->save()) {

                    if (Yii::$app->getUser()->login($user)) {
                        return \Yii::$app->response->redirect(['site/signup-complete']);
                    }
                }
            }
        }

        return $this->render('signup', [
            'model'   => $signupform,
            'details' => $userDetails,
        ]);
    }

    /**
     *
     * @todo  find how how to get the next inserted ID, reserve it, and save both User and UserDetails at the same time.
     * @return [type] [description]
     */
    public function actionSignupComplete()
    {
        // return user if referrer is not from signup form        
        if (!strstr(\Yii::$app->request->referrer, "site/signup")) {
            return $this->goBack();
        }

        return $this->render('signup_complete', [
            'details' => \common\models\User::find()
                ->andWhere(['id' => \Yii::$app->user->getIdentity()->id])
                ->one()
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
