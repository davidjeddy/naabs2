<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use frontend\models\Purchase;

use frontend\controllers\RadCheckController;

use common\components\Paypal;
use common\models\CCFormat;
use common\models\Country;
use common\models\DeviceCountOptions;
use common\models\TimeAmountOptions;
use common\models\User;
use common\models\UserDetails;

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

        return $this->render('index', [
          'dataProvider' => $dataProvider,
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
            if ($cc_format_mdl->load(Yii::$app->request->post()) && $cc_format_mdl->validate()) {

                // for the sake of consistancty, empty success logic block
            } else {

                Yii::$app->getSession()->addFlash('error', 'Card data not valid.');
            }



            $purchase_mdl->setAttribute('last_4',    substr($cc_format_mdl->number, -4) );
            $purchase_mdl->setAttribute('timestamp', date('U') );
            if ($purchase_mdl->load(Yii::$app->request->post()) && $purchase_mdl->validate()) {

                // save attempt at payment for record keeping
                if ($purchase_mdl->save()) {



                    // todo This iteration is Paypal only. - DJE : 2015-04-11
                    // Process the CC transaction
                    $pp_purchase_data['address'] = [
                        'street_1' => $purchase_mdl->getAttribute('street_1'),
                        'street_2' => $purchase_mdl->getAttribute('street_2'),
                        'city'     => $purchase_mdl->getAttribute('city'),
                        'prov'     => $purchase_mdl->getAttribute('prov'),
                        'postal'   => $purchase_mdl->getAttribute('postal'),
                        'country'  => Country::find('value')->where(['id' => $purchase_mdl->getAttribute('country_id')])
                            ->one()->getAttribute('key'),
                    ];

                    // Process the CC transaction
                    $pp_purchase_data['creditcard'] = [
                        'type'      => $cc_format_mdl['type'],
                        'cvv2'      => $cc_format_mdl['cvv2'],
                        'exp_month' => $cc_format_mdl['exp_month'],
                        'exp_year'  => $cc_format_mdl['exp_year'],
                        'number'    => $cc_format_mdl['number'],
                        'f_name'    => $purchase_mdl->getAttribute('f_name'),
                        'l_name'    => $purchase_mdl->getAttribute('l_name'),
                    ];

                    // add time and qunatity into total
                    $pp_purchase_data['amountdetails']['subtotal'] = array_sum([
                        'subtotal' => trim(substr(
                            TimeAmountOptions::find('value')->where([
                                'id' => Yii::$app->request->post()['Purchase']['time_amount_id']
                            ])->one()->getAttribute('cost'), 1, -4
                        )),
                        'quantity' => trim(substr(
                            DeviceCountOptions::find('value')->where([
                                'id' => Yii::$app->request->post()['Purchase']['device_count_id']
                            ])->one()->getAttribute('cost'), 1, -4
                        )),
                    ]);


                    // usually place this at the beginning of the method but I dont want to init to obj if we dont need to.
                    $paypal_com = new paypal();

                    // todo switch to valid payment processing method - DJE : 2015-04-19
                    $_payment_result = $paypal_com->setDate($pp_purchase_data)->processCreditCardPayment();

                    // update the purchase TBO with the processors resoponse
                    $_message = null;
                    if ($_payment_result->getState() == 'approved') {
                        $_message = $_payment_result->getState();
                    } else {
                        $_message = $_payment_result->getFailedTransactions();
                    }
                    $purchase_mdl->setAttribute('return_message', $_message);
                    $purchase_mdl->setAttribute('return_code', http_response_code());
                    //$purchase_mdl->setAttribute('updated', date('Y-m-d H:i:s'));

                    // attempt payment processing
                    if ( $purchase_mdl->save() && $_payment_result->getState() == "approved") {

                        // Update the FreeRadius TBO with new purchase information
                        $_user_id = User::find()->where(
                            ['id' => $purchase_mdl->getAttribute('user_id')]
                        )->one()->getAttribute('id');
                        $_value    = TimeAmountOptions::find('value')->where(
                            ['id' => $purchase_mdl->getAttribute('time_amount_id')]
                        )->one()->getAttribute('value');

                        $_user_email = UserDetails::find()->where([
                            'user_id' => $_user_id
                        ])->one()->getAttribute('p_email');

                        if (
                            RadCheckController::actionCreateUserpass($_user_email) &&
                            RadCheckController::actionCreateExpiration($_user_email, $_value )
                        ) {

                            return $this->redirect(['view', 'id' => $purchase_mdl->id]);
                        } else {
                            
                            Yii::$app->getSession()->addFlash('error', 'Payment processed OK, however an error occured while processing the access request.');
                        }
                    } else {

                        Yii::$app->getSession()->addFlash('error', 'Payment processor returned an error.');
                    }
                }
            } else {
                Yii::$app->getSession()->addFlash('error', 'Billing data not valid.');
            }
        }



        return $this->render('create', [
            'cc_format_mdl'            => $cc_format_mdl,
            'country_mdl'              => Country::findAll(['deleted_at' => null]),
            'device_count_options_mdl' => DeviceCountOptions::findAll(['deleted' => null]), 
            'purchase_mdl'             => $purchase_mdl,
            'time_options_mdl'         => TimeAmountOptions::findAll(['deleted' => null]),
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
}
