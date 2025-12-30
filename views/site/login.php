<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Inloggen';

?>

<div class="text-center">
    <img src="<?= Yii::$app->urlManager->baseUrl ?>/img/logo.jpg" width="500" /><br>
    <audio controls autoplay src="<?= Yii::$app->urlManager->baseUrl ?>/audio/widm-intro.m4a"></audio>
</div>

<div class="row mt-5">
    <div class="col-sm-6 offset-sm-3">
        <?php $form = ActiveForm::begin([
            'enableClientValidation' => false,
        ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <div>
                <?= Html::submitButton('Inloggen', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
