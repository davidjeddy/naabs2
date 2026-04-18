<?php
/* @var $this yii\web\View */

use dosamigos\highcharts\HighCharts;

use backend\models\Purchase;

$this->title = 'Naabs 2 Administrative Panel';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>
        <p class="lead">Administrative backend panel.</p>
    </div>

    <div class="body-content">

        <div class="row">
        <?= HighCharts::widget([
            'clientOptions' => [
                'chart' => [
                        'type' => 'line'
                ],
                'title' => [
                     'text' => 'Sales Per Month'
                     ],
                'xAxis' => [
                    'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                ],
                'yAxis' => [
                    'title' => [
                        'text' => 'Amount'
                    ]
                ],
                'series' => [
                    ['name' => 'Last Year',     'data' => array_values(Purchase::getSaleByYear((integer)date('Y')-1))],
                    ['name' => 'Current Year',  'data' => array_values(Purchase::getSaleByYear((integer)date('Y')))],
                    ['name' => 'Demo Year',     'data' => [1,5,2,2,5,8,9,6,4,2,4,6]],
                ]
            ]
        ]);
        ?>
        </div>

    </div>
</div>
