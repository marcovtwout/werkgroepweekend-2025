<?php

use app\models\QuizResponse;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Quiz responses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('View all initial', ['view-all-initial'], ['class' => 'btn btn-secondary']) ?>
    <?= Html::a('View all spongebob', ['view-all-spongebob'], ['class' => 'btn btn-secondary']) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'user.username',
            'datetime:datetime',
            'correctCount',
            'spongebobCount',
            [
                'class' => ActionColumn::className(),
                'template' => '{view}',
                'urlCreator' => function ($action, QuizResponse $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

</div>
