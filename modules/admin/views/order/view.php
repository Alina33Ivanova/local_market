<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Заказы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'style' => 'background-color: #F37886; border: none; border-radius: 20px',
            'data' => [
                'confirm' => Yii::t('app', 'Вы хотите удалить заказ?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'last_name',
            'phone_number',
            'shop_id',
            'product_id',
            'take',
            'delivery_address',
            'street',
            'settlement',
            'house',
            'flat',
            'pay',
            'payment',
            'card_number',
            'cvv',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
