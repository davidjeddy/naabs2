<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "device".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $device_name
 * @property string $pass_phrase
 * @property integer $expiration
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 */
class Device extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'device_name', 'pass_phrase', 'created_at'], 'required'],
            [['user_id', 'expiration', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['device_name'], 'string', 'max' => 64],
            [['pass_phrase'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'device_name' => 'Device Name',
            'pass_phrase' => 'Pass Phrase',
            'expiration' => 'Expiration',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
