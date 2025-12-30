<?php

use yii\bootstrap5\Html;

/** @var \yii\web\View $this */
/** @var string $pdfTitle */

?>

<div class="row" id="collapseParent">
    <div class="text-center">
        <audio controls autoplay src="<?= Yii::$app->urlManager->baseUrl ?>/audio/widm-intro.m4a"></audio>
    </div>

    <div class="collapse show">
        <p>Start het spannende muziekje..</p>

        <p>En check of je de eliminatie hebt overleeft:</p>
        <button class="btn btn-success next mt-2" type="button" data-bs-toggle="collapse" data-bs-target="#result">
            Spannend!
        </button>
    </div>

    <div id="result" class="collapse" data-bs-parent="#collapseParent">
        <div class="text-center mt-2">
            <img src="<?= Yii::$app->urlManager->baseUrl ?>/img/groenscherm.webp" width="500" /><br>
            <h4 class="mt-2">Phew, groen scherm!</h4>
        </div>

        <hr>

        <p>De volgende opdracht wordt pas vrijgegeven als iedereen de test gemaakt heeft. Maar om je alvast voor te bereiden op de volgende ronde krijg je onderstaande -persoonlijke- informatie tot je beschikking:</p>
        <ul>
            <li>Download: <?= Html::a(Html::encode($pdfTitle), ['puzzle2/download-pdf']) ?></li>
        </ul>
    </div>
</div>
