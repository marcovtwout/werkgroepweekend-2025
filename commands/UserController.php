<?php

namespace app\commands;

use app\models\User;
use yii\console\Controller;
use yii\console\ExitCode;

class UserController extends Controller
{
    public function actionCreate($username)
    {
        $user = new User;
        $user->username = $username;
        $password = $user->generatePassword();
        $user->save(false);

        echo sprintf("Username: %s\n", $username);
        echo sprintf("Password: %s\n", $password);

        return ExitCode::OK;
    }
}
