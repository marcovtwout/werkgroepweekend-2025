<?php

use app\models\forms\Puzzle4Form;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/** @var string $puzzle3Result */
/** @var Puzzle4Form $model */
/** @var bool $enablePuzzle5 */

$this->title = 'Op volgorde';

?>

<h3>Op volgorde</h3>

<p>
    Goed bezig! Hier is jouw volgende puzzelstukje:
</p>

<div class="card">
    <div class="card-body"><strong><?= Html::encode($puzzle3Result) ?></strong></div>
</div>

<p class="mt-3">
    Vanaf hier zijn alle hulpmiddelen toegestaan. Houd je brievenbus in de gaten voor de laatste uitdaging. Veel succes!
</p>

<hr>

<?php if (!$enablePuzzle5): ?>
    <p>
        Wanneer jullie alle puzzelstukjes gevonden hebben unlocked hieronder een bonusvraag.
    </p>
<?php else: ?>
    <h4 class="mt-4">Bonusvraag</h4>

    <div class="card">
        <div class="card-body">
            <p>
                <strong>Wat was het verborgen thema in de antwoorden op de test die jullie gemaakt hebben?</strong>
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
<?php endif; ?>
