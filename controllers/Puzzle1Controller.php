<?php

namespace app\controllers;

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

        $model = new DynamicModel(['answer']);
        $model->addRule('answer', 'required');
        $model->addRule('answer', function ($attribute) {
            $correct =
                str_contains($this->$attribute, 'suske')
                && str_contains($this->$attribute, 'wiske');

            if (!$correct) {
                $this->addError($attribute, 'Helaas!');
            };
        });

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
