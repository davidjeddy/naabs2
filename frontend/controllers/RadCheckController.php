<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use frontend\models\RadCheck;



class RadCheckController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('');
    }

    /**
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public static function actionCreateExpiration($_param_data, $_value, $_op = ':=')
    {
        $_method_data = [];
        $_model        = null;

        // existing record
        if ( !($_model = RadCheck::find()->where([
                'attribute' => 'Expiration',
                'username'  => $_param_data,
            ])->one()) ) {
            $_model = new RadCheck();                                                                                       
        }

        // we might only have to update the `attribute` but this is simply for insert/update
        $_method_data['attribute'] = 'Expiration';
        $_method_data['op']        = $_op;
        $_method_data['username']  = (string)$_param_data;
        // if time already exists, add to it
        $_method_data['value']     = (string)(!empty($_model->getAttribute('value')) ? $_model->getAttribute('value')+$_value : time()+$_value);

        $_model->setAttributes($_method_data);

        return ($_model->save() ? true : $_model->getErrors());
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

            // insert a new device entery for expxiration
            $device_mdl = new RadCheck();
            $device_mdl->setAttribute('username',   $param_data->getAttribute('device_name'));  
            $device_mdl->setAttribute('attribute',  'expiration');
            $device_mdl->setAttribute('op',         ':=');
            $device_mdl->setAttribute('value',      $param_data->getAttribute('expiration'));
            $device_mdl->save();

            return true;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
}
