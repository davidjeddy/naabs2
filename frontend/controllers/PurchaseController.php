<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use frontend\models\Purchase;
use common\models\Device;

use frontend\controllers\DeviceController;

use common\components\Paypal;
use common\models\CCFormat;
use common\models\Country;
use common\models\DeviceCountOptions;
use common\models\TimeAmountOptions;


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

                Yii::$app->getSession()->addFlash('error', 'Card data not valid.');
                return false;
            }

            // save the purchase to the DB if the purchase data is valid
            if (!$purchase_mdl->load(Yii::$app->request->post()) || !$purchase_mdl->validate()) {

                Yii::$app->getSession()->addFlash('error', 'Billing data not valid.');
                return false;
            }

            // process PayPal payment
            if ($this->processPayPal($this->prepPayPalData($purchase_mdl, $cc_format_mdl))) {

                $this->actionIndex();
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

        if (!empty(Yii::$app->request->post())) {
            $this->actionCreate();
        }

        return $this->render('adddevice', [
            'cc_format_mdl'            => $cc_format_mdl,
            'device_count_options_mdl' => DeviceCountOptions::findAll(['deleted_at' => null]), 
            'purchase_mdl'             => $purchase_mdl,
        ]);
    }

    public function actionAddtime()
    {
        $cc_format_mdl = new CCFormat();
        $paypal_com    = new paypal();
        $purchase_mdl  = new Purchase();
        
        if (!empty(Yii::$app->request->post())) {
            $this->actionCreate();
        }

        return $this->render('addtime', [
            'cc_format_mdl'            => $cc_format_mdl,
            'time_amount_options_mdl' => timeAmountOptions::findAll(['deleted_at' => null]), 
            'purchase_mdl'             => $purchase_mdl,
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
        $return_data['address'] = [
            'street_1' => $param_data->getAttribute('street_1'),
            'street_2' => $param_data->getAttribute('street_2'),
            'city'     => $param_data->getAttribute('city'),
            'prov'     => $param_data->getAttribute('prov'),
            'postal'   => $param_data->getAttribute('postal'),
            'country'  => Country::find('value')->where(['id' => $param_data->getAttribute('country_id')])
                ->one()->getAttribute('key'),
        ];

        // Process the CC transaction
        $return_data['creditcard'] = [
            'type'      => $cc_data['type'],
            'cvv2'      => $cc_data['cvv2'],
            'exp_month' => $cc_data['exp_month'],
            'exp_year'  => $cc_data['exp_year'],
            'number'    => $cc_data['number'],
            'f_name'    => $param_data->getAttribute('f_name'),
            'l_name'    => $param_data->getAttribute('l_name'),
        ];

        $subtotal    = [];
        $subtotal[0] = isset(Yii::$app->request->post()['Purchase']['time_amount_id']) 
            ? TimeAmountOptions::find('value')->where(['id' => Yii::$app->request->post()['Purchase']['time_amount_id']])->one()->getAttribute('cost')  
            : 0;
        $subtotal[1] = isset(Yii::$app->request->post()['Purchase']['device_count_id'])
            ? DeviceCountOptions::find('value')->where(['id' => Yii::$app->request->post()['Purchase']['device_count_id']])->one()->getAttribute('cost')
            : 0;
        $return_data['amountdetails']['subtotal'] = array_sum($subtotal);

        return $return_data;
    }

    /**
     * [processPayPal description]
     * @param  array  $paramData [description]
     * @return Payment           [description]
     */
    public function processPayPal($paramData = [])
    {
        if (empty($paramData)) { return false; }

        $addr = new \PayPal\Api\Address();
        $addr->setLine1($paramData['address']['street_1']);
        $addr->setLine2($paramData['address']['street_1'] ?: NULL);
        $addr->setCity($paramData['address']['city']);
        $addr->setCountryCode($paramData['address']['country']);
        $addr->setPostalCode($paramData['address']['postal']);
        $addr->setState($paramData['address']['prov']);

        $card = new \PayPal\Api\CreditCard();
        $card->setNumber($paramData['creditcard']['number']);
        $card->setType($paramData['creditcard']['type']);
        $card->setExpireMonth($paramData['creditcard']['exp_month']);
        $card->setExpireYear($paramData['creditcard']['exp_year']);
        $card->setCvv2($paramData['creditcard']['cvv2']);
        $card->setFirstName($paramData['creditcard']['f_name']);
        $card->setLastName($paramData['creditcard']['l_name']);
        $card->setBillingAddress($addr);

        $fi = new \PayPal\Api\FundingInstrument();
        $fi->setCreditCard($card);

        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('credit_card');
        $payer->setFundingInstruments(array($fi));

        $amountDetails = new \PayPal\Api\Details();
        $amountDetails->setSubtotal($paramData['amountdetails']['subtotal']);
        $amountDetails->setTax(($paramData['amountdetails']['subtotal'] * \Yii::$app->params['paymentDetails']['taxRate']));
        $amountDetails->setShipping(\Yii::$app->params['paymentDetails']['shippingRate']);

        $amount = new \PayPal\Api\Amount();
        $amount->setCurrency(\Yii::$app->params['paymentDetails']['currency']);
        $amount->setTotal(
            $paramData['amountdetails']['subtotal']
            + \Yii::$app->params['paymentDetails']['shippingRate']
            + ($paramData['amountdetails']['subtotal'] * \Yii::$app->params['paymentDetails']['taxRate'])
        );
        $amount->setDetails($amountDetails);

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription(\Yii::$app->params['purchaseDescription']);

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setTransactions(array($transaction));

        $apiContext = new Paypalpayment::ApiContext(
            Paypalpayment::OAuthTokenCredential(
                $this->_ClientId, // \Yii::$app->component->paypal->clientId
                $this->_ClientSecret // \Yii::$app->component->paypal->clientId
            ), 'Request' . time()
        );

        $response = $payment->create($apiContext->_apiContext);
    }
}
