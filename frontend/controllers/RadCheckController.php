<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use frontend\models\RadCheck;
use common\models\Device;


class RadCheckController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('');
    }

    /**
     * Create the user in the radcheck TBO
     *
     * @todo  Move this to be a model::()
     * @return [type] [description]
     */
    public static function actionCreate($param_data = null)
    {
        // insert into RadCheck TBO for FreeRadius
        if ($param_data) {
            // insert a new device entery for pass_phrase
            $device_mdl = new RadCheck();
            $device_mdl->setAttribute('username',   $param_data->getAttribute('device_name'));  
            $device_mdl->setAttribute('attribute',  'clear-password');
            $device_mdl->setAttribute('op',         ':=');
            $device_mdl->setAttribute('value',      $param_data->getAttribute('pass_phrase'));
            $device_mdl->save();
            unset($device_mdl);

            // insert a new device entery for expxiration
            $device_mdl = new RadCheck();
            $device_mdl->setAttribute('username',   $param_data->getAttribute('device_name'));  
            $device_mdl->setAttribute('attribute',  'expiration');
            $device_mdl->setAttribute('op',         ':=');
            $device_mdl->setAttribute('value',      (string)$param_data->getAttribute('expiration'));
            $device_mdl->save();

            if (count($device_mdl->getErrors()) == 0) {
                return true;
            } 

            Yii::$app->getSession()->addFlash('error', 'Unable to create the system.');
            return false;
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
    public static function actionUpdate($id, $param_data = null, $new_exp = null)
    {
        // update multi RadCheck enteries with new data
        if ($param_data && is_numeric($new_exp)) {

            $user_devices_ar = Device::find()
                ->where(['user_id' => $param_data['user_id']])
                ->all();

            foreach ($user_devices_ar as $key => $value) {
                $radcheck_mdl = RadCheck::find()->where([
                        'attribute' => 'expiration',
                        'username'  => $value->getAttribute('device_name'),
                    ])->one();
                $radcheck_mdl->value = (string)$new_exp;
                $radcheck_mdl->save();
            }

            if (count($radcheck_mdl->getErrors()) == 0) {
                return true;
            } 

            Yii::$app->getSession()->addFlash('error', 'Unable to update the system.');
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
}
