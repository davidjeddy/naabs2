<?php

namespace frontend\controllers;

use Yii;
use common\models\CCFormat;
use frontend\models\Purchase;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
     * Creates a new Purchase model.
     * 
     * @return mixed
     */
    public function actionCreate()
    {
        $purchase_mdl  = new Purchase();
        $cc_format_mdl = new CCFormat();


        // if CC data provided, process CC data
        if ($cc_format_mdl->load(Yii::$app->request->post('CCFormat')) && $cc_format_mdl->save()) {

echo '<pre>';
print_r( Yii::$app->request->post('CCFormat') );
echo '</pre>';
exit;

            $purchase_mdl->setAttribute('last_4', substr(Yii::$app->request->post('CCFormat')['number'], -4));
            $purchase_mdl->setAttribute('year',   Yii::$app->request->post('CCFormat')['exp_year']);
        }



        // process CC request
        if ($purchase_mdl->load(Yii::$app->request->post('Purchase')) && $cc_format_mdl->save()) {

            return $this->redirect(['view', 'id' => $purchase_mdl->id]);
        } else {

            return $this->render('create', [
                'cc_format_mdl' => $cc_format_mdl,
                'purchase_mdl'  => $purchase_mdl,
            ]);
        }
    }
}
