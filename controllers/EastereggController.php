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

        $this->view->registerCss('span:hover {color: yellow;};');

        return $this->renderContent('Dacht je echt dat het zo <span>ma</span>kkelijk zou zijn? Niets hie<span>r</span> is wat het l<span>ijk</span>t h<span>e</span>!');
    }

    public function actionThree()
    {
        Log::addEntry($this->getUser(), 'easteregg-three');

        return $this->renderContent('Wie niet.');
    }

    public function actionFour()
    {
        Log::addEntry($this->getUser(), 'easteregg-three');

        return $this->renderContent('Echt niet.');
    }

    public function actionSolution()
    {
        Log::addEntry($this->getUser(), 'easteregg-three');

        return $this->renderContent('Inderdaad.');
    }
}
