<?php

namespace backend\models;

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'device_count_id', 'time_amount_id', 'user_id', 'f_name', 'l_name', 'street_1', 'city', 'prov', 'postal', 'last_4', 'timestamp', 'created_at'], 'required'],
            [['country_id', 'device_count_id', 'time_amount_id', 'user_id', 'last_4', 'timestamp', 'return_code', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['f_name', 'l_name', 'street_1', 'street_2', 'city', 'prov', 'postal', 'return_message'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id' => 'Country ID',
            'device_count_id' => 'Device Count ID',
            'time_amount_id' => 'Time Amount ID',
            'user_id' => 'User ID',
            'f_name' => 'F Name',
            'l_name' => 'L Name',
            'street_1' => 'Street 1',
            'street_2' => 'Street 2',
            'city' => 'City',
            'prov' => 'Prov',
            'postal' => 'Postal',
            'last_4' => 'Last 4',
            'timestamp' => 'Timestamp',
            'return_code' => 'Return Code',
            'return_message' => 'Return Message',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
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

    /* Custom Data Aggregate methods */

    /**
     * Return the # of sales per month based on teh year param
     *
     * @since  0.4.5 [description]
     * @param  integer $year [description]
     * @return array
     */
    public static function getSaleByYear($year)
    {
        $return_data = [];
        if (!is_numeric($year)) { return false; };

        foreach ([1,2,3,4,5,6,7,8,9,10,11,12] as $_key => $_value) {
            $start = mktime(0, 0, 0, $_value, 1,  $year);
            $end   = mktime(0, 0, 0, $_value, 31, $year);

            $return_data[] = (integer)Purchase::find()
                ->select('id')
                ->where(['return_code' => 200])
                ->andWhere(['>=', 'created_at', $start])
                ->andWhere(['<=', 'created_at', $end])
                ->andWhere(['deleted_at' => null])
                ->count();
        }

        return $return_data;
    }
}
