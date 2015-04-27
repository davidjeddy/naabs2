<?php
/* @var $this yii\web\View */

use dosamigos\highcharts\HighCharts;

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
                    ['name' => 'Last Year',     'data' => [1, 0, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0]],
                    ['name' => 'Current Year',  'data' => [5, 7, 3]]
                ]
            ]
        ]);
        ?>
        </div>

    </div>
</div>
