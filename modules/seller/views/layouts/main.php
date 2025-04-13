<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/img/logo2.png')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<div class="container">
    <header id="header" class="text-center">
        <?php
        NavBar::begin([
            'brandLabel' => '<img src="/img/logo.png" class="img-fluid" alt="Логотип" style="width: 100px; height: 45px; margin-left: 10px">',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-expand-md',
            ]
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => [
                ['label' => 'Главная', 'url' => ['/site/index']],
                ['label' => 'Каталог', 'url' => ['/site/catalog']],
                ['label' => 'Сделать заказ', 'url' => ['/site/order']],
                ['label' => 'Чат', 'url' => ['/site/chat'], 'visible' => !Yii::$app->user->isGuest],
                ['label' => 'Заявка', 'url' => ['/site/application'], 'visible' => !Yii::$app->user->isGuest && !Yii::$app->user->identity->is_seller],
                ['label' => 'Мой профиль', 'url' => ['/seller/default/index'], 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->is_seller],
                ['label' => 'Административная панель', 'url' => ['/admin/default/index'], 'visible' => !Yii::$app->user->isGuest &&  Yii::$app->user->identity->is_admin],
                Yii::$app->user->isGuest
                    ? ['label' => 'Авторизация', 'url' => ['/site/login']]
                    : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Выйти',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
            ]
        ]);
        NavBar::end();
        ?>
    </header>
</div>

<main id="main" role="main">
    <?= $content ?>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
