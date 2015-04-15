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
 * @property string $deleted
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
            [['created', 'updated', 'deleted'], 'safe'],
            [['key'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'value' => 'Value',
            'created' => 'Created',
            'updated' => 'Updated',
            'deleted' => 'Deleted',
        ];
    }
}
