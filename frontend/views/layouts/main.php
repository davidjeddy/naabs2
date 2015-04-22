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

            $menuItems[] = ['label' => 'Contact', 'url' => ['/site/contact']];
            $menuItems[] = ['label' => 'Terms', 'url' => ['/site/tos']];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = ['label' => '|'];
                $menuItems[] = ['label' => 'Account', 'url' => ['/site/account']];
                $menuItems[] = ['label' => 'History', 'url' => ['/purchase/index']];
                $menuItems[] = ['label' => 'Purchase', 'url' => ['/purchase/create']];
                $menuItems[] = ['label' => '|'];    
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
