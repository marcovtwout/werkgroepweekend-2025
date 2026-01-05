<?php

use app\models\forms\Puzzle3Form;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/** @var Puzzle3Form $model */
/** @var string $puzzle3Question */

$this->title = 'Leesvoer';

?>

<h3>Leesvoer</h3>

<p>
    Vanaf hier moet je samenwerken met de andere kandidaten om verder te komen. Jullie willen toch allemaal de bestemming bereiken?
</p>

<div class="card">
    <div class="card-body">
        <p>
            <strong><?= Html::encode($puzzle3Question) ?></strong>
        </p>

        <div class="row mt-5">
            <div class="col-sm-6">
                <?php $form = ActiveForm::begin([
                        'enableClientValidation' => false,
                ]); ?>

                <?= $form->field($model, 'answer')->textInput(['autofocus' => true])->label('Antwoord') ?>

                <?= Html::submitButton('Verzenden', ['class' => 'btn btn-success']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
