<?php

namespace app\models\forms;

use app\models\QuizQuestion;
use app\models\QuizResponse;
use app\models\QuizResponseAnswer;
use app\models\User;
use Yii;
use yii\base\Model;

class Puzzle2Form extends Model
{
    /** @var QuizQuestion[] */
    public $questions;

    /** @var array<int questionIndex, string answerIndex> */
    public $answers;

    public function rules()
    {
        return [
            [['answers'], 'required'],
            [['answers'], 'validateAnswers'],
        ];
    }

    public function validateAnswers($attribute, $params)
    {
        foreach($this->questions as $questionIndex => $question) {
            $answerIndex = $this->answers[$questionIndex] ?? null;
            if (!isset($answerIndex) || !isset($question->quizAnswers[(int) $answerIndex])) {
                $this->addError($attribute, 'Alle vragen moeten beantwoord worden');
            }
        }
    }

    public function createResponse(User $user): QuizResponse
    {
        return Yii::$app->db->transaction(function () use ($user) {
            $response = new QuizResponse();
            $response->userId = $user->id;
            $response->datetime = date('Y-m-d H:i:s');
            $response->save();

            foreach($this->questions as $questionIndex => $question) {
                $answer = $question->quizAnswers[$this->answers[$questionIndex]];

                $responseAnswer = new QuizResponseAnswer();
                $responseAnswer->quizResponseId = $response->id;
                $responseAnswer->quizQuestionId = $question->id;
                $responseAnswer->quizAnswerId = $answer->id;
                $responseAnswer->isCorrect = $answer->isCorrect;
                $responseAnswer->isSpongebob = $answer->isSpongebob;
                $responseAnswer->save();
            }

            return $response;
        });
    }
}
