<?php

namespace app\commands;

use app\models\QuizAnswer;
use app\models\QuizQuestion;
use yii\console\Controller;
use yii\console\ExitCode;

class QuizController extends Controller
{
    public function actionImport()
    {
        $data = require __DIR__ . '/quizData.php';

        QuizQuestion::deleteAll();

        foreach($data as $index => $row) {
            $questionTitle = array_shift($row);
            $answers = $row;

            $question = new QuizQuestion();
            $question->nr = $index + 1;
            $question->title = $questionTitle;
            $question->save();

            foreach($answers as $answerIndex => $answerText) {
                $answer = new QuizAnswer();
                $answer->questionId = $question->id;
                $answer->text = trim(preg_replace('#\[.*] #', '', $answerText));
                $answer->isCorrect = str_contains($answerText, '[Correct]');
                $answer->isSpongebob = str_contains($answerText, '[Spongebob]');
                $answer->position = $answerIndex+1;
                $answer->save();
            }
        }

        return ExitCode::OK;
    }
}
