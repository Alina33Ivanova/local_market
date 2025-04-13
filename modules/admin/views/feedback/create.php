<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Feedback $model */

$this->title = Yii::t('app', 'Добавить отзыв');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Отзывы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="feedback-create">

        <h3><?= Html::encode($this->title) ?></h3>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
