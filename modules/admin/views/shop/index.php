<?php

use app\models\Shop;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ShopSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Магазины');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="shop-index">

        <h3><?= Html::encode($this->title) ?></h3>

        <p>
            <?= Html::a(Yii::t('app', 'Добавить магазин'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'user_id',
                'shop_name',
                'description:ntext',
                'shop_image',
                'location',
                //'created_at',
                //'updated_at',
                'is_active',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Shop $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    </div>
</div>
