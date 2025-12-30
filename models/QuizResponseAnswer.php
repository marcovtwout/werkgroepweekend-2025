<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "QuizResponseAnswer".
 *
 * @property int $quizResponseId
 * @property int $quizQuestionId
 * @property int $quizAnswerId
 * @property int|null $isCorrect
 *
 * @property QuizAnswer $quizAnswer
 * @property QuizQuestion $quizQuestion
 * @property QuizResponse $quizResponse
 */
class QuizResponseAnswer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'QuizResponseAnswer';
    }

    public function getQuizAnswer(): ActiveQuery
    {
        return $this->hasOne(QuizAnswer::class, ['id' => 'quizAnswerId']);
    }

    public function getQuizQuestion(): ActiveQuery
    {
        return $this->hasOne(QuizQuestion::class, ['id' => 'quizQuestionId']);
    }

    public function getQuizResponse(): ActiveQuery
    {
        return $this->hasOne(QuizResponse::class, ['id' => 'quizResponseId']);
    }
}
