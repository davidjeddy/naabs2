<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-details-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php // echo Html::a('Create User Details', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'user_id',
            'f_name',
            'l_name',
            'p_phone',
            's_phone',
            'p_email',
            's_email',
            's_question',
            's_answer',
            // 'role',
            // todo get this to work via model relations - DJE - 2015-11-20
            [
                'label' => 'role',
                'value' => function ($model) {
                    return \backend\models\Role::find()->andWhere(['value' => $model->role])->one()->name;
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
            //'deleted_at:datetime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
