<?php
namespace Edu\Cnm\AbqVast;

require_once("autoload.php");
/**
 * checkbook class'
 * this will be the class checkbook attributes and entities.
 * @author Valente Meza <vmeza3@cnm.edu>
 * @version 3.2.0
 */

class Checkbook implements \JsonSerializable {
    use ValidateDate;
    /**
     * id for checkbook; this is the primary key
     * @var int $checkbookId
     **/
    private $checkbookId;
    /**
     * Invoice amount for checkbook
     **/
    private $checkbookInvoiceAmount;
    /**
     * Invoice date for checkbook
     **/
    private $checkbookInvoiceDate;
    /**
     * Invoice Number for checkbook
     **/
    private $checkbookInvoiceNum;
    /**
     * Payment Date for checkbook
     **/
    private $checkbookPaymentDate;
    /**
     * Reference number for checkbook
     **/
    private $checkbookReferenceNum;
    /**
     * Vendor for checkbook
     **/
    private $checkbookVendor;

    /**
     * constructor for this checkbook
     * @param int $newCheckbookId id of this checkbook
     * @param string $newCheckbookInvoiceAmount invoice amount for this checkbook
     * @param \DateTime|string|null $newCheckbookInvoiceDate invoice date for this checkbook
     * @param string $newCheckbookInvoiceNum invoice number for this checkbook
     * @param \DateTime|string|null $newCheckbookPaymentDate payment date for this checkbook
     * @param string $newCheckbookReferenceNum reference number for this checkbook
     * @param string $newCheckbookVendor vendor name on checkbook
     * @throws \InvalidArgumentException if data types are not valid
     * @throws \TypeError if data types violate type hints
     * @throws \TypeError if data types violate type
     * @throws \Exception if some other exception occurs
     */
    public function __construct(int $newCheckbookId = null, string $newCheckbookInvoiceAmount, string $newCheckbookInvoiceDate, string $newCheckbookInvoiceNum, string $newCheckbookPaymentDate, string $newCheckbookReferenceNum, string $newCheckbookVendor) {
        try{
            $this->setCheckbookId($newCheckbookId);
            $this->setCheckbookInvoiceAmount($newCheckbookInvoiceAmount);
            $this->setCheckbookInvoiceDate($newCheckbookInvoiceDate);
            $this->setCheckbookInvoiceNum($newCheckbookInvoiceNum);
            $this->setCheckbookPaymentDate($newCheckbookPaymentDate);
            $this->setCheckbookReferenceNum($newCheckbookReferenceNum);
            $this->setCheckbookVendor($newCheckbookVendor);
        } catch (\InvalidArgumentException $invalidArgument) {
            //**rethrow the exception to the caller */
            throw(new\InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
        }  catch(\RangeException $range) {
            //** rethrow the exception to the caller**/
            throw(new\RangeException($range->getMessage(), 0, $range));
        } catch (\TypeError $typeError) {
            //**rethrow the exception to the caller**//
            throw(new\TypeError($typeError));
        } catch (\Exception $exception) {
            // rethrow exception to the caller
            throw(new\Exception($exception->getMessage(), 0, $exception));
        }
    }

    /** accessor method for checkbookId
     * @return int|null value of checkbook id
     **/
    public function getCheckbookId() {
        return ($this->checkbookId);
    }

    /**
     * mutator method for checkbook id
     * @param int $newCheckbookId new value of checkbook id
     * @throws \RangeException if $newCheckbookId is not positive
     * @throws \TypeError if $newCheckbookId is not an integer
     **/
    public function setCheckbookId(int $newCheckbookId = null) {
        //**base case: if the checkbook is null
        if ($newCheckbookId ===null) {
            $this->checkbookId = null;
            return;
        }
        //**verify the checkbook id is positive*/
        if ($newCheckbookId <= 0){
            throw(new \RangeException("checkbook is not positive"));
            //**convert and store the checkbook id
        }
        $this->checkbookId = $newCheckbookId;
    }
    /**
     * accessor method for Invoice amount
     * @return float value of invoice amount
     **/
    public function getCheckbookInvoiceAmount() {
        return($this->checkbookInvoiceAmount);
    }
    /**
     * mutator method for invoice amount
     * @param float $newCheckbookInvoiceAmount
     * @throws \TypeError if $newCheckbook is to long
     */
    public function setCheckbookInvoiceAmount(float $newCheckbookInvoiceAmount) {
        //** store invoice amount */
        $this->checkbookInvoiceAmount = $newCheckbookInvoiceAmount;
    }
    /**
     * accessor method for Invoice Date
     *
     * @return \DateTime value of invoice date
     **/
    public function getCheckbookInvoiceDate() {
        return($this->checkbookInvoiceDate);
    }
    /**
     * mutator method for invoice date
     *
     * @param \DateTime|string|null $newCheckbookInvoiceDate invoice date as a DateTime object or string (or null to load the current time)
     * @throws \InvalidArgumentException if $newCheckbookInvoiceDate is not a valid object or string
     * @throws \RangeException if $newCheckbookInvoiceDate is a date that does not exist
     **/
    public function setCheckbookInvoiceDate($newCheckbookInvoiceDate = null) {
        // base case: if the date is null, use the current date and time
        if($newCheckbookInvoiceDate === null) {
            $this->checkbookInvoiceDate = new \DateTime();
            return;
        }
        // store invoice date
        try {
            $newCheckbookInvoiceDate = self::validateDateTime($newCheckbookInvoiceDate);
        } catch(\InvalidArgumentException $invalidArgument) {
            throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
        } catch(\RangeException $range) {
            throw(new \RangeException($range->getMessage(), 0, $range));
        }
        $this->checkbookInvoiceDate =$newCheckbookInvoiceDate;
    }
    /**
     * accessor method for Invoice Number
     * @return string value of invoice number
     **/
    public function getCheckbookInvoiceNum() {
        return ($this->checkbookInvoiceNum);
    }
    /**
     * mutator method for invoice number
     * @param string $newCheckbookInvoiceNum
     * @throws \InvalidArgumentException if $newCheckbookInvoiceNum is not a string or insecure
     * @throws \RangeException if $newCheckbookInvoiceNum is to long > 62
     * @throws \TypeError if $newCheckbookInvoiceNum
     **/
    public function setCheckbookInvoiceNum(string $newCheckbookInvoiceNum) {
        //** verify invoice number is secure */
        $newCheckbookInvoiceNum = filter_var($newCheckbookInvoiceNum, FILTER_SANITIZE_STRING);
        if (empty($newCheckbookInvoiceNum) === true) {
            throw(new \InvalidArgumentException("invoice number is empty or insecure"));
        }
        //** verify invoice number will fit in the database */
        if(strlen($newCheckbookInvoiceNum) > 62) {
            throw(new \RangeException("invoice number is to long"));
        }
        /** store the Invoice number in database */
        $this->checkbookInvoiceNum = $newCheckbookInvoiceNum;
    }
    /**
     * accessor method for checkbook payment date
     *
     * @return \DateTime value of payment date
     **/
    public function getCheckbookPaymentDate() {
        return($this->checkbookPaymentDate);
    }
    /**
     * mutator method for payment date
     *
     * @param \DateTime|string|null $newCheckbookPaymentDate payment date as a DateTime object or string (or null to load the current time)
     * @throws \InvalidArgumentException if $newCheckbookPaymentDate payment date as a DateTime object or string
     * @throws \RangeException if $newCheckbookPaymentDate is a date that does not exist
     **/
    public function setCheckbookPaymentDate($newCheckbookPaymentDate = null) {
        // base case: if the date is null, use the current date and time
        if($newCheckbookPaymentDate === null) {
            $this->checkbookPaymentDate = new \DateTime();
            return;
        }
        // store the Payment Date
        try{
            $newCheckbookPaymentDate = self ::validateDateTime($newCheckbookPaymentDate);
        } catch(\InvalidArgumentException $invalidArgument){
            throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
        } catch(\RangeException $range) {
            throw(new \RangeException($range->getMessage(), 0, $range));
        }
        $this->checkbookPaymentDate = $newCheckbookPaymentDate;
    }
    /**
     * accessor method for Reference Number
     * @return string of Reference number content
     **/
    public function getCheckbookReferenceNum() {
        return ($this->checkbookReferenceNum);
    }
    /** mutator method for reference number
     * @param string $newCheckbookReferenceNum
     * @throws \InvalidArgumentException if $newCheckbookReferenceNum is insecure
     * @throws \RangeException if $newCheckbookReferenceNum is > 42
     * @throws \TypeError if $newCheckbookReferenceNum is not a string
     */
    public function setCheckbookReferenceNum (string $newCheckbookReferenceNum) {
        //** verify the reference number is secure */
        $newCheckbookReferenceNum = filter_var($newCheckbookReferenceNum, FILTER_SANITIZE_STRING);
        if(empty($newCheckbookReferenceNum) === true){
            throw(new \InvalidArgumentException("Reference number is empty or insecure"));
        }
        /** verify the Reference number will fit in the database **/
        if (strlen($newCheckbookReferenceNum) > 42){
            throw(new \RangeException("Reference number is to long"));
        }
        /** store reference number */
        $this->checkbookReferenceNum = $newCheckbookReferenceNum;
    }
    /**
     * accessor method for Vendor content
     * @return string value of vendor content
     **/
    public function getCheckbookVendor() {
        return ($this->checkbookVendor);
    }
    /**
     * mutator method for vendor content
     * @param string $newCheckbookVendor
     * @throws \InvalidArgumentException if $newCheckbookVendor is not a string or insecure
     * @throws \RangeException if $newCheckbookVendor is not a to long
     * @throws \TypeError if $newCheckbookVendor is not a string
     **/
    public function setCheckbookVendor(string $newCheckbookVendor) {
        /**verify vendor is secure */
        $newCheckbookVendor = filter_var($newCheckbookVendor, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        if(empty($newCheckbookVendor) === true) {
            throw(new \InvalidArgumentException("vendor content is empty or insecure"));
        }
        /**store the vendor cotent**/
        $this->checkbookVendor = $newCheckbookVendor;
    }
    /**
     * inserts this checkbook into mySQL
     *
     * @param \PDO $pdo PDO connection object
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError if $pdo is not a PDO connection object
     **/
    public function insert(\PDO $pdo) {
        // enforce the checkbookId is null (i.e., dont insert a checkbook that already exists)
        if($this->checkbookId !==null) {
            throw(new \PDOException("not a new checkbook"));
        }

        // create query template
        $query = "Insert INTO checkbook(checkbookId, checkbookInvoiceAmount, checkbookInvoiceDate, checkbookInvoiceNum, checkbookPaymentDate, checkbookReferenceNum, checkbookVendor) VALUES(:checkbookId, :checkbookInvoiceAmount, :checkbookInvoiceDate, :checkbookInvoiceNum, :checkbookPaymentDate, :checkbookReferenceNum, :checkbookVendor)";
        $statement = $pdo->prepare($query);

        //bind the member variables to the place holders in the template
        $formattedDate1 = $this->checkbookInvoiceDate->format("Y-m-d H:i:s");
        $formattedDate2 = $this->checkbookPaymentDate->format("Y-m-d H:i:s");
        $parameters = ["checkbookId" => $this->checkbookId, "checkbookInvoiceAmount" => $this->checkbookInvoiceAmount, "checkbookInvoiceDate" => $formattedDate1, "checkbookInvoiceNum" => $this->checkbookInvoiceNum, "checkbookPaymentDate" => $formattedDate2, "checkbookReferenceNum" => $this->checkbookReferenceNum, "checkbookVendor" => $this->checkbookVendor];
        $statement->execute($parameters);
        // update the null checkbookId with what mySQL just gave us
        $this->checkbookId = intval($pdo->lastInsertId());
    }

    /**
     * gets the checkbook by checkbookId
     *
     * @param \PDO $pdo PDO connection object
     * @param int $checkbookId checkbook id to search for
     * @return Checkbook|null Checkbook found or null if not found
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError when variables are not the correct data type
     **/
    public static function getCheckbookByCheckbookId(\PDO $pdo, int $checkbookId) {
        // sanitize the checkbookId before searching
        if($checkbookId <= 0) {
            throw(new \PDOException("checkbook id is not positive"));
        }
        // create query template
        $query = "SELECT checkbookId, checkbookInoiceAmount, checkbookInvoiceDate, checkbookInvoiceDate, checkbookInvoiceNum, checkbookPaymentDate, checkbookReferenceNum, checkbookVendor FROM checkbook WHERE checkbookId = :checkbookId";
        $statement = $pdo->prepare($query);
        // bind the checkbook id to the place holder in the template
        $parameters = ["checkbookId" => $checkbookId];
        $statement->execute($parameters);
        // grab the checkbook from mySQL
        try{
            $checkbookId = null;
            $statement->setFetchMode(\PDO::FETCH_ASSOC);
            $row = $statement->fetch();
            if($row !==false) {
                $checkbookId = new Checkbook($row["checkbookId"], $row["checkbookInvoiceAmount"], $row["checkbookInvoiceDate"], $row["checkbookInvoiceNum"], $row["checkbookPaymentDate"], $row["checkbookReferenceNum"], $row["checkbookVendor"]);
            }
        } catch(\Exception $exception) {
            // if the row couldn't be converted, rethrow it
            throw(new \PDOException($exception->getMessage(), 0, $exception));
        }
        return($checkbookId);
    }

    /**
     * gets the checkbook by Invoice Amount
     *
     * @param \PDO $pdo PDO connection object
     * @param float $checkbookInvoiceAmount invoice amount to search for
     * @return \SplFixedArray SplFixedArray of Checkbook found
     * @throws \PDOException whe mySQL related errors occur
     * @throws \TypeError when variables are not the correct data type
     **/
    public static function getCheckbookByCheckbookInvoiceAmount(\PDO $pdo, float $checkbookInvoiceAmount) {
        // sanitize the description before searching
        $checkbookInvoiceAmount = trim($checkbookInvoiceAmount);
        if(empty($checkbookInvoiceAmount) === true) {
            throw(new \PDOException("Invoice amount is invalid"));
        }
        // create query template
        $query = "SELECT checkbookId, checkbookInvoiceAmount, checkbookInvoiceDate, checkbookInvoiceNum, checkbookPaymentDate, checkbookReferenceNum, checkbookVendor FROM checkbook WHERE checkbookInvoiceAmount = :checkbookInvoiceAmount";
        $statement = $pdo->prepare($query);

        // bind the checkbook invoice amount to the place holder in the template
        $checkbookInvoiceAmount = "%checkbookInvoiceAmount%";
        $parameters = ["checkbookInvoiceAmount" => $checkbookInvoiceAmount];
        $statement->execute($parameters);

        // build an array of checkbooks
        $checkbooks = new \SplFixedArray($statement->rowCount());
        $statement->setFetchMode(\PDO::FETCH_ASSOC);
        while(($row = $statement->fetch() !== false)) {
            try {
                $checkbook = new Checkbook($row["checkbookId"], $row["checkbookInvoiceAmount"], $row["checkbookInvoiceDate"], $row["checkbookInvoiceNum"], $row["checkbookPaymentDate"], $row["checkbookReferenceNum"], $row["checkbookVendor"]);
                $checkbooks[$checkbooks->key()] = $checkbook;
                $checkbooks->next();
            } catch(\Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new \PDOException($exception->getMessage(), 0, $exception));
            }
        }
        return($checkbooks);
    }

    /**
     * gets the checkbook by Invoice Date
     *
     * @param \PDO connection object
     * @param \DateTime $checkbookInvoiceSunriseDate
     * @param \DateTime $checkbookInvoiceSunsetDate
     * @return \SplFixedArray SplFixedArray of checkbooks found
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError when variables are not the correct data type
     **/
    public static function getCheckbookByCheckbookInvoiceDate(\PDO $pdo, $checkbookInvoiceSunriseDate, $checkbookInvoiceSunsetDate) {
        // one doesn't simply use dates without using ValidateDate

        // I don't always write WHERE clauses, but when I do, reformat dates and use an AND operator

        // just shutup and take my prepared statement
        $checkbookInvoiceSunriseDate = date_sunrise($checkbookInvoiceSunriseDate);
        $checkbookInvoiceSunsetDate = date_sunset($checkbookInvoiceSunsetDate);
        if(empty($checkbookInvoiceSunriseDate) === true) {
            throw(new \PDOException("InvoiceSunrise date is invalid"));
        }
        if(empty($checkbookInvoiceSunsetDate) === true) {
            throw(new \PDOException("InvoiceSunset date is invalid"));
        }
        // create query template
        $query = "SELECT checkbookId, checkbookInvoiceAmount, checkbookInvoiceDate, checkbookInvoiceNum, checkbookPaymentDate, checkbookReferenceNum, checkbookVendor FROM checkbook WHERE checkbookInvoiceDate >= :checkbookInvoiceSunriseDate AND <= :checkbookInvoiceSunsetDate";
        $statement = $pdo->prepare($query);

        // bind the checkbook invoice date to the place holder in the template
        $parameters = ["checkbookInvoiceSunriseDate" => $checkbookInvoiceSunriseDate, "checkbookInvoiceSunsetDate" => $checkbookInvoiceSunsetDate];
        $statement->execute($parameters);

        // build an array of invoice dates

        $datetime = new \SplFixedArray($statement->rowCount());
        $statement->setFetchMode(\PDO::FETCH_ASSOC);
        while(($row = $statement->fetch()) !== false) {
            try {
                $checkbookInvoiceSunriseDate = self::validateDate($checkbookInvoiceSunriseDate);
                $checkbookInvoiceSunsetDate = self::validateDate($checkbookInvoiceSunsetDate);
                $datetime = new \DateTime($row["checkbookId"],  $row["checkbookInvoiceAmount"], $row["checkbookInvoiceDate"], $row["checkbookInvoiceNum"], $row["checkbookPaymentDate"], $row["checkbookReferenceNum"], $row["checkbookVendor"]);
                $datetime[$datetime->key()] = $datetime;
                $datetime->next();
            } catch(\Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new \PDOexception($exception->getMessage(), 0, $exception));
            }
        }
        return($datetime);
    }
    /**
     * gets the checkbook by Invoice Number
     *
     *@param \PDO $pdo PDO connection object
     *@param string $checkbookInvoiceNum checkbook content to search for
     *@return \SplFixedArray SplFixedArray of checkbooks found
     *@throws \PDOException when mySQL related errors occur
     *@throws \TypeError whe variables are not the correct data type
     **/
    public static function getCheckbookByCheckbookInvoiceNum(\PDO $pdo, string $checkbookInvoiceNum) {
        // sanitize the description before searching
        $checkbookInvoiceNum = trim($checkbookInvoiceNum);
        $checkbookInvoiceNum = filter_var($checkbookInvoiceNum, FILTER_SANITIZE_STRING);
        if(empty($checkbookInvoiceNum) === true) {
            throw(new \PDOException("Invoice Number is invalid"));
        }

        // create query template
        $query = "SELECT checkbookId, checkbookInvoiceAmount, checkbookInvoiceDate, checkbookInvoiceNum, checkbookPaymentDate, checkbookReferenceNum, checkbookVendor FROM checkbook WHERE checkbookInvoiceNum = :checkbookInvoiceNum";
        $statement = $pdo->prepare($query);

        // bind the checkbook invoice number to the place holder in the template
        $checkbookInvoiceNum = "%checkbookInvoiceNum%";
        $parameters = ["checkbookInvoiceNum" => $checkbookInvoiceNum];
        $statement->execute($parameters);

        // build an array of checkbooks
        $checkbooks = new \SplFixedArray($statement->rowCount());
        $statement->setFetchMode(\PDO::FETCH_ASSOC);
        while(($row = $statement->fetch()) !==false) {
            try {
                $checkbook = new Checkbook($row["checkbookId"], $row["checkbookInvoiceAmount"], $row["checkbookInvoiceDate"], $row["checkbookInvoiceNum"], $row["checkbookPaymentDate"], $row["checkbookReferenceNum"], $row["checkbookVendor"]);
                $checkbooks[$checkbooks->key()] = $checkbook;
                $checkbooks->next();
            } catch(\Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new \PDOException($exception->getMessage(), 0, $exception));
            }
        }
        return($checkbooks);
    }
    /**
     * gets the checkbook by Payment Date
     *
     * @param \PDO connection object
     * @param \DateTime $checkbookPaymentSunriseDate
     * @param \DateTime $checkbookPaymentSunsetDate
     * @return \SplFixedArray SplFixedArray of checkbooks found
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError when variables are not the correct data type
     **/
    public static function getCheckbookByCheckbookPaymentDate(\PDO $pdo, $checkbookPaymentSunriseDate, $checkbookPaymentSunsetDate) {
        // continuation of trying the sunrise and sunset
        $checkbookPaymentSunriseDate = date_sunrise($checkbookPaymentSunriseDate);
        $checkbookPaymentSunsetDate = date_sunset($checkbookPaymentSunsetDate);
        if(empty($checkbookPaymentSunriseDate) === true) {
            throw(new \PDOException("PaymentSunrise date is invalid"));
        }
        if(empty($checkbookPaymentSunsetDate) === true) {
            throw(new \PDOException("PaymentSunset date is invalid"));
        }
        // create query template
        $query = "SELECT checkbookId, checkbookInvoiceAmount, checkbookInvoiceDate, checkbookInvoiceNum, checkbookPaymentDate, checkbookReferenceNum, checkbookVendor FROM checkbook WHERE checkbookPaymentDate >= :checkbookPaymentSunriseDate AND <= :checkbookPaymentSunsetDate";
        $statement = $pdo->prepare($query);

        // bind the checkbook invoice date to the placeholder in the template
        $parameters = ["checkbookPaymentSunriseDate" => $checkbookPaymentSunriseDate, "checkbookPaymentSunsetDate" => $checkbookPaymentSunsetDate];
        $statement->execute($parameters);

        // build an array of invoice dates

        $datetime = new \SplFixedArray($statement->rowCount());
        $statement->setFetchMode(\PDO::FETCH_ASSOC);
        while(($row = $statement->fetch()) !== false) {
            try {
                $checkbookPaymentSunriseDate = self::validateDate($checkbookPaymentSunriseDate);
                $checkbookPaymentSunsetDate = self::validateDate($checkbookPaymentSunsetDate);
                $datetime = new \DateTime($row["checkbookId"],  $row["checkbookInvoiceAmount"], $row["checkbookInvoiceDate"], $row["checkbookInvoiceNum"], $row["checkbookPaymentDate"], $row["checkbookReferenceNum"], $row["checkbookVendor"]);
                $datetime[$datetime->key()] = $datetime;
                $datetime->next();
            } catch(\Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new \PDOexception($exception->getMessage(), 0, $exception));
            }
        }
        return($datetime);
    }
    /**
     * @param \PDO $pdo PDO connection object
     * @param string $checkbookReferenceNum reference number to search for
     * @return \SplFixedArray SplFixedArray of checkbook found
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError when variables are not the correct data type
     **/
    public static function getCheckbookByCheckbookReferenceNum(\PDO $pdo, string $checkbookReferenceNum) {
        // sanitize the description before searching
        $checkbookReferenceNum = trim($checkbookReferenceNum);
        $checkbookReferenceNum = filter_var($checkbookReferenceNum, FILTER_SANITIZE_STRING);
        if(empty($checkbookReferenceNum) === true) {
            throw(new \PDOException("Reference Number is invalid"));
        }

        // create query template
        $query = "SELECT checkbookId, checkbookInvoiceAmount, checkbookInvoiceDate, checkbookInvoiceNum, checkbookPaymentDate, checkbookReferenceNum, checkbookVendor FROM checkbook WHERE checkbookReferenceNum = :checkbookReferenceNum";
        $statement = $pdo->prepate($query);

        // bind the checkbook Reference Number to the place holder in the template
        $checkbookReferenceNum = "%$checkbookReferenceNum%";
        $parameters = ["checkbookReferenceNum" => $checkbookReferenceNum];
        $statement->execute($parameters);

        // build an array of reference numbers
        $checkbookReferenceNum = new \SplFixedArray($statement->rowCount());
        $statement->setFetchMode(\PDO::FETCH_ASSOC);
        while(($row = $statement->fetch()) !== false) {
            try {
                $checkbooks = new Checkbook($row["checkbookId"], $row["checkbookInvoiceAmount"], $row["checkbookInvoiceDate"], $row["checkbookInvoiceNum"], $row["checkbookPaymentDate"], $row["checkbookReferenceNum"], $row["checkbookVendor"]);
                $checkbooks[$checkbooks->key()] = $checkbookReferenceNum;
                $checkbooks->next();
            } catch(\Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new \PDOException($exception->getMessage(), 0, $exception));
            }
        }
        return($checkbooks);
    }
    /**
     * gets the checkbook by vendor
     *
     * @param \PDO $pdo PDO connection object
     * @param string $checkbookVendor checkbook content to search for
     * @return \SplFixedArray SplFixedArray of Vendors found
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError when variables are not the correct data type
     **/
    public static function getCheckbookByCheckbookVendor(\PDO $pdo, string $checkbookVendor) {
       // sanitize the description before searching
        $checkbookVendor = trim($checkbookVendor);
        $checkbookVendor = filter_var($checkbookVendor, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        if(empty($checkbookVendor) === true) {
            throw(new \PDOException("Vendor content is invalid"));
        }

        // create query template
        $query = "SELECT checkbookId, checkbookInvoiceAmount, checkbookInvoiceDate, checkbookInvoiceNum, checkbookPaymentDate, checkbookReferenceNum, checkbookVendor FROM checkbook WHERE checkbookVendor = :checkbookVendor";
        $statement = $pdo->prepare($query);

        // bind the vendor content to the place holder int he template
        $checkbookVendor
            = "%checkbookVendor%";
        $parameters = ["checkbookVendor" => $checkbookVendor];
        $checkbookVendor->execute($checkbookVendor);

        // build an array of vendors
        $checkbookVendor = new \SplFixedArray($statement->rowCount());
        $statement->setFetchMode(\PDO::FETCH_ASOC);
        while(($row = $statement->fetch()) !== false) {
            try{
                $checkbookVendor = new Checkbook($row["checkbookId"],  $row["checkbookInvoiceAmount"], $row["checkbookInvoiceDate"], $row["checkbookInvoiceNum"], $row["checkbookPaymentDate"], $row["checkbookReferenceNum"], $row["checkbookVendor"]);
                $checkbookVendor[$checkbookVendor->key()] = $checkbookVendor;
            } catch(\Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new \PDOException($exception->getMessage(), 0, $exception));
            }
        }
        return($checkbookVendor);
    }
    /**
     * gets all of checkbooks
     *
     * @param \PDO $pdo PDO connection object
     * @return \SplFixedArray SplFixedArray
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError when variables are not the correct data type
     **/
    public static function getAllCheckbookIds(\PDO $pdo) {
        // create query template
        $query = "SELECT checkbookId, checkbookInvoiceAmount, checkbookInvoiceDate, checkbookInvoiceNum, checkbookPaymentDate, checkbookReferenceNum, checkbookVendor FROM checkbook";
        $statement = $pdo->prepare($query);
        $statement->execute();

        // build an array of checkbooks
        $checkbook = new \SplFixedArray($statement->rowCount());
        $statement->setFetchMode(\PDO::FETCH_ASSOC);
        while (($row = $statement->fetch()) !== false) {
            try {
                $checkbook = new Checkbook($row["checkbookId"], $row["checkbookInvoiceAmount"], $row["checkbookInvoiceDate"], $row["checkbookInvoiceNum"], $row["checkbookPaymentDate"], $row["checkbookReferenceNum"], $row["checkbookVendor"]);
                $checkbook[$checkbook->key()] = $checkbook;
                $checkbook->next();
            } catch (\Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new \PDOException($exception->getMessage(), 0, $exception));
            }
        }
        return ($checkbook);
    }

    /**
     * formats the state variables for JSON serialization
     *
     * @return array resulting state variables to serialize
     **/
    public function jsonSErialize() {
        $fields = get_object_vars($this);
        $fields["checkbookInvoiceDate"] = $this->checkbookInvoiceDate->getTimestamp() *1000;
        $fields["checkbookPaymentDate"] = $this->checkbookPaymentDate->getTimestamp() *1000;
        return($fields);
}
}