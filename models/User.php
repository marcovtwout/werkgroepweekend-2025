<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "User".
 *
 * @property int $id
 * @property string $username
 * @property string $passwordHash
 * @property int $currentPuzzle
 * @property string $puzzle2Pdf
 * @property string $puzzle3Question
 * @property string $puzzle3Answer
 * @property string $puzzle3Result
 *
 * @property Log[] $logs
 * @property QuizResponse $quizResponse
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const PUZZLE_1 = '1';
    const PUZZLE_2_TEST = '2';
    const PUZZLE_2_RESULT = '2.1';
    const PUZZLE_2_ELIMINATION = '2.2';
    const PUZZLE_3 = '3';
    const PUZZLE_4 = '4';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'User';
    }

    public function getLogs(): ActiveQuery
    {
        return $this->hasMany(Log::class, ['userId' => 'id']);
    }

    public function getQuizResponse(): ActiveQuery
    {
        return $this->hasOne(QuizResponse::class, ['userId' => 'id']);
    }

    public static function findIdentity($id)
    {
        return self::findOne((int)$id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public static function findByUsername($username)
    {
         return self::find()->andWhere(['username' => $username])->one();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }

    public function validatePassword($password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->passwordHash);
    }

    public function generatePassword(): string
    {
        $password = Yii::$app->security->generateRandomString(8);

        $this->passwordHash = Yii::$app->security->generatePasswordHash($password);

        return $password;
    }

    public function getIsAdmin(): bool
    {
        return in_array($this->username, ['marco', 'joep']); // quick n dirty
    }
}
