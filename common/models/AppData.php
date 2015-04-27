<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "app_data".
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
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
            [['key', 'value', 'created_at', 'updated_at', 'delete'], 'safe'],
            [['key'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'created_at' => 'created_at',
            'delete'  => 'Delete',
            'id'      => 'ID',
            'key'     => 'Key',
            'updated_at' => 'updated_at',
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
