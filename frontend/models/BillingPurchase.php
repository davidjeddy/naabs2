<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class BillingPurchase extends Model
{
    public $cc_cvv2;
    public $cc_month;
    public $cc_type;
    public $cc_year;
    public $city;
    public $country;
    public $f_name;
    public $l_name;
    public $postal;
    public $prov;
    public $street_1;
    public $street_2;
    public $time_amount;

    /**
     * Do what needs to be done before construct() but before beforeValidate()
     * 
     * @return [type] [description]
     */
    public function init()
    {

    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['f_name', 'l_name'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cc_cvv2'     => 'CVV2',
            'cc_mount'    => 'Expire month',
            'cc_type'     => 'Credit Card Type',
            'cc_year'     => 'Expire Year',
            'city'        => 'City',
            'country'     => 'Country',
            'f_name'      => 'First Name',
            'l_name'      => 'Last Name',
            'postal'      => 'ZIP / Postal Code',
            'prov'        => 'State / Prov.',
            'street_1'    => 'Street 1',
            'street_2'    => 'Stret 2',
            'time_amount' => 'Amount of time',
        ];
    }
}
