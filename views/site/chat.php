<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Чат';
$form = ActiveForm::begin();

$this->registerMetaTag(['name' => 'keywords', 'content' => 'Чат, чат с продавцом']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Чат, продавец, сообщение, введите сообщение']);
?>

<div class="container" style="position: fixed; top: 10px; right: 10px; width: 300px;">
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success" style="font-size: 12px;">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
</div>

<div class="container mb-5 border-1">
    <div class="site-login mt-5 d-flex flex-wrap justify-content-between">
        <div class="card flex-fill me-2" style="min-width: 300px;">
            <div class="card-header" style="text-align: center">Чат с продавцом</div>
            <div class="card-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'fieldConfig' => [
                        'template' => "{label}\n{input}\n{error}",
                        'inputOptions' => ['class' => 'form-control'],
                        'errorOptions' => ['class' => 'invalid-feedback'],
                    ],
                ]); ?>
                <div class="form-group">
                    <?= $form->field($model, 'recipient_id')->dropDownList($userList, ['prompt' => 'Выберите продавца'])->label(false) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model, 'text')->textarea(['placeholder' => 'Введите сообщение...', 'style' => 'height: 38px'])->label(false) ?>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Отправить <img src="/img/send.png" width="10px" height="10px" alt="Иконка отправить сообщение">', ['class' => 'btn btn-success', 'style' => 'width: auto;']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <div class="messages flex-fill"
             style="height: 300px; overflow-y: auto; border: none; padding: 10px; min-width: 300px;">
            <h2 style="text-align: center;">Ответы продавцов</h2>
            <?php foreach ($answer as $item): ?>
                <div class="answer">
                    <div class="mssg d-flex align-items-start flex-wrap flex-column">
                        <?php if ($item->user): ?>
                            <p class="card-text">
                                <?= htmlspecialchars(($item->user->first_name ?? '') . ' ' . ($item->user->last_name ?? ''), ENT_QUOTES, 'UTF-8') ?>
                            </p>
                        <?php endif; ?>
                        <?= Html::encode($item->text) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<style>
    body {
        background-image: url('../img/banner2.png');
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        margin: 0;
    }

    .site-login {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;

    }

    .card, .messages {
        flex: 1;
        margin-right: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: white;
        border-radius: 25px;
        color: #0F2743;
        font-size: 25px;
        font-family: "Montserrat-Medium";
    }

    .card-header {
        background-color: white;
    }

    .card-header:first-child {
        border-radius: 25px 25px 0px 0px;
    }

    .full-width-textarea {
        width: 100%;
        height: 38px;
        resize: none;
    }

    .messages {
        height: 300px;
        overflow-y: auto;
        border: 1px solid #ccc;
        padding: 10px;
        color: #0F2743;
    }

    .messages h2 {
        font-size: 25px;
        font-family: "Montserrat-Medium";
        text-align: center;
        color: #0F2743;
    }

    .mssg {
        background-color: #c7ebff;
        border-radius: 15px;
        height: auto;
        width: 200px;
        margin-bottom: 10px;
        padding: 5px;
        font-size: 15px;
        font-family: "Montserrat-Light";
        text-align: center;
        color: #0F2743;
    }

    @media (max-width: 768px) {
        .site-login {
            flex-direction: column;
        }

        .card, .messages {
            margin-right: 0;
            margin-bottom: 20px;
        }
    }
</style>





