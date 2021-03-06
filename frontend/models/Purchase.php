<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "purchase".
 *
 * @property integer $id
 * @property integer $country_id
 * @property integer $device_count_id
 * @property integer $time_amount_id
 * @property integer $user_id
 * @property string $f_name
 * @property string $l_name
 * @property string $street_1
 * @property string $street_2
 * @property string $city
 * @property string $prov
 * @property string $postal
 * @property integer $last_4
 * @property integer $price
 * @property integer $return_code
 * @property string $return_message
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 *
 * @property DeviceCountOptions $deviceCount
 * @property TimeAmountOptions $timeAmount
 * @property User $user
 */
class Purchase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'user_id', 'f_name', 'l_name', 'street_1', 'city', 'prov', 'postal'], 'required'],
            [['country_id', 'device_count_id', 'time_amount_id', 'user_id', 'last_4', 'return_code', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['f_name', 'l_name', 'street_1', 'street_2', 'city', 'prov', 'postal', 'return_message'], 'string', 'max' => 45],

            [['last_4', 'price'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'city'            => 'City',
            'country_id'      => 'Country ID',
            'created_at'      => 'Created At',
            'deleted_at'      => 'Deleted At',
            'device_count_id' => 'Device Count ID',
            'f_name'          => 'First Name',
            'id'              => 'ID',
            'l_name'          => 'Last Name',
            'last_4'          => 'Last 4',
            'postal'          => 'Postal',
            'price'           => 'Price',
            'prov'            => 'Prov',
            'return_code'     => 'Return Code',
            'return_message'  => 'Return Message',
            'street_1'        => 'Street 1',
            'street_2'        => 'Street 2',
            'time_amount_id'  => 'Time Amount ID',
            'updated_at'      => 'Updated At',
            'user_id'         => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceCount()
    {
        return $this->hasOne(DeviceCountOptions::className(), ['id' => 'device_count_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimeAmount()
    {
        return $this->hasOne(TimeAmountOptions::className(), ['id' => 'time_amount_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
