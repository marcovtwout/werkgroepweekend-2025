<?php

use yii\bootstrap5\Html;

/** @var \yii\web\View $this */
/** @var string $pdfTitle */

$this->title = 'Test';

?>

<h2>Test afgesloten</h2>

<p>Als iedereen de test gemaakt heeft gaan we over tot eliminatie.</p>
<p>Om je alvast voor te bereiden op de volgende ronde krijg je onderstaande (persoonlijke) informatie tot je beschikking. Bewaar deze goed.</p>

<?= Html::a(sprintf('Download: %s', $pdfTitle), ['puzzle2/download-pdf'], ['class' => 'btn btn-secondary']) ?></>
