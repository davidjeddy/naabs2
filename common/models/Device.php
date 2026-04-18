<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "device".
 *
 * @property integer $id
 * @property string $device_mac
 * @property string $device_name
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
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
            [['device_mac', 'device_name', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['device_mac', 'device_name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'created_at'     => 'Created At',
            'deleted_at'     => 'Deleted At',
            'device_mac'  => 'Device Mac',
            'device_name' => 'Device Name',
            'id'          => 'ID',
            'updated_at'     => 'Updated At',
            'user_id'     => 'User ID',
        ];
    }
}
