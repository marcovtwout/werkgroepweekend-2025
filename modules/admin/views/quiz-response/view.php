<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\QuizResponse $model */

$this->title = 'Quiz response for ' . $model->user->username;
$this->params['breadcrumbs'][] = ['label' => 'Quiz responses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="quiz-response-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user.username',
            'datetime',
            'correctCount',
        ],
    ]) ?>

    <h3>Answers</h3>

    <ul class="list-group">
        <?php foreach($model->quizResponseAnswers as $responseAnswer): ?>
            <li class="list-group-item list-group-item-<?= $responseAnswer->isCorrect ? 'success' : 'danger' ?>">
                <strong><?= Html::encode($responseAnswer->quizQuestion->getFullTitle()) ?></strong><br>
                Gegeven antwoord: <?= Html::encode($responseAnswer->quizAnswer->text) ?> <?= ($responseAnswer->isCorrect ? '(Correct)' : '(Fout)') ?>
            </li>
        <?php endforeach; ?>
    </ul>

</div>
