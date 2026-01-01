<?php

namespace app\controllers;

use app\models\forms\Puzzle3Form;
use app\models\Log;
use app\models\User;
use Yii;

class Puzzle3Controller extends BaseController
{
    public function actionIndex()
    {
        $user = $this->getUser();
        if ($user->currentPuzzle !== User::PUZZLE_3) {
            return $this->goHome();
        }

        $model = new Puzzle3Form();
        $model->correctAnswer = $user->puzzle3Answer;
        if ($model->load(Yii::$app->request->post())) {
            Log::addEntry($user, 'puzzle3', $model->answer);
            if ($model->validate()) {
                $user->currentPuzzle = User::PUZZLE_4;
                $user->save();

                return $this->refresh();
            }
        }

        return $this->render('index', [
            'puzzle3Question' => $user->puzzle3Question,
            'model' => $model,
        ]);
    }
}
