<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "device".
 *
 * @property integer $id
 * @property string $dvice_mac
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
            [['dvice_mac', 'device_name', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['created', 'updated', 'deleted'], 'safe'],
            [['dvice_mac', 'device_name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dvice_mac' => 'Dvice Mac',
            'device_name' => 'Device Name',
            'user_id' => 'User ID',
            'created' => 'Created',
            'updated' => 'Updated',
            'deleted' => 'Deleted',
        ];
    }
}
