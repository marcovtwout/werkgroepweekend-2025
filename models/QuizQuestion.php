<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * This is the model class for table "QuizQuestion".
 *
 * @property int $id
 * @property int $nr
 * @property string $title
 *
 * @property QuizAnswer[] $quizAnswers
 */
class QuizQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'QuizQuestion';
    }

    public function getQuizAnswers(): ActiveQuery
    {
        return $this->hasMany(QuizAnswer::class, ['questionId' => 'id'])->orderBy('QuizAnswer.position');
    }

    public function getFullTitle(): string
    {
        return sprintf(' %d: %s', $this->nr, $this->title);
    }

    public static function findAllWithAnswersOrdered()
    {
        return self::find()
            ->joinWith('quizAnswers')
            ->orderBy(['QuizQuestion.nr' => SORT_ASC, 'QuizAnswer.position' => SORT_ASC])
            ->all();
    }

    public function isSpongebobQuestion(): bool
    {
        return $this->getQuizAnswers()->andWhere(['isSpongebob' => true])->exists();
    }
}
