<?php
/**
 * File Paypal.php
 *
 * @author Marcio Camello <marciocamello@outlook.com>, David J Eddy <ne@davidjeddy.com>
 * @see https://github.com/paypal/rest-api-sdk-php/blob/master/sample/
 * @see https://developer.paypal.com/webapps/developer/applications/accounts
 */

namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\ErrorException;

use PayPal\Api\Address;
use PayPal\Api\Amount;
use PayPal\Api\CreditCard;
use PayPal\Api\Details;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

/**
 * 
 */
class Paypal extends Component
{
    protected $data = [];

    /* Get/Set methods */

    /**
     * Set the class properties, sourced from an array
     * @param array $_param_data [description]
     * @return object $_param_data [description]
     */
    public function setDate($_param_data)
    {
        if (is_array($_param_data) && !empty($_param_data)) {
            $this->data = $_param_data;
            return $this;
        } else {
            return 'ERROR: Attempting to set invalid data to object property. '.__METHOD__;
        }

        return 'ERROR: '.__METHOD__;
    }

    /* Logic methods */

    public function processCreditCardPayment()
    {
        $addr = new Address();
        $addr->setLine1($this->data['address']['street_1'])
            ->setCity($this->data['address']['city'])
            ->setCountryCode($this->data['address']['country'])
            ->setPostalCode($this->data['address']['postal'])
            ->setState($this->data['address']['prov']);

        $card = new CreditCard();
        $card->setNumber($this->data['creditcard']['number'])
            ->setType($this->data['creditcard']['type'])
            ->setExpireMonth($this->data['creditcard']['exp_month'])
            ->setExpireYear($this->data['creditcard']['exp_year'])
            ->setCvv2($this->data['creditcard']['cvv2'])
            ->setFirstName($this->data['creditcard']['f_name'])
            ->setLastName($this->data['creditcard']['l_name'])
            ->setBillingAddress($addr);



        $fi = new FundingInstrument();
        $fi->setCreditCard($card);

        $payer = new Payer();
        $payer->setPaymentMethod('credit_card');
        $payer->setFundingInstruments(array($fi));



        $_tax_amount = $this->data['amountdetails']['subtotal'] * Yii::$app->params['paypal']['tax_rate'];
        $amountDetails = new Details();
        $amountDetails->setSubtotal($this->data['amountdetails']['subtotal'])
            ->setTax($_tax_amount)
            ->setShipping(Yii::$app->params['paypal']['shipping_rate']);

        $amount = new Amount();
        $amount->setCurrency(Yii::$app->params['paypal']['currency'])
            ->setTotal( (string)(
                $this->data['amountdetails']['subtotal']
                + $_tax_amount
                + Yii::$app->params['paypal']['shipping_rate']) )
            ->setDetails($amountDetails);



        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('Testing naabs2.');

        $payment = new Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setTransactions(array($transaction));



        return $payment->create($this->ApiContext());
    }



    /* Private methods */



    /**
     * [ApiContext description]
     */
    private function ApiContext()
    {
        return new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                Yii::$app->params['paypal_client']['id'],
                Yii::$app->params['paypal_client']['secret']
            )
        );
    }

    /**
     * [calculateTotal description]
     * 
     * @param  ItemList $itemList
     * @param  Details  $details
     * @return numeric
     */
    private function calculateTotal(ItemList $itemList, Details $details)
    {
        $_method_data = null;

        foreach ($itemList->getItems() as $_value) {

            $_method_data = ($_method_data + ($_value->price + $_value->tax));
        }

        $_method_data = $_method_data + $details->subtotal;

        return is_numeric($_method_data) ? $_method_data : false;
    }
}

