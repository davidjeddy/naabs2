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
 * @property string $created
 * @property string $updated
 * @property string $deleted
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
            [['created', 'updated', 'deleted'], 'safe'],
            [['device_mac', 'device_name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'created'     => 'Created',
            'deleted'     => 'Deleted',
            'device_mac'  => 'Device Mac',
            'device_name' => 'Device Name',
            'id'          => 'ID',
            'updated'     => 'Updated',
            'user_id'     => $this->getUser(),
        ];
    }

    /**
     * Get the user related to the device via the user details TBO
     * 
     * @return [type] [description]
     */
    public function getUser()
    {
        return $this->hasOne(UserDetails::className(), ['id' => 'user_id']);
    }
}
