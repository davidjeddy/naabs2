<?php

namespace frontend\controllers;

use common\models\CCFormat;
use common\models\Country;
use common\models\Device;
use common\models\DeviceCountOptions;
use common\models\TimeAmountOptions;
use davidjeddy\Paypal;
use frontend\controllers\DeviceController;
use frontend\models\Purchase;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PurchaseController implements the CRUD actions for Purchase model.
 */
class PurchaseController extends Controller
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


    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
          'query' => Purchase::find(),
        ]);

        $deviceProvider = new ActiveDataProvider([
          'query' => Device::find()->where(['user_id' => Yii::$app->user->id]),
        ]);

        return $this->render('index', [
          'dataProvider'   => $dataProvider,
          'deviceProvider' => $deviceProvider,
        ]);
    }

    /**
     * Displays a single Purchase model.
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
     * Creates a new Purchase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $cc_format_mdl = new CCFormat();
        $purchase_mdl  = new Purchase();

        if (!empty(Yii::$app->request->post())) {

            // the CCFormat does not actualy save anything to the DB.
            if (!$cc_format_mdl->load(Yii::$app->request->post()) || !$cc_format_mdl->validate()) {

                Yii::$app->getSession()->setFlash('error', 'Card data not valid.');
                return false;
            }

            // save the purchase to the DB if the purchase data is valid
            if (!$purchase_mdl->load(Yii::$app->request->post()) || !$purchase_mdl->validate()) {

                Yii::$app->getSession()->setFlash('error', 'Billing data not valid.');
                return false;
            }

            // save purchase data
            // process PayPal payment
            $paypalResponse = $this->pay($this->prepPayPalData($purchase_mdl, $cc_format_mdl));

            if ($paypalResponse->state == 'approved' && $purchase_mdl->save()) {
                $purchase_mdl->setAttributes([
                    'last_4' => substr($cc_format_mdl->number, -4, 4),
                    'price'  => $paypalResponse->transactions[0]->amount->total,
                ]);
                ;

                if ($purchase_mdl->save()) {

                    if ($this->module->requestedAction->id == 'adddevice'
                        || $this->module->requestedAction->id == 'create'
                    ) {
                        // create devices if the calling methid was 'device'
                        DeviceController::actionCreate($purchase_mdl);

                    } elseif ($this->module->requestedAction->id == 'addtime') {
                        // create time if the calling method was 'time'
                        DeviceController::actionUpdate(null, $purchase_mdl);
                    }

                    \Yii::$app->getSession()->setFlash('success', 'Payment processed, account updated.');
                    \Yii::$app->response->redirect('index');
                }
            } else {

                Yii::$app->getSession()->setFlash('error', 'Payment processor returned an error.');
                return false;
            }

        }

        // no post data, load form
        return $this->render('create', [
            'cc_format_mdl'            => $cc_format_mdl,
            'country_mdl'              => Country::findAll(['deleted_at' => null]),
            'device_count_options_mdl' => DeviceCountOptions::findAll(['deleted_at' => null]), 
            'purchase_mdl'             => $purchase_mdl,
            'time_options_mdl'         => TimeAmountOptions::findAll(['deleted_at' => null]),
        ]);
    }

    /**
     * Adding a device pulls the expiration time from a pre existing device
     *
     * @version  0.6.0
     * @since  0.6.0
     * @return [type] [description]
     */
    public function actionAdddevice()
    {
        $cc_format_mdl = new CCFormat();
        $paypal_com    = new paypal();
        $purchase_mdl  = new Purchase();

        if (!empty(Yii::$app->request->post()) && $this->actionCreate()) {
            \Yii::$app->getSession()->setFlash('success', 'Device added to account.');
            return true;
        }

        return $this->render('adddevice', [
            'cc_format_mdl'            => $cc_format_mdl,
            'device_count_options_mdl' => DeviceCountOptions::findAll(['deleted_at' => null]), 
            'purchase_mdl'             => $purchase_mdl,
        ]);
    }

    public function actionAddtime()
    {   
        if (!empty(Yii::$app->request->post()) && $this->actionCreate()) {
            \Yii::$app->getSession()->setFlash('success', 'Access time added to account.');
            return true;
        }

        return $this->render('addtime', [
            'cc_format_mdl'           => new CCFormat(),
            'purchase_mdl'            => new Purchase(),
            'time_amount_options_mdl' => timeAmountOptions::findAll(['deleted_at' => null]), 
        ]);
    }

    /**
     * Finds the Purchase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Purchase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Purchase::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * [prepPayPalData description]
     *
     * Maps data from the two forms into the way the paypal component expects it.
     * 
     * @version 0.5.1
     * @since  0.5.1
     * @param  Purchase $param_data
     * @param  CCFormat $cc_data
     * @return array
     */
    private function prepPayPalData(Purchase $param_data, CCFormat $cc_data)
    {
        // todo This iteration is Paypal only. - DJE : 2015-04-11
        // Process the CC transaction
        $return_data['Address'] = [
            'City'        => $param_data->getAttribute('city'),
            'CountryCode' => Country::find('value')->where(['id' => $param_data->getAttribute('country_id')])->one()->getAttribute('key'),
            'Line1'       => $param_data->getAttribute('street_1'),
            'Line2'       => $param_data->getAttribute('street_2'),
            'PostalCode'  => $param_data->getAttribute('postal'),
            'State'       => $param_data->getAttribute('prov'),
        ];

        // Process the CC transaction
        $return_data['CreditCard'] = [
            'Cvv2'      => $cc_data['cvv2'],
            'FirstName' => $param_data->getAttribute('f_name'),
            'LastName'  => $param_data->getAttribute('l_name'),
            'Month'     => $cc_data['exp_month'],
            'Number'    => $cc_data['number'],
            'Type'      => $cc_data['type'],
            'Year'      => $cc_data['exp_year'],
        ];

        $subtotal    = [];
        $subtotal[0] = isset(\Yii::$app->request->post()['Purchase']['time_amount_id']) 
            ? TimeAmountOptions::find('value')->where(['id' => \Yii::$app->request->post()['Purchase']['time_amount_id']])->one()->getAttribute('cost')  
            : 0;
        $subtotal[1] = isset(\Yii::$app->request->post()['Purchase']['device_count_id'])
            ? DeviceCountOptions::find('value')->where(['id' => \Yii::$app->request->post()['Purchase']['device_count_id']])->one()->getAttribute('cost')
            : 0;

        $return_data['Details']['SubTotal'] = array_sum($subtotal);

        return $return_data;
    }

    /**
     * [pay description]
     * 
     * @param  array  $paramData [description]
     * @return [type]            [description]
     */
    private function pay(array $paramData) {
        $paypalComponent = new Paypal();

        try {
            return $paypalComponent->execTransaction($paramData);
        } catch (Exception $ex) {
            echo PaypalError($e);
        }

        return false;
    }
}
