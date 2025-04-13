<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->registerMetaTag(['name' => 'keywords', 'content' => 'Заявка, подать заявку']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Магазин, название магазина, логин, описание']);

$this->title = 'Подать заявку';
$this->params['breadcrumbs'][] = $this->title;
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
    <style>
        body {
            background-image: url('../img/banner2.png');
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
        }

        .card {
            margin: 0;
            width: 100%;
            height: auto;
            padding: 30px;
            backdrop-filter: blur(20px);
            border: none;
            background-color: white;
            border-radius: 30px;
            box-shadow: 0 3px 9px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="container" style="position: fixed; top: 10px; right: 10px; width: 300px;">
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success" style="font-size: 12px;">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
</div>

<div class="site-login mt-5">
    <div class="container mb-5 border-1">
        <div class="card">
            <h2 style="text-align: center"><?= Html::encode($this->title) ?></h2>
            <div class="card-body">
                <div class="row">

                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'fieldConfig' => [
                            'template' => "{label}\n{input}\n{error}",
                            'inputOptions' => ['class' => 'col-lg-3 form-control'],
                            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                        ],
                    ]); ?>
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Логин'])->label(false) ?>
                    <?= $form->field($model, 'name_shop')->textInput(['autofocus' => true, 'placeholder' => 'Название магазина'])->label(false) ?>
                    <?= $form->field($model, 'description')->textInput(['autofocus' => true, 'placeholder' => 'Описание магазина'])->label(false) ?>
                    <?= $form->field($model, 'resume')->fileInput()->label(false) ?>
                    <div class="form-group">
                        <div>
                            <?= Html::submitButton('Отправить заявку', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>