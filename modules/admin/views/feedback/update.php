<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Feedback $model */

$this->title = Yii::t('app', 'Редактировать отзыв', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Отзывы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактировать');
?>

<div class="container">
    <div class="feedback-update">

        <h3><?= Html::encode($this->title) ?></h3>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
