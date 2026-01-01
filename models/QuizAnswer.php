<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "QuizAnswer".
 *
 * @property int $id
 * @property int $questionId
 * @property string $text
 * @property int $isCorrect
 * @property int $isSpongebob
 *
 * @property QuizQuestion $question
 */
class QuizAnswer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'QuizAnswer';
    }

    public function getQuestion(): ActiveQuery
    {
        return $this->hasOne(QuizQuestion::class, ['id' => 'questionId']);
    }

}
