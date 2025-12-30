<?php

namespace app\models\forms;

use yii\base\Model;

class Puzzle1Form extends Model
{
    public $answer;

    public function rules()
    {
        return [
            [['answer'], 'required'],
            [['answer'], function ($attribute) {
                $correct =
                    str_contains($this->$attribute, 'suske')
                    && str_contains($this->$attribute, 'wiske');

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
