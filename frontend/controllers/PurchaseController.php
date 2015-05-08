<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use frontend\models\Purchase;
use common\models\Device;

use frontend\controllers\RadCheckController;
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
        $paypal_com    = new paypal();
        $purchase_mdl  = new Purchase();
        


        if (!empty(Yii::$app->request->post())) {

            // the CCFormat does not actualy save anything to the DB.
            if ($cc_format_mdl->load(Yii::$app->request->post()) && $cc_format_mdl->validate()) {

                // for the sake of consistancty, empty success logic block
            } else {

                Yii::$app->getSession()->addFlash('error', 'Card data not valid.');
            }



            if ($purchase_mdl->load(Yii::$app->request->post()) && $purchase_mdl->validate()) {
                $pp_purchase_data = $this->prepPayPalData($purchase_mdl, $cc_format_mdl);
                $response_message = 'not approved';

                $purchase_mdl->setAttribute('price',            $pp_purchase_data['amountdetails']['subtotal']);
                $purchase_mdl->setAttribute('return_message',   $response_message);
                $purchase_mdl->setAttribute('return_code',      http_response_code());
                $purchase_mdl->setAttribute('last_4',           substr($cc_format_mdl->number, -4) );



                /*
                $_payment_result  = $paypal_com->setDate($pp_purchase_data)->processCreditCardPayment();
                $response_message = (
                    $_payment_result->getState() == 'approved' ? 'approved' : $_payment_result->getFailedTransactions()
                );*/
                $response_message = "approved";



                // payment has cleared. Create the devices.
                if ( $response_message == "approved" && $purchase_mdl->save()) {

                    // if the devices are created successfully
                    if (DeviceController::actionCreate($purchase_mdl)) {

                        // push them into the radcheck table
                    }




                    // devices create / updated as needed.
                    /*
                    if (RadCheckController::actionCreateUserpass($_user_email) &&
                        RadCheckController::actionCreateExpiration($_user_email, $_value )
                    ) {

                        return $this->redirect(['view', 'id' => $purchase_mdl->id]);
                    } else {
                        
                        Yii::$app->getSession()->addFlash('error', 'Payment processed OK, however an error occured while processing the access request.');
                    }
                    */

                    // redirect to Purchase/index if all goes well
                    return $this->redirect('../purchase/index');
                } else {

                    Yii::$app->getSession()->addFlash('error', 'Payment processor returned an error.');
                }

            } else {

                Yii::$app->getSession()->addFlash('error', 'Billing data not valid.');
            }
        }



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

        // add time and qunatity into total
        $return_data['amountdetails']['subtotal'] = (
            TimeAmountOptions::find('value')->where([
                'id' => Yii::$app->request->post()['Purchase']['time_amount_id']
            ])->one()->getAttribute('cost')
            +
            DeviceCountOptions::find('value')->where([
                'id' => Yii::$app->request->post()['Purchase']['device_count_id']
            ])->one()->getAttribute('cost')
        );

        return $return_data;
    }
}
