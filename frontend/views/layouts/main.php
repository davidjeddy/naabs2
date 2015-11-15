<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

// todo clean this up - DJE - 2015-11-15
$displayAmount = NULL;
if (\Yii::$app->user->getIdentity()) {
    // get account time expiration
    $expiration = new DateTime(
        \davidjeddy\freeradius\models\radcheck::getExpiration(\Yii::$app->user->getIdentity()->username)
    );

    $dateTime = new DateTime();
    $interval = $dateTime->diff( $expiration );

    $dayData  = $interval->format('%a');
    $hourData = $interval->format('%h');

    $displayAmount = 'EXPIRED';
    if ($dayData) {
        $displayAmount = 'in '.$dayData.' day'.($dayData < 1 ?: 's').' on '.$expiration->format('Y-M-d'); 
    } else {
        $displayAmount = 'in '.$hourData.' hour'.($hourData < 1 ?: 's');
    }
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Naabs 2',
                'brandUrl'   => Yii::$app->homeUrl,
                'options'    => ['class' => 'navbar-inverse navbar-fixed-top']
            ]);

            $menuItems[] = ['label' => 'Contact',   'url' => ['/site/contact']];
            $menuItems[] = ['label' => 'Terms',     'url' => ['/site/tos']];

            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Signup',                'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Account Management',    'url' => ['/site/login']];
            } else {
                $menuItems[] = ['label' => 'Purchase',          'url' => ['/purchase/create']];
                $menuItems[] = ['label' => 'Account Details',   'url' => ['/site/account']];
                $menuItems[] = [
                    'label'       => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'linkOptions' => ['data-method' => 'post'],
                    'url'         => ['/site/logout'],
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <?php
            if ($displayAmount) {
                navbar::begin([
                    'options'    => [
                        'class' => 'navbar-inverse navbar-fixed-top',
                        'style' => 'top:50px;'
                    ]
                ]);

                echo Nav::widget([
                    'options'   => ['class' => 'navbar-nav navbar-right'],
                    'items'     => [
                        [
                            'label' => 'Expires '.$displayAmount,
                            'url'   => ['/purchase/create'],
                        ]
                    ]
                ]);

                NavBar::end();
            }
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; Naabs 2 <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
