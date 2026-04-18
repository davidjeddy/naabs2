<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "time_amount_options".
 *
 * @property integer $id
 * @property string $key
 * @property integer $value
 * @property string $cost
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 */
class TimeAmountOptions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'time_amount_options';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value', 'cost'], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['value'], 'string'],
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
            'id'      => 'ID',
            'key'     => 'Key',
            'value'   => 'Value',
            'cost'    => 'Cost',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }
}
