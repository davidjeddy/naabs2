<?php
/* @var $this yii\web\View */

use dosamigos\highcharts\HighCharts;

use backend\models\Purchase;

use common\components\DateAndTimes;

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
                     'text' => '# of Sales'
                     ],
                'xAxis' => [
                    'categories' => array_values(DateAndTimes::getMonthAs('M')),
                ],
                'yAxis' => [
                    'title' => [
                        'text' => 'Amount'
                    ]
                ],
                'series' => [
                    ['name' => 'Last Year',     'data' => array_values(Purchase::getSalePerMonth((integer)date('Y')-1))],
                    ['name' => 'Current Year',  'data' => array_values(Purchase::getSalePerMonth((integer)date('Y')))],
                    ['name' => 'Demo Year',     'data' => [4,7,5,3,4,7,9,9,6,3,2,4]],
                ]
            ]
        ]);
        ?>
        </div>

        <div class="row">
        <?= HighCharts::widget([
            'clientOptions' => [
                'chart' => [
                        'type' => 'line'
                ],
                'title' => [
                     'text' => 'Dollar of Sales'
                     ],
                'xAxis' => [
                    'categories' => array_values(DateAndTimes::getMonthAs('F')),
                ],
                'yAxis' => [
                    'title' => [
                        'text' => 'Amount'
                    ]
                ],
                'series' => [
                    ['name' => 'Last Year',     'data' => array_values(Purchase::getMoneyPerMonth((integer)date('Y')-1))],
                    ['name' => 'Current Year',  'data' => array_values(Purchase::getMoneyPerMonth((integer)date('Y')))],
                ]
            ]
        ]);
        ?>
        </div>

    </div>
</div>
