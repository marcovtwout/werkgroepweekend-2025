<?php

namespace app\controllers;

use app\models\forms\Puzzle2Form;
use app\models\Log;
use app\models\QuizQuestion;
use Yii;
use yii\base\Exception;
use yii\web\ForbiddenHttpException;

class Puzzle2Controller extends BaseController
{
    public function actionIndex()
    {
        $user = $this->getUser();
        if ($user->currentPuzzle !== 2) {
            return $this->goHome();
        }

        $questions = QuizQuestion::findAllWithAnswersOrdered();
        $model = new Puzzle2Form();
        $model->questions = $questions;
        if ($model->load(Yii::$app->request->post())) {
            Log::addEntry($user, 'puzzle2', $model->answers);
            if ($model->validate()) {
                $model->createResponse($user);
                $user->currentPuzzle++;
                $user->save();

                return $this->redirect(['index']);
            }
        }

        return $this->render('index', [
            'model' => $model,
            'questions' => $questions,
        ]);
    }

    public function actionDownloadPdf()
    {
        $user = $this->getUser();
        if ($user->currentPuzzle <= 2) {
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
