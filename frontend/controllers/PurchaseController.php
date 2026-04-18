<?php

namespace frontend\controllers;

use Yii;
use common\models\CCFormat;
use frontend\models\Purchase;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use marciocamello\Paypal\Paypal;

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
            $this->processPaypal();
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

    /* Private methods */

    private function processPaypal()
    {

        $card = new marciocamello\Paypal;
        $card->setType('visa')
            ->setNumber('4111111111111111')
            ->setExpireMonth('06')
            ->setExpireYear('2018')
            ->setCvv2('782')
            ->setFirstName('Richie')
            ->setLastName('Richardson');

'asdf';exit;

        try {
            $card->create(Yii::$app->cm->getContext());
            // ...and for debugging purposes
            echo '<pre>';
            var_dump('Success scenario');
            echo $card;
        } catch (Excpetion $e) {
echo '<pre>';
print_r( $e );
echo '</pre>';
exit;
        }

        echo 'asdf';exit;
    }
}
