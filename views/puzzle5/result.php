<?php

/* @var $this \yii\web\View */
/* @var $quizQuestions \app\models\QuizQuestion[] */
/* @var $quizResponse \app\models\QuizResponse */

use yii\bootstrap5\Html;

$this->title = 'Deductie';
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

<h3>Deductie</h3>

<p>
    Gelukt!
</p>
<p>
    Hier zie je jouw testresultaten uit de eerste ronde. En dan lukt het nu misschien
    om antwoord te geven op die ene vraag..
</p>

<table class="table table-bordered table-striped table-sm">
    <thead>
        <tr>
            <th>
                Speler
            </th>
            <th>
                <?= Html::encode($quizResponse->user->username) ?>
            </th>
        </tr>
        <tr>
            <th>
                Totaalscore
            </th>
            <th>
                <?= $quizResponse->getCorrectCount() ?>
            </th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php foreach($quizQuestions as $questionIndex => $quizQuestion): ?>
            <tr>
                <th>
                    Vraag <?= Html::encode($quizQuestion->nr) ?>
                </th>
                <?php $givenAnswer = $quizResponse->quizResponseAnswers[$questionIndex]->quizAnswer; ?>
                <td>
                    <?= Html::encode($givenAnswer->text) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
