<?php

namespace app\models\forms;

use yii\base\Model;

class Puzzle4Form extends Model
{
    public $answer;

    public function rules()
    {
        return [
            [['answer'], 'required'],
            [['answer'], function ($attribute) {
                $correct = str_contains(strtolower($this->$attribute), 'spongebob');

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
