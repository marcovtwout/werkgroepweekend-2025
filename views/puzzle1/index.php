<?php

use yii\base\DynamicModel;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/** @var DynamicModel $model */

?>

<p>
    Welkomstwoord<br>
    De eerste puzzel moet je proberen om zelfstandig of binnen je huishouden op te lossen.<br>
    Deze uitdaging is met de hand en met liefde voor jullie gemaakt, zonder gebruik te maken van AI. Dus die heb je ook niet nodig.<br>
    Hulpmiddelen: huishouden of direct familie mag helpen. géén internet/zoekmachine/AI gebruiken<br>
</p>

<div class="row mt-5">
    <div class="col-sm-6 offset-sm-3">
        <?php $form = ActiveForm::begin([
            'enableClientValidation' => false,
        ]); ?>

        <?= $form->field($model, 'answer')->textInput(['autofocus' => true])->label('Antwoord') ?>

        <div class="form-group">
            <div>
                <?= Html::submitButton('Inloggen', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
