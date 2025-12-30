<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "User".
 *
 * @property int $id
 * @property string $username
 * @property string $passwordHash
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'User';
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

    public function isAdmin(): bool
    {
        return in_array($this->username, ['marco', 'joep']); // quick n dirty
    }
}
