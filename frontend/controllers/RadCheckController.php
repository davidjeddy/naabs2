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
    public static function actionCreateUserpass($_param_data)
    {
        $_method_data = [];
        $_model = null;
        
        // existing record
        if ( !($_model = RadCheck::find()->where([
                'attribute' => 'MD5-Password',
                'username'  => $_param_data,
            ])->one()) ) {
            $_model = new RadCheck();                                                                                       
        }

        // we might only have to update the `attribute` but this is simply for insert/update
        $_method_data['attribute'] = 'MD5-Password';
        $_method_data['op']        = ':=';
        $_method_data['username']  = $_param_data;
        $_method_data['value']     = md5($_param_data);

        $_model->setAttributes($_method_data);

        return ($_model->save() ? true : $_model->getErrors());
    }
}
