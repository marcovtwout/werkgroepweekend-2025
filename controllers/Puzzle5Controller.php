<?php

namespace app\controllers;

use app\models\forms\Puzzle2Form;
use app\models\Log;
use app\models\QuizQuestion;
use app\models\User;
use DateTime;
use Yii;
use yii\web\HttpException;

class Puzzle5Controller extends BaseController
{
    public function actionIndex()
    {
        $user = $this->getUser();
        if ($user->currentPuzzle === User::PUZZLE_5_TEST) {
            return $this->redirect(['test']);
        } elseif ($user->currentPuzzle === User::PUZZLE_5_RESULT) {
            return $this->redirect(['result']);
        } else {
            return $this->goHome();
        }
    }

    public function actionTest()
    {
        $user = $this->getUser();
        if ($user->currentPuzzle !== User::PUZZLE_5_TEST) {
            return $this->goHome();
        }

        $questions = QuizQuestion::findAllWithAnswersOrdered();
        $model = new Puzzle2Form();
        $model->questions = $questions;
        if ($model->load(Yii::$app->request->post())) {
            // Simple rate limiting
            if ($this->rateLimitExceeded($user)) {
                throw new HttpException(400, 'Wacht iets langer voordat je een nieuwe poging doet..');
            }

            Log::addEntry($user, 'puzzle5', $model->answers);
            if ($model->validate()) {
                $response = $model->createResponse($user);

                if ($response->getSpongebobCount() >= 10) {
                    $user->currentPuzzle = User::PUZZLE_5_RESULT;
                    $user->save();

                    return $this->refresh();
                } else {
                    $model->addError('answers', 'Helaas, dat zijn niet genoeg goede antwoorden! Probeer het nogmaals.');
                }
            }
        }

        return $this->render('test', [
            'model' => $model,
            'questions' => $questions,
        ]);
    }

    public function actionPreviousResults()
    {
        // @todo
    }

    private function rateLimitExceeded(User $user)
    {
        $previousResponses = $user->getQuizResponses()->orderBy(['datetime' => SORT_DESC])->all();
        $backoffMinutes = 3 * count($previousResponses);
        $latestDateTime = new DateTime($previousResponses[0]->datetime);

        return $latestDateTime->modify(sprintf('+%d minutes', $backoffMinutes)) > new DateTime();
    }
}
