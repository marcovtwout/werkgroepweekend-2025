<?php

namespace app\modules\admin\controllers;

use app\models\QuizQuestion;
use app\models\QuizResponse;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class QuizResponseController extends BaseController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => QuizResponse::find(),
            'sort' => [
                'defaultOrder' => [
                    'datetime' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionViewAllInitial()
    {
        $quizQuestions = QuizQuestion::findAllWithAnswersOrdered();
        $quizResponses = QuizResponse::find()
            ->orderBy(['datetime' => SORT_ASC])
            ->groupBy(['userId'])
            ->all();

        return $this->render('viewAllInitial', [
            'quizQuestions' => $quizQuestions,
            'quizResponses' => $quizResponses,
        ]);
    }

    public function actionViewAllSpongebob()
    {
        $quizQuestions = QuizQuestion::findAllWithAnswersOrdered();
        $quizResponses = QuizResponse::find()
            ->andWhere('datetime > "2026-01-09"')
            ->orderBy(['datetime' => SORT_DESC])
            ->groupBy(['userId'])
            ->all();

        return $this->render('viewAllSpongebob', [
            'quizQuestions' => $quizQuestions,
            'quizResponses' => $quizResponses,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = QuizResponse::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
