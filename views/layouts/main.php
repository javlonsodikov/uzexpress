<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use common\components\Common;
use common\widgets\Alert;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap1">
    <?php
    NavBar::begin([
        'brandLabel' => 'UzExpress',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse /*navbar-fixed-top*/ ',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];

    if (Yii::$app->user->identity->role == \app\models\User::ROLE_ADMIN) {
        $menuItems[] = ['label' => 'Admin Panel', 'url' => ['/admin/categories']];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="row">
        <div class="col-lg-offset-1 col-lg-2">
            <?= Html::a("<span class=\"site-logo\"></span>", Yii::$app->homeUrl) ?>
        </div>
        <div class="col-lg-5">
            <div class="input-group">

                <input type="text" class="form-control" placeholder="Search for..." aria-label="...">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">All categories<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <? foreach (Common::getCategoryDropdownParents() as $categoryId => $categoryName) {
                            echo '<li><a href="#" rel="' . $categoryId . '">' . ($categoryName ? trim($categoryName) : 'All categories') . '</a></li>';
                        }
                        ?>
                    </ul>
                </span>
                <span class="input-group-btn">
                    <button class="btn btn-danger glyphicon glyphicon-search" type="button"></button>
                </span>

            </div>
        </div>
        <div class="col-lg-4">
            <span class="glyphicon glyphicon-shopping-cart"></span>
            <?= Html::a('Cart', ['cart/index']) ?>
            <span class="badge"
                  id="incart_count"><?= Yii::$app->user->identity->incart_count ?></span>&nbsp;&nbsp;
            <span class="glyphicon glyphicon-heart"></span>

            <?= Html::a('Wishes', ['wishes/index']) ?>
            <span class="badge"
                  id="favorites_count"><?= Yii::$app->user->identity->favorites_count ?></span>&nbsp;&nbsp;

            <?php
            if (Yii::$app->user->isGuest) {
                echo '<span class="glyphicon glyphicon-log-in"></span> ';
                echo Html::a('Sign in', ['site/login']);
            } else {
                echo '<span class="glyphicon glyphicon-log-out"></span>';
                echo Html::beginForm(['/site/logout'], 'post', ['id' => 'logoutform', 'style' => 'display:inline'])
                    . Html::a('Sign out (' . Yii::$app->user->identity->username . ')',
                        null,
                        [
                            'href' => 'javascript://',
                            'onclick' => '$("#logoutform").submit()'
                        ])
                    . Html::endForm();
            }
            ?>
        </div>
    </div>
</div>

<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Uz express <?= date('Y') ?></p>

        <p class="pull-right"></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
