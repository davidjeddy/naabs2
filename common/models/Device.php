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
            'created_at'  => 'Created At',
            'deleted_at'  => 'Deleted At',
            'device_mac'  => 'Device Mac',
            'device_name' => 'Device Name',
            'id'          => 'ID',
            'updated_at'  => 'Updated At',
            'user_id'     => 'User ID',
        ];
    }

    /* convert the datetime<->timestamp between saving and displaying */

    public function beforeSave($insert)
    {
        // convert datetime to timestamp for MDL, but only for 'Expiration' attrib.
        $this->setAttribute('created_at', strtotime($this->getAttribute('created_at')) );
        $this->setAttribute('updated_at', strtotime($this->getAttribute('updated_at')) );

        return $this;
    }

    public function afterFind()
    {
        // convert timestamp to datetime for CNTL/VW, but only for 'Expiration' attrib.
        $this->setAttribute('created_at', date('Y-m-d H:i:s', $this->getAttribute('created_at')));
        $this->setAttribute('updated_at', date('Y-m-d H:i:s', $this->getAttribute('updated_at')));

        return $this;
    }
}
