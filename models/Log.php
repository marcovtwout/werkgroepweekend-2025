<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "Log".
 *
 * @property int $id
 * @property int $userId
 * @property string $action
 * @property string $data
 * @property string $datetime
 *
 * @property User $user
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Log';
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'userId']);
    }

    public static function addEntry(User $user, string $action, mixed $data = '')
    {
        $model = new self;
        $model->userId = $user->id;
        $model->action = $action;
        $model->data = is_string($data) ? $data : json_encode($data);
        $model->datetime = date('Y-m-d H:i:s');
        $model->save(false);
    }
}
