<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use common\components\paypal;
use common\models\CCFormat;

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
        $purchase_mdl  = new Purchase();
        $cc_format_mdl = new CCFormat();

        if ($purchase_mdl->load(Yii::$app->request->post()) && $cc_format_mdl->save()) {

            // todo This iteration is Paypal only. - DJE : 2015-04-11
            // Process the CC transaction
            $paypal = new paypal();
            $test_data = [
                'cvv2'      => $purchase_mdl->getAttribute('number'),
                'exp_month' => $purchase_mdl->getAttribute('number'),
                'exp_year'  => $purchase_mdl->getAttribute('number'),
                'f_name'    => $purchase_mdl->getAttribute('number'),
                'l_name'    => $purchase_mdl->getAttribute('number'),
                'number'    => $purchase_mdl->getAttribute('number'),
            ];
            
echo '<pre>';
print_r( $paypal->creditCardPayment()->getApprovalLink( $test_data ); );
echo '</pre>';
exit;
        }

        // process purchase request if the CC transaction completed
        if ($purchase_mdl->load(Yii::$app->request->post()) && $purchase_mdl->save()) {

            return $this->redirect(['view', 'id' => $purchase_mdl->id]);
        } elseif ($purchase_mdl->errors) {

            Yii::$app->getSession()->addFlash('error', 'Unable to complete purchase.');
        }

        return $this->render('create', [
            'cc_format_mdl' => $cc_format_mdl,
            'purchase_mdl'  => $purchase_mdl,
        ]);
    }

/*
setType($_param_data['type'])
    ->setNumber($_param_data['number'])
    ->setExpireMonth($_param_data['exp_month'])
    ->setExpireYear($_param_data['exp_year'])
    ->setCvv2($_param_data['cvv2'])
    ->setFirstName($_param_data['f_name'])
    ->setLastName($_param_data['l_name']);
*/
}
