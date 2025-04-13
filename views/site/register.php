<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;

$this->registerMetaTag(['name' => 'keywords', 'content' => 'Регистрация']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Зарегистрироваться']);
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
            box-shadow: 0 3px 9px rgba(0, 70, 43, 0.1);
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

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
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'last_name')->textInput(['autofocus' => true, 'placeholder' => 'Фамилия'])->label(false) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'first_name')->textInput(['autofocus' => true, 'placeholder' => 'Имя'])->label(false) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'patronymic')->textInput(['autofocus' => true, 'placeholder' => 'Отчество'])->label(false) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Электронная почта'])->label(false) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'phone_number')->widget(\yii\widgets\MaskedInput::class, [
                                'mask' => '+7 (999)-999-99-99',
                            ])->label(false) ?>
                        </div>
                    </div>
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Логин'])->label(false) ?>
                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль'])->label(false) ?>
                    <?= $form->field($model, 'password_repeat')->passwordInput(['placeholder' => 'Повтор пароля'])->label(false) ?>
                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    ]) ?>
                    <div class="form-group">
                        <div>
                            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-success', 'name' => 'login-button', 'style' => 'width: auto']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


