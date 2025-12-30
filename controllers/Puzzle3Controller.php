<?php

namespace app\controllers;

class Puzzle3Controller extends BaseController
{
    public function actionIndex()
    {
        $user = $this->getUser();
        if ($user->currentPuzzle !== 3) {
            return $this->goHome();
        }

        return $this->render('index', [
            'pdfTitle' => $user->puzzle2Pdf,
        ]);
    }
}
