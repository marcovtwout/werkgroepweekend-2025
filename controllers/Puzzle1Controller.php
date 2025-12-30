<?php

namespace app\controllers;

use app\models\forms\Puzzle1Form;
use app\models\Log;
use Yii;
use yii\base\DynamicModel;

class Puzzle1Controller extends BaseController
{
    public function actionIndex()
    {
        $user = $this->getUser();
        if ($user->currentPuzzle !== 1) {
            return $this->goHome();
        }

        $model = new Puzzle1Form;
        if ($model->load(Yii::$app->request->post())) {
            Log::addEntry($user, 'puzzle1', $model->answer);
            if ($model->validate()) {
                $user->currentPuzzle++;
                $user->save();

                return $this->redirect(['index']);
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
