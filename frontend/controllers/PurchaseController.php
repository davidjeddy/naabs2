<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Purchase;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\components\paypal;
use common\models\CCFormat;
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
        $cc_format_mdl    = new CCFormat();
        $purchase_mdl     = new Purchase();

        $paypal_com    = new paypal();



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
                    $payment_data = [
                        'type'      => $cc_format_mdl->getAttribute('type'),
                        'cvv2'      => $cc_format_mdl->getAttribute('cvv2'),
                        'exp_month' => $cc_format_mdl->getAttribute('exp_month'),
                        'exp_year'  => $cc_format_mdl->getAttribute('exp_year'),
                        'f_name'    => $purchase_mdl->getAttribute('f_name'),
                        'l_name'    => $purchase_mdl->getAttribute('l_name'),
                        'number'    => $cc_format_mdl->getAttribute('number'),
                    ];



                    // attempt payment processing
                    if ($paypal_com->creditCardPayment($payment_data) ) {

                        // save the purchase request response
                        $purchase_mdl->setAttribute('return_code', 001);
                        $purchase_mdl->setAttribute('return_message', 'testing');
                        $purchase_mdl->setAttribute('updated', date('Y-m-d H:i:s'));

                        if ($purchase_mdl->save()) {
                            return $this->redirect(['view', 'id' => $purchase_mdl->id]);
                        }
                    } else {

                        Yii::$app->getSession()->addFlash('error', 'Could not process payment.');
                    }
                }
            } else {
                Yii::$app->getSession()->addFlash('error', 'Billing data not valid.');
            }
        }



        return $this->render('create', [
            'cc_format_mdl'            => $cc_format_mdl,
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
