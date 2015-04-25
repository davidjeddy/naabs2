<?php

namespace frontend\models;

use Yii;

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
 * @property integer $timestamp
 * @property integer $return_code
 * @property string $return_message
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'device_count_id', 'time_amount_id', 'user_id', 'f_name', 'l_name', 'street_1', 'city', 'prov', 'postal', 'last_4', 'timestamp'], 'required'],
            [['country_id', 'device_count_id', 'time_amount_id', 'user_id', 'last_4', 'timestamp', 'return_code'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['f_name', 'l_name', 'street_1', 'street_2', 'city', 'prov', 'postal', 'return_message'], 'string', 'max' => 45]
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
            'created_at'      => 'Created',
            'deleted_at'      => 'Deleted',
            'device_count_id' => 'Device Count ID',
            'f_name'          => 'First Name',
            'id'              => 'ID',
            'l_name'          => 'Last Name',
            'last_4'          => 'Last 4',
            'postal'          => 'Postal',
            'prov'            => 'Prov',
            'return_code'     => 'Return Code',
            'return_message'  => 'Return Message',
            'street_1'        => 'Street 1',
            'street_2'        => 'Street 2',
            'time_amount_id'  => 'Time Amount ID',
            'timestamp'       => 'Timestamp',
            'updated_at'      => 'Updated',
            'user_id'         => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }
    */

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
