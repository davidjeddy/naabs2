<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "app_data".
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 * @property string $created
 * @property string $updated
 * @property string $delete
 */
class AppData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'required'],
            [['value'], 'string'],
            [['key', 'value', 'created', 'updated', 'delete'], 'safe'],
            [['key'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'created' => 'Created',
            'delete'  => 'Delete',
            'id'      => 'ID',
            'key'     => 'Key',
            'updated' => 'Updated',
            'value'   => 'Value',
        ];
    }
}
