<?php use yii\widgets\ActiveForm; ?>
<?php use yii\helpers\Html; ?>

<div class="container">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sender_id')->hiddenInput(['value' => $sender_id])->label(false) ?>

    <?= $form->field($model, 'text')->textarea()->label('Ваш ответ') ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>