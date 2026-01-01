<?php

namespace app\controllers;

use app\models\forms\Puzzle1Form;
use app\models\Log;
use app\models\User;
use Yii;
use yii\base\DynamicModel;

class Puzzle1Controller extends BaseController
{
    public function actionIndex()
    {
        $user = $this->getUser();
        if ($user->currentPuzzle !== User::PUZZLE_1) {
            return $this->goHome();
        }

        $model = new Puzzle1Form;
        if ($model->load(Yii::$app->request->post())) {
            Log::addEntry($user, 'puzzle1', $model->answer);
            if ($model->validate()) {
                $user->currentPuzzle = User::PUZZLE_2_TEST;
                $user->save();

                return $this->refresh();
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
