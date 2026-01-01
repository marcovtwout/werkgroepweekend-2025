<?php

namespace app\models\forms;

use yii\base\Model;

class Puzzle3Form extends Model
{
    public $correctAnswer;
    public $answer;

    public function rules()
    {
        return [
            [['answer'], 'required'],
            [['answer'], function ($attribute) {
                $correct = str_contains($this->$attribute, $this->correctAnswer);

                if (!$correct) {
                    $this->addError($attribute, 'Helaas!');
                };
            }],
        ];
    }

    public function attributeLabels()
    {
        return [
            'answer' => 'Antwoord',
        ];
    }
}
