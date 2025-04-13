<?php

use app\models\Feedback;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FeedbackSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Отзывы');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="feedback-index">

        <h3><?= Html::encode($this->title) ?></h3>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'user_id',
                'feedback_text',
                'mark',
                //'created_at',
                //'updated_at',
                'is_active',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Feedback $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>

    </div>
</div>
