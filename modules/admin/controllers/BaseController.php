<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\filters\AccessControl;
abstract class BaseController extends \app\controllers\BaseController
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
                        'matchCallback' => function () {
                            return Yii::$app->user->identity?->getIsAdmin() ?? false;
                        }
                    ],
                ],
            ],
        ];
    }
}
