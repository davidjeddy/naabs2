<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\UserDetails;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserDetailsController implements the CRUD actions for UserDetails model.
 */
class UserDetailsController extends Controller
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
     * Lists all UserDetails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => UserDetails::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserDetails model.
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
     * Creates a new UserDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserDetails();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserDetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $type = null)
    {
        $userDetails = $this->findModel($id);
        $userAccount = User::findOne(['id', $userDetails->user_id]);

        if ($userDetails->load(Yii::$app->request->post()) && $userDetails->save()) {
            return $this->redirect(['view', 'id' => $userDetails->id]);
        } else {
            return $this->render('update', [
                'userDetails' => $userDetails,
            ]);
        }

        return false;
    }

    /**
     * On UserAccoutn update save changes and return to VW
     *
     * @todo  Maybe userAccountCNTL? - DJE : 2015-03-02
     * @param integer $id
     * @return mixed
     */
    public function actionAccountUpdate($id)
    {
        $userAccount = User::findOne(['id', $id]);

        if ($userAccount) {
            $userAccount->setAttributes();

            if ($userAccount->update('')) {
                $this->actionUpdate($id);
            }
        }


        return false;
    }

    /**
     * Deletes an existing UserDetails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserDetails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
