<?php

use app\models\forms\Puzzle1Form;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/** @var Puzzle1Form $model */

$this->title = 'Welkom';

?>

<h3>Welkom</h3>

<p>
    Beste kandidaten,
</p>
<p>
    Welkom bij Wie Is De Werkgroepmol seizoen 2025-2026. Er komt weer een weekend aan waar je zeker
    bij wilt zijn, maar voordat het zover is moeten jullie samen op zoek naar de locatie.
</p>
<p>
    Huisregels:
</p>
<ul>
    <li>Je begint zelfstandig totdat je op een zeker punt samen komt met de andere kandidaten. Maar
        leden van je huishouden mogen wel meehelpen (vinden ze misschien zelfs leuk).</li>
    <li>Deze puzzels zijn met liefde gemaakt, zonder gebruik van AI of dergelijke poespas. Dus die
        heb jij ook niet nodig. Gebruik voorlopig ook geen internet/zoekmachine.</li>
    <li>Je kunt niet terug door de puzzels, dus schrijf waardevolle informatie op in je molboekje.</li>
</ul>
<p>
    Met vriendelijke groet, De Spelleider
</p>

<div class="card">
    <div class="card-body">
        <p>
            We beginnen met een vraag:
        </p>
        <p>
            <strong>Misschien wel het meest gelezen stripboek van Nederland, maar niet van Nederlandse oorsprong. Welk stripboek is het?</strong>
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
