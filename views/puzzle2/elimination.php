<?php

use yii\bootstrap5\Html;

$this->title = 'Eliminatie';

?>

<h2>Eliminatie</h2>

<div id="collapseParent">
    <audio controls autoplay src="<?= Yii::$app->urlManager->baseUrl ?>/audio/widm-intro.m4a"></audio>

    <div class="collapse show">
        <p>Start het spannende muziekje..</p>

        <p>Houd de handen van je medekandidaten goed vast..</p>

        <p>En check of je de eliminatie hebt overleeft:</p>
        <button class="btn btn-success next mt-2" type="button" data-bs-toggle="collapse" data-bs-target="#result">
            Spannend!
        </button>
    </div>

    <div id="result" class="collapse" data-bs-parent="#collapseParent">
        <div class="text-center mt-2">
            <img src="<?= Yii::$app->urlManager->baseUrl ?>/img/groenscherm.webp" width="100%" /><br>
        </div>

        <h4 class="mt-2">Phew, groen scherm!</h4>

        <p>Geef elkaar een dikke knuffel en probeer oprecht opgelucht te kijken.</p>

        <?= Html::beginForm() ?>

        <?= Html::submitButton('Ga verder', ['class' => 'btn btn-success']) ?>

        <?= Html::endForm() ?>
    </div>
</div>
