<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */

/** @var Exception $exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="container">
    <div class="site-error">

        <h2><?= Html::encode($this->title) ?></h2>

        <div class="alert alert-danger">
            <?= nl2br(Html::encode($message)) ?>
        </div>

        <p>
            Вышеуказанная ошибка произошла во время обработки веб-сервером вашего запроса.
        </p>
        <p>
            Пожалуйста, свяжитесь с нами, если вы считаете, что это ошибка сервера.
        </p>

    </div>
</div>