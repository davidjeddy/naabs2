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
 * @property integer $created
 * @property integer $updated
 * @property integer $deleted
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
            [['value', 'created', 'updated', 'deleted'], 'integer'],
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
            'created' => 'Created',
            'deleted' => 'Deleted',
            'id'      => 'ID',
            'key'     => 'Key',
            'updated' => 'Updated',
            'value'   => 'Value',
        ];
    }
}
