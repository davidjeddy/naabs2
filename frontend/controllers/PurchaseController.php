<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use common\components\paypal;
use common\models\CCFormat;
use common\models\DeviceCountOptions;
use common\models\TimeAmountOptions;

use frontend\models\Purchase;

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
     * Lists all Purchase models.
     * @return mixed
     */
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
     * Creates a new Purchase.
     * 
     * @return mixed
     */
    public function actionCreate()
    {
        $cc_format_mdl    = new CCFormat();
        $purchase_mdl     = new Purchase();

        $paypal_com    = new paypal();



        if (!empty(Yii::$app->request->post())) {

            // todo Can we use setAttributes() here? - DJE : 2015-04-16
            if ($cc_format_mdl->load(Yii::$app->request->post()) && $cc_format_mdl->save() ) {

                // for the sake of consistancty, empty success logic block
            } else {

                Yii::$app->getSession()->addFlash('error', 'Card data not valid.');
            }

            if ($purchase_mdl->load(Yii::$app->request->post())) {

                $purchase_mdl->setAttribute('user_id',   Yii::$app->user->getIdentity()->getAttribute('id') );
                $purchase_mdl->setAttribute('last_4',    substr($cc_format_mdl->number, -4) );
                $purchase_mdl->setAttribute('timestamp', date('U') );

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

                        return $this->redirect(['view', 'id' => $purchase_mdl->id]);
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
            'device_count_options_mdl' => new DeviceCountOptions(),
            'purchase_mdl'             => $purchase_mdl,
            'time_options_mdl'         => new TimeAmountOptions(),
        ]);
    }
}
