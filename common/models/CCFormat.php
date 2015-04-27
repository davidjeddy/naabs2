<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "cc_format".
 *
 * @property integer $id
 * @property string $number
 * @property integer $exp_month
 * @property integer $exp_year
 * @property integer $cvv2
 * @property string $type
 */
class CCFormat extends \yii\db\ActiveRecord
{
    public $cvv2;
    public $exp_month;
    public $exp_year;
    public $number;
    public $type;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return null;//'cc_format';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'number', 'exp_month', 'exp_year', 'cvv2'], 'required'],
            [['cvv2', 'exp_year'], 'string',  'max' => 4],
            [['exp_month'], 'string',  'max'        => 2],
            [['number'], 'string', 'max'            => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cvv2'      => 'Cvv2',
            'exp_month' => 'Exp Month',
            'exp_year'  => 'Exp Year',
            'number'    => 'Number',
            'type'      => 'Card Type',
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
