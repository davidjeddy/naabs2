<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['key'], 'string', 'max' => 2],
            [['value'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'created_at' => 'Created At',
            'deleted_at' => 'Deleted At',
            'id'         => 'ID',
            'key'        => 'Key',
            'updated_at' => 'Updated At',
            'value'      => 'Value',
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
