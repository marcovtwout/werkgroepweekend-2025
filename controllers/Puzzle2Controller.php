<?php

namespace app\controllers;

use app\models\forms\Puzzle2Form;
use app\models\Log;
use app\models\QuizQuestion;
use app\models\User;
use Yii;
use yii\base\Exception;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;

class Puzzle2Controller extends BaseController
{
    public function actionIndex()
    {
        $user = $this->getUser();
        if ($user->currentPuzzle === User::PUZZLE_2_TEST) {
            return $this->redirect(['test']);
        } elseif ($user->currentPuzzle === User::PUZZLE_2_RESULT) {
            return $this->redirect(['result']);
        } elseif ($user->currentPuzzle === User::PUZZLE_2_ELIMINATION) {
            return $this->redirect(['elimination']);
        } else {
            return $this->goHome();
        }
    }

    public function actionTest()
    {
        $user = $this->getUser();
        if ($user->currentPuzzle !== User::PUZZLE_2_TEST) {
            return $this->goBack();
        }

        $questions = QuizQuestion::findAllWithAnswersOrdered();
        $model = new Puzzle2Form();
        $model->questions = $questions;
        if ($model->load(Yii::$app->request->post())) {
            Log::addEntry($user, 'puzzle2', $model->answers);
            if ($model->validate()) {
                $model->createResponse($user);
                $user->currentPuzzle = User::PUZZLE_2_RESULT;
                $user->save();

                return $this->refresh();
            } else {
                throw new HttpException(400, 'Ongeldige input.');
            }
        }

        return $this->render('index', [
            'model' => $model,
            'questions' => $questions,
        ]);
    }

    public function actionResult()
    {
        $user = $this->getUser();
        if ($user->currentPuzzle !== User::PUZZLE_2_RESULT) {
            return $this->goHome();
        }

        return $this->render('result', [
            'pdfTitle' => $user->puzzle2Pdf,
        ]);
    }

    public function actionElimination()
    {
        $user = $this->getUser();
        if ($user->currentPuzzle !== User::PUZZLE_2_ELIMINATION) {
            return $this->goHome();
        }

        if (!empty($_POST)) {
            $user->currentPuzzle = User::PUZZLE_3;
            $user->save();

            $this->redirect(['index']);
        }

        return $this->render('elimination');
    }

    public function actionDownloadPdf()
    {
        $user = $this->getUser();
        if ($user->currentPuzzle < User::PUZZLE_2_RESULT) {
            throw new ForbiddenHttpException('Dacht het niet.');
        }

        $filename = Yii::getAlias('@app') . '/uploads/pdf/' . $user->puzzle2Pdf;
        if (empty($user->puzzle2Pdf) || !file_exists($filename)) {
            throw new Exception('Upload missing.');
        }

        Log::addEntry($user, 'puzzle2-download');
        $this->response->sendFile($filename);
    }
}
