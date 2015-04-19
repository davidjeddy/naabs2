<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "radcheck".
 *
 * @property integer $id
 * @property string $username
 * @property string $attribute
 * @property string $op
 * @property string $value
 */
class RadCheck extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'radcheck';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'attribute', 'op', 'value'], 'required'],
            [['username', 'attribute', 'value'], 'string', 'max' => 32],
            [['op'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'attribute' => 'Attribute',
            'op' => 'Op',
            'value' => 'Value',
        ];
    }

    //if (RadCheck::addTime( $_op, $_username, $_value )) {
    public static function addTime( $_op, $_username, $_value )
    {
echo '<pre>';
print_r( $_op );
print_r( $_username );
print_r( $_value );
echo '</pre>';
exit;
    }
}
