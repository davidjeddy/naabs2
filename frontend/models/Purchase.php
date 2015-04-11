<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "purchase".
 *
 * @property integer $id
 * @property integer $device_count_id
 * @property integer $time_id
 * @property integer $user_id
 * @property string $f_name
 * @property string $l_name
 * @property string $street_1
 * @property string $street_2
 * @property string $city
 * @property string $prov
 * @property string $postal
 * @property integer $last_4
 * @property integer $year
 * @property integer $return_code
 * @property string $return_message
 * @property string $created
 * @property string $updated
 * @property string $deleted
 *
 * @property User $user
 * @property DeviceCountOptions $deviceCount
 * @property TimeAmountOptions $time
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
            [['f_name', 'l_name', 'street_1', 'street_2', 'prov', 'postal'], 'string', 'length' => [3, 45]],
            [['city', 'prov'], 'string', 'length' => [1, 45]],
            [['device_count_id', 'time_id', 'user_id', 'f_name', 'l_name', 'street_1', 'city', 'prov', 'postal', 'last_4', 'year'], 'required'],
            [['device_count_id', 'time_id', 'user_id', 'last_4', 'year'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'city'            => 'City',
            'created'         => 'Created',
            'deleted'         => 'Deleted',
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
            'time_id'         => 'Time ID',
            'updated'         => 'Updated',
            'user_id'         => 'User ID',
            'year'            => 'Year',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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
    public function getTime()
    {
        return $this->hasOne(TimeAmountOptions::className(), ['id' => 'time_id']);
    }
}
