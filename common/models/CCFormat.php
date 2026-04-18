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
            [['cvv2'], 'string',  'max'                  => 4],
            [['exp_month', 'exp_year'], 'string',  'max' => 2],
            [['number'], 'string', 'max'                 => 16],
            [['type'], 'string', 'max'                   => 2],
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
}
