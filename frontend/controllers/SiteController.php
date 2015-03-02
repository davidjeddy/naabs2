<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use common\models\UserDetails;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\User;

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
               'only' => ['logout', 'signup', 'about', 'account', 'billing'],
               'rules' => [
                   [
                       'actions' => ['signup'],
                       'allow' => true,
                       'roles' => ['?'],
                   ],
                   [
                       'actions' => ['about'],
                       'allow' => true,
                       'roles' => ['@'],
                   ],
                   [
                       'actions' => ['logout'],
                       'allow' => true,
                       'roles' => ['@'],
                   ],
                   [
                       'actions' => ['account'],
                       'allow' => true,
                       'roles' => ['@'],
                   ],
                   [
                       'actions' => ['billing'],
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
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
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

    public function actionAbout()
    {
        return $this->render('about');
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

    public function actionBilling()
    {
        return $this->render('billing');
    }

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
                        return $this->goHome();
                    }
                }
            }
        }

        return $this->render('signup', [
            'model'   => $signupform,
            'details' => $userDetails,
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