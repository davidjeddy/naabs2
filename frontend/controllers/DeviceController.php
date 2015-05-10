<?php

namespace frontend\controllers;

use Yii;
use common\models\Device;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use frontend\controllers\RadCheckController;

use common\models\DeviceCountOptions;
use common\models\TimeAmountOptions;
use common\models\User;
use common\models\UserDetails;

/**
 * DeviceController implements the CRUD actions for Device model.
 */
class DeviceController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Device models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Device::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Device model.
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
     * Creates a new Device model.
     * 
     * @return mixed
     */
    public static function actionCreate($param_data = null)
    {
        $model = new Device();

        if ($param_data) {
            $current_exp = DeviceController::getCurrentExpiration($param_data);



            // calculate current and future device count
            $current_device_count = Device::find()->where(['user_id' => $param_data['user_id']])->count();
            $current_device_count = ($current_device_count > 0)
                ? $current_device_count
                : 0;
            $new_device_count = DeviceCountOptions::find('value')->where(['id' => $param_data->getAttribute('device_count_id')])->one()->getAttribute('value');
            $final_device_count = $current_device_count + $new_device_count;

            // misc req. info
            $username = User::find()->where(['id' => $param_data->getAttribute('user_id')])->one()->getAttribute('username');
            $user_id  = $param_data->getAttribute('user_id');



            // loop for the # of devices purchased
            while ($current_device_count < $final_device_count) {
                $device_mdl = new Device();
                $device_mdl->setAttribute('created_at',     time());  
                $device_mdl->setAttribute('device_name',    $username.' '.++$current_device_count);
                $device_mdl->setAttribute('expiration',     $current_exp);
                $device_mdl->setAttribute('pass_phrase',    DeviceController::generateRandomString());
                $device_mdl->setAttribute('user_id',        $user_id);

                // save entery and insert into RadCheck
                if (!$device_mdl->validate() || !$device_mdl->save()) {
                    Yii::$app->getSession()->addFlash('error', 'Error saving new devices to your account.');
                    return false;
                } else {
                    //RadCheckController::actionCreate($device_mdl);
                }
            }
            
            Yii::$app->getSession()->addFlash('success', $new_device_count .' device(s) successfully added to your account.');
            return $device_mdl;
        }





        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Device model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public static function actionUpdate($id, $param_data = null)
    {
        // update all the devices of a user as per user_id
        if ($param_data) {
            $new_exp = DeviceController::getCurrentExpiration($param_data);
            $time   = TimeAmountOptions::find()->where(['id' => $param_data['time_amount_id']])->one()->getAttribute('key');

            // Customer::updateAll(['status' => 1], 'status = 2');
            if (Device::updateAll(['expiration' => $new_exp], ['user_id'    => $param_data['user_id']]) ) {
                Yii::$app->getSession()->addFlash('success', $time.' added to your account.');
                return $new_exp;
            } else {
                Yii::$app->getSession()->addFlash('error', 'Unable to add '.$time.' to your account.');
                return $new_exp;
            }
            

            return false;
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Device model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Device model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Device the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Device::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     *
     * @todo  abstract this into a lib somewhere
     * @source http://stackoverflow.com/questions/4356289/php-random-string-generator
     */
    public static function generateRandomString ($length = 6) {
        $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString     = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Get the users current expiration time, OR current timestamp OR future expiration time
     *
     * @version  0.6.5
     * @since 0.6.5
     * @param  object $param_data
     * @return integer $return_data
     */
    private static function getCurrentExpiration($param_data)
    {
        $prev_expiration = Device::find()->where(['user_id' => $param_data['user_id']])->one();

        // calculate the new expiration time
        $return_data  = (isset($prev_expiration) && count($prev_expiration) > 0)
            ? $prev_expiration->getAttribute('expiration')
            : time();

        // if the form wants to set a new expiratin time
        if ($param_data->getAttribute('time_amount_id') !== null) {
            $return_data =  $return_data + TimeAmountOptions::find()->where(['id' => $param_data->getAttribute('time_amount_id')])->one()->getAttribute('value');
        };

        return $return_data;
    }
}
