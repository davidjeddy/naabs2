<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "device_count_options".
 *
 * @property integer $id
 * @property string $key
 * @property integer $value
 * @property string $cost
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 */
class DeviceCountOptions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device_count_options';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'required'],
            [['value', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['cost'], 'number'],
            [['key'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cost'    => 'Cost',
            'created_at' => 'Created At',
            'deleted_at' => 'Deleted At',
            'id'      => 'ID',
            'key'     => 'Key',
            'updated_at' => 'Updated At',
            'value'   => 'Value',
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
