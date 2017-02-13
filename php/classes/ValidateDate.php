<?php
namespace Edu\Cnm\AbqVast;

/**
 * Trait to Validate a mySQL Date
 *
 * This trait will inject a private method to validate a mySQL style date (e.g., 2016-01-15 15:32:48). It will
 * convert a string representation to a DateTime object or throw an exception.
 *
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 **/
trait ValidateDate {
    private static function validateDate($newDate) {
        // base case: if the date is a DateTime object, there's no work to be done
        if(is_object($newDate) === true && get_class($newDate) === "DateTime") {
            return ($newDate);
        }
        // treat the date as a mySQL date string: Y-m-d
        $newDate = trim($newDate);
        if((preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $newDate, $matches)) !== 1) {
            throw(new \InvalidArgumentException("date is not a valid date"));
        }

        // verify the date is really a valid calendar date
        $year = intval($matches[1]);
        $month = intval($matches[2]);
        $day = intval($matches[3]);
        if(checkdate($month, $day, $year) === false) {
            throw(new \RangeException("date is not a Gregorian date"));
        }


        // if we got here, the date is clean
        $newDate = \DateTime::createFromFormat("Y-m-d H:i:s", $newDate . " 00:00:00");
        return($newDate);
    }
}