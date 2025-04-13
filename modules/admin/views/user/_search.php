<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="container">
    <div class="user-search">

        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>

        <?= $form->field($model, 'id') ?>

        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'first_name') ?>

        <?= $form->field($model, 'last_name') ?>

        <?= $form->field($model, 'patronymic') ?>

        <?php echo $form->field($model, 'password') ?>

        <?php echo $form->field($model, 'phone_number') ?>

        <?php echo $form->field($model, 'email') ?>

        <?php echo $form->field($model, 'authKey') ?>

        <?php echo $form->field($model, 'created_at') ?>

        <?php echo $form->field($model, 'is_admin') ?>

        <?php echo $form->field($model, 'is_seller') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Поиск'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('app', 'Сброс'), ['class' => 'btn btn-outline-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
