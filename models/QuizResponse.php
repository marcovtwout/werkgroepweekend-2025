<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "QuizResponse".
 *
 * @property int $id
 * @property int $userId
 * @property string $datetime
 *
 * @property QuizQuestion[] $quizQuestions
 * @property QuizResponseAnswer[] $quizResponseAnswers
 * @property User $user
 */
class QuizResponse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'QuizResponse';
    }

    public function getQuizResponseAnswers(): ActiveQuery
    {
        return $this->hasMany(QuizResponseAnswer::class, ['quizResponseId' => 'id']);
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'userId']);
    }

    public function getCorrectCount(): int
    {
        return $this->getQuizResponseAnswers()->andWhere(['isCorrect' => true])->count();
    }

    public function getSpongebobCount(): int
    {
        return $this->getQuizResponseAnswers()->andWhere(['isSpongebob' => true])->count();
    }
}
