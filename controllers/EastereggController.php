<?php

namespace app\controllers;

use app\models\Log;

class EastereggController extends BaseController
{
    public function actionOne()
    {
        Log::addEntry($this->getUser(), 'easteregg-one');

        return $this->renderContent('Er zijn niet meer puzzels..');
    }

    public function actionTwo()
    {
        Log::addEntry($this->getUser(), 'easteregg-two');

        return $this->renderContent('Dacht je echt dat het zo makkelijk zou zijn?');
    }

    public function actionThree()
    {
        Log::addEntry($this->getUser(), 'easteregg-three');

        return $this->renderContent('Inderdaad.');
    }
}
