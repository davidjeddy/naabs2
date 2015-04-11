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
 */
class CCFormat extends Model
{
    public $cvv2;
    public $exp_month;
    public $exp_year;
    public $number;

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
            [['number', 'exp_month', 'exp_year', 'cvv2'], 'required'],
            [['exp_month', 'exp_year', 'cvv2'], 'integer'],
            [['number'], 'string', 'max' => 24],
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
        ];
    }

    /**
     * 
     * Temp method till payment system is added
     * @return [type] [description]
     */
    public function save()
    {
        return true;
    }
}
