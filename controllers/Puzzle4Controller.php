<?php

namespace app\controllers;

use app\models\forms\Puzzle4Form;
use app\models\Log;
use app\models\User;
use Yii;

class Puzzle4Controller extends BaseController
{
    public function actionIndex()
    {
        $user = $this->getUser();
        if ($user->currentPuzzle !== User::PUZZLE_4) {
            return $this->goHome();
        }

        $model = new Puzzle4Form();
        if (Yii::$app->params['enablePuzzle5']) {
            if ($model->load(Yii::$app->request->post())) {
                Log::addEntry($user, 'puzzle4', $model->answer);
                if ($model->validate()) {
                    $user->currentPuzzle = User::PUZZLE_5_TEST;
                    $user->save();

                    return $this->refresh();
                }
            }
        }

        return $this->render('index', [
            'model' => $model,
            'puzzle3Result' => $user->puzzle3Result,
            'enablePuzzle5' => Yii::$app->params['enablePuzzle5'],
        ]);
    }
}
