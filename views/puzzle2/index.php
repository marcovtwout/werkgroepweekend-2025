<?php

use app\models\forms\Puzzle2Form;
use app\models\QuizQuestion;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/** @var \yii\web\View $this */
/** @var Puzzle2Form $model */
/** @var QuizQuestion[] $questions */

$this->registerJs(<<<JS
    $('.question input:radio').change(function() {
        $(this).closest('.question').find('.next').prop('disabled', false);
    })
JS);
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

?>

<div class="row">
    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
    ]); ?>

    <div id="questions">
        <div id="question--1" class="question collapse show" data-bs-parent="#questions">
            <div class="progress">
                <div class="progress-bar bg-success" role="progressbar"></div>
            </div>

            <h4 class="mt-3 mb-4">Test</h4>

            <p>
                Puzzel 2 uitleg
            </p>

            <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#question-0">
                Start de test
            </button>
        </div>

        <?php foreach($questions as $questionIndex => $question): ?>
            <div id="question-<?= $questionIndex?>" class="question collapse" data-bs-parent="#questions">
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?= round(($questionIndex / count($questions)) * 100) ?>%"></div>
                </div>

                <h4 class="mt-3 mb-4"><?= Html::encode($question->getFullTitle()) ?></h4>

                <div class="answers">
                    <?php $fakeCorrectIndex = array_rand($question->quizAnswers) ?>
                    <?php foreach($question->quizAnswers as $answerIndex => $answer): ?>
                        <div class="answer mb-3">
                            <?php $inputId = sprintf('q%d-a%d', $questionIndex, $answerIndex); ?>
                            <input
                                type="radio"
                                class="btn-check"
                                name="<?= Html::getInputName($model, 'answers[' . $questionIndex . ']') ?>"
                                id="<?= $inputId ?>"
                                value="<?= $answerIndex ?>"
                                data-correct="<?= (int) $answerIndex === $fakeCorrectIndex; ?>" <?php // fake hint, har har.. ?>
                                autocomplete="off">
                            <label class="btn btn-secondary" for="<?= $inputId ?>">
                                <?= Html::encode($answer->text) ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button class="btn btn-outline-success next mt-5" type="button" data-bs-toggle="collapse" data-bs-target="#question-<?= $questionIndex+1 ?>" disabled>
                    Volgende vraag
                </button>
            </div>
        <?php endforeach; ?>

        <div id="question-<?= $questionIndex+1?>" class="question collapse" data-bs-parent="#questions">
            <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
            </div>

            <h4 class="mt-3 mb-4">Klaar..</h4>

            <?= Html::submitButton('Versturen', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
