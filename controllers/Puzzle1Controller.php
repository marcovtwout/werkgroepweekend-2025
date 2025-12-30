<?php

namespace app\controllers;

use app\models\Log;
use Yii;
use yii\base\DynamicModel;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;

class Puzzle1Controller extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
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
            Log::addEntry(Yii::$app->user->identity, 'puzzle1', $model->answer);
            if ($model->validate()) {
                // goed!
                exit;
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
