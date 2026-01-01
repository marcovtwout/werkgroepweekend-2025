<?php

/* @var $this \yii\web\View */
/* @var $quizQuestions \app\models\QuizQuestion[] */
/* @var $quizResponses \app\models\QuizResponse[] */

use yii\bootstrap5\Html;

$this->title = 'All initial results';
\yii\web\YiiAsset::register($this);

$this->registerCss(<<<CSS
    main .container {
        max-width: none !important;
        width: 100% !important;
        padding-right: 0 !important;
        padding-left: 0 !important;
        margin-right: auto !important;
        margin-left: auto !important;
    }
CSS);

?>

<h1><?= Html::encode($this->title) ?></h1>

<table class="table table-bordered table-striped table-sm">
    <thead>
    <tr>
        <th>
            Speler
        </th>
        <?php foreach($quizResponses as $quizResponse): ?>
            <th>
                <?= Html::encode($quizResponse->user->username) ?>
            </th>
        <?php endforeach; ?>
    </tr>
    <tr>
        <th>
            Totaalscore
        </th>
        <?php foreach($quizResponses as $quizResponse): ?>
            <th>
                <?= $quizResponse->getCorrectCount() ?>
            </th>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody class="table-group-divider">
    <?php foreach($quizQuestions as $questionIndex => $quizQuestion): ?>
        <tr>
            <th>
                Vraag <?= Html::encode($quizQuestion->nr) ?>
            </th>
            <?php foreach($quizResponses as $quizResponse): ?>
                <?php $givenAnswer = $quizResponse->quizResponseAnswers[$questionIndex]->quizAnswer; ?>
                <td class="bg-<?= $givenAnswer->isCorrect ? 'success' : 'danger' ?>">
                    <?= Html::encode($givenAnswer->text) ?>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
