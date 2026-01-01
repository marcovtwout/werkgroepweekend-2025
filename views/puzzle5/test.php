<?php

use app\models\forms\Puzzle2Form;
use app\models\QuizQuestion;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/** @var \yii\web\View $this */
/** @var Puzzle2Form $model */
/** @var QuizQuestion[] $questions */

$this->registerCss(<<<CSS
    .answers .btn-check + .btn {
        padding-left: 50px;
        background: none;
        border: none !important;
        background-repeat: no-repeat;
        background-image: url('../img/checkbox.png');
    }
    .answers .btn-check:checked + .btn {
        background-image: url('../img/checkbox-checked.png');
    }

CSS);

$this->title = 'Sponzig';

?>

<h3>Sponzig</h3>

<p>
    Inderdaad!
</p>
<p>
    In de test zaten 10 vragen verstopt die ook vanuit het perspectief van Spongebob ingevuld hadden kunnen worden.
</p>
<p>
    Je mag de test nu opnieuw maken. Lukt het om alle 10 de verborgen antwoorden correct te selecteren?
    Dan krijg je van alle spelers de testresultaten uit de eerste ronde te zien. En dan lukt het misschien
    om antwoord te geven op die ene vraag..
</p>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
]); ?>

<?php if ($model->hasErrors()): ?>
    <div class="alert alert-danger">
        <?= $model->getFirstError('answers') ?>
    </div>
<?php endif; ?>

<div id="questions">
    <?php foreach($questions as $questionIndex => $question): ?>
        <div class="question mt-5">
            <h4 class="mt-3 mb-4"><?= Html::encode($question->getFullTitle()) ?></h4>

            <div class="answers">
                <?php foreach($question->quizAnswers as $answerIndex => $answer): ?>
                    <div class="answer mb-3">
                        <?php $inputId = sprintf('q%d-a%d', $questionIndex, $answerIndex); ?>
                        <input
                            type="radio"
                            class="btn-check"
                            name="<?= Html::getInputName($model, 'answers[' . $questionIndex . ']') ?>"
                            id="<?= $inputId ?>"
                            value="<?= $answerIndex ?>"
                            <?= isset($model->answers[$questionIndex]) && $model->answers[$questionIndex] == $answerIndex ? 'checked' : '' ?>
                            autocomplete="off">
                        <label class="btn btn-secondary" for="<?= $inputId ?>">
                            <?= Html::encode($answer->text) ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="mt-5">
        <?= Html::submitButton('Verzenden', ['class' => 'btn btn-success']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
