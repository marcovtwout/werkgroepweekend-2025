<?php

use yii\bootstrap5\Html;

/** @var \yii\web\View $this */
/** @var string $previousResult */

?>

<div class="row">
    <p>Resultaat: <?= Html::encode($previousResult) ?></p>

    <p>Download: <?= Html::a('download', ['puzzle2/download-pdf']) ?></p>
</div>
