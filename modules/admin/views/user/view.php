<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('Bekijk logs', ['log/index', 'userId' => $model->id], ['class' => 'btn btn-secondary']) ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'currentPuzzle',
            'isAdmin:boolean',
            'puzzle2Pdf',
            'puzzle3Result',
        ],
    ]) ?>

</div>
