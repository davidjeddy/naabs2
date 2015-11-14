<?php
/**
 * File DateAndTimes.php
 *
 * @author  David J Eddy <ne@davidjeddy.com>
 * @see https://github.com/davidjeddy?tab=repositories
 */

namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\ErrorException;

/**
 * Manipulation of datetime/timestamp/DateTime/etc. Typically returning arrays of months, or Day # of every given weekday, etc.
 *
 * @version  0.0.1
 */
class DateAndTimes extends Component
{
    public $data = [];

    /* Get/Set methods */

    /**
     * Return array of months
     * @param  string $format PHP valid 'month' formating
     * @return array
     */
    public static function getMonthAs($format)
    {
        $_return_data = [];
        
        // make sure the format passed in is valid
        if (in_array($format, ['F', 'M', 'm', 'n', 't'])) {

            $counter = 0;
            do {
                $_return_data[] = date($format, mktime(0, 0, 0, ++$counter, 1, 0));
            } while ($counter < 12);
        } else {

            $_return_data = ['error' => 'Invalid format provided for '.__METHOD__];
        }

        return $_return_data;
    }
}

