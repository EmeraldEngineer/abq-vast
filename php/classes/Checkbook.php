<?php
/**
 * checkbook class'
 * this will be the class checkbook attributes and entities.
 * @author Valente Meza <vmeza3@cnm.edu>
 * @version 3.2.0
 */

class Checkbook implements \JsonSerializable {
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
     * @param string $newCheckbookInvoiceDate invoice date for this checkbook
     * @param string $newCheckbookInvoiceNum invoice number for this checkbook
     * @param string $newCheckbookPaymentDate payment date for this checkbook
     * @param string $newCheckbookReferenceNum reference number for this checkbook
     * @param string $newcheckbookVendor vendor name on checkbook
     * @throws \InvalidArgumentException if data types are not valid
     * @throws \RangeException if data values are out of bounds (to long, negative integers)
     * @throw \TypeError if data types violate type
     * @throw \Exception if some other exception occurs
     **/
    public function __construct(int $newCheckbookId = null, string $newCheckbookInvoiceAmount, string $newCheckbookInvoiceDate, string $newCheckbookInvoiceNum, string $newCheckbookPaymentDate, string $newCheckbookReferenceDate, string $newCheckbookVendor)
    {
        try{
            $this->setCheckbookId($newCheckbookId);
            $this->setCheckbookInvoiceAmount($newCheckbookInvoiceAmount);
            $this->setCheckbookInvoiceDate($newCheckbookInvoiceDate);
            $this->setCheckbookInvoiceNum($newCheckbookInvoiceNum);
            $this->setCheckbookPaymentDate($newCheckbookPaymentDate);
            $this->setCheckbookReferenceDate($newCheckbookReferenceDate);
            $this->setCheckbookVendor($newCheckbookVendor);
        } catch (\InvalidArgumentException $invalidArgument){
            //**rethrow the exception to the caller */
            throw(new\InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
        }  catch(\RangeException $range){
            //** rethrow the exception to the caller**/
            throw(new\RangeException($range->getMessage(), 0, $range));
        } catch (\TypeError $typeError) {
            //**rethrow the exception to the caller**//
            throw(new\TypeError($typeError));
        } catch (\Exception $exception) {
            throw(new\Exception($exception->getMessage(), 0, $exception));
        }
    }

    /** accessor method for checkbookId
     * @return int|null value of checkbook id
     **/
    public function getCheckbookId()
    {
        return ($this->checkbookId);
    }

    /**
     * mutator method for checkbook id
     * @param int $newCheckbookId new value of checkbook id
     * @throws \RangeException if $newCheckbookId is not positive
     * @throws \TypeError if $newCheckbookId is not an integer
     **/
    public function setCheckbookId(int $newCheckbookId = null){
        //**base case: if the checkbook is null
        if ($newCheckbookId ===null){
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
     * @return string value of invoice amount
     **/
    public function getCheckbookInvoiceAmount()
    {
        return($this->checkbookInvoiceAmount);
    }
    /**
     * mutator method for invoice amount
     * @param string $newCheckbookInvoiceAmount
     * @throws \InvalidArgumentException if $newCheckbookInvoiceAmount is not a string or a insecure
     * @throws \RangeException if $newCheckbookInvoiceAmount is not to long
     * @throws \TypeError if $newCheckbook is to long
     */
    public function setCheckbookInvoiceAmount( string $newCheckbookInvoiceAmount)
    {
        //**verify the invoice amount is secure */
        $newCheckbookInvoiceAmount = filter_var($newCheckbookInvoiceAmount, FILTER_SANITIZE_NUMBER_FLOAT);
        if(empty($newCheckbookInvoiceAmount) === true){
            throw(new \InvalidArgumentException("Invoice amount is empty or insecure"));
        }
        //** verify the invoice amount will fit in the data base */
        if (strlen($newCheckbookInvoiceAmount)){
            throw(new \RangeException("Invoice to lone"));
        }
        //** store invoice amount */
        $this->checkbookInvoiceAmount = $newCheckbookInvoiceAmount;
    }
    /**
     * accessor method for Invoice Date
     *
     * @return \DateTime value of invoice date
     **/
    public function getCheckbookInvoiceDate(){
        return($this->checkbookInvoiceDate);
    }
    /**
     * mutator method for invoice date
     *
     * @param \DateTime|string|null $newCheckbookInvoiceDate invoice date as a DateTime object or string (or null to load the current time)
     * @throws \InvalidArgumentException if $newCheckbookInvoiceDate is not a valid object or string
     * @throws \RangeException if $newCheckbookInvoiceDate is a date that does not exist
     **/
    public function setCheckbookInvoiceDate($newCheckbookInvoiceDate = null){
        // base case: if the date is null, use the current date and time
        if($newCheckbookInvoiceDate === null){
            $this->checkbookInvoiceDate = new \DateTime();
            return;
        }
        // store invoice date
        try {
            $newCheckbookInvoiceDate = self::validateDateTime($newCheckbookInvoiceDate);
        } catch(\InvalidArgumentException $invalidArgument){
            throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
        } catch(\RangeException $range){
            throw(new \RangeException($range->getMessage(), 0, $range));
        }
        $this->checkbookInvoiceDate =$newCheckbookInvoiceDate;
    }
    /**
     * accessor method for Invoice Number
     * @return string value of invoice number
     **/
    public function getCheckbookInvoiceNum()
    {
        return ($this->checkbookInvoiceNum);
    }
    /**
     * mutator method for invoice number
     * @param string $newCheckbookInvoiceNum
     * @throws \InvalidArgumentException if $newCheckbookInvoiceNum is not a string or insecure
     * @throws \RangeException if $newCheckbookInvoiceNum is to long > 62
     * @throws \TypeError if $newCheckbookInvoiceNum
     **/
    public function setCheckbookInvoiceNum(string $newCheckbookInvoiceNum){
        //** verify invoice number is secure */
        $newCheckbookInvoiceNum = filter_var($newCheckbookInvoiceNum, FILTER_SANITIZE_STRING);
        if (empty($newCheckbookInvoiceNum) === true){
            throw(new \InvalidArgumentException("invoice number is empty or insecure"));
        }
        //** verify invoice number will fit in the database */
        if(strlen($newCheckbookInvoiceNum) > 62){
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
    public function getCheckbookPaymentDate(){
        return($this->checkbookPaymentDate);
    }
    /**
     * mutator method for payment date
     *
     * @param \DateTime|string|null $newCheckbookPaymentDate payment date as a DateTime object or string (or null to load the current time)
     * @throws \InvalidArgumentException if $newCheckbookPaymentDate payment date as a DateTime object or string
     * @throws \RangeException if $newCheckbookPaymentDate is a date that does not exist
     **/
    public function setCheckbookPaymentDate($newCheckbookPaymentDate = null){
        // base case: if the date is null, use the current date and time
        if($newCheckbookPaymentDate === null){
            $this->checkbookPaymentDate = new \DateTime();
            return;
        }
        // store the Payment Date
        try{
            $newCheckbookPaymentDate = self ::validateDateTime($newCheckbookPaymentDate);
        } catch(\InvalidArgumentException $invalidArgument){
            throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
        } catch(\RangeException $range){
            throw(new \RangeException($range->getMessage(), 0, $range));
        }
        $this->checkbookPaymentDate = $newCheckbookPaymentDate;
    }
    /**
     * accessor method for Reference Number
     * @return string of Reference number content
     **/
    public function getCheckbookReferenceNum()
    {
        return ($this->checkbookReferenceNum);
    }
    /** mutator method for reference number
     * @param string $newCheckbookReferenceNum
     *@throws \InvalidArgumentException if $newCheckbookReferenceNum is insecure
     * @throws \RangeException if $newCheckbookReferenceNum is > 82
     * @throws \TypeError if $newCheckbookReferenceNum is not a string
     */
    public function setCheckbookReferenceNum (string $newCheckbookReferenceNum)
    {
        //** verify the reference number is secure */
        $newCheckbookReferenceNum = filter_var($newCheckbookReferenceNum, FILTER_SANITIZE_STRING);
        if(empty($newCheckbookReferenceNum) === true){
            throw(new \InvalidArgumentException("Reference number is empty or insecure"));
        }
        /** verify the Reference number will fit in the database **/
        if (strlen($newCheckbookReferenceNum) > 42) {
            throw(new \RangeException("Reference number is to long"));
        }
        /** store reference number */
        $this->checkbookReferenceNum = $newCheckbookReferenceNum;
    }
    /**
     * accessor method for Vendor content
     * @return string value of vendor content
     **/
    public function getCheckbookVendor()
    {
        return ($this->checkbookVendor);
    }
    /**
     * mutator method for vendor content
     * @param string $newCheckbookVendor
     * @throws \InvalidArgumentException if $newCheckbookVendor is not a string or insecure
     * @throws \RangeException if $newCheckbookVendor is not a to long
     * @throws \TypeError if $newCheckbookVendor is not a string
     **/
    public function setCheckbookVendor(string $newCheckbookVendor){
        /**verify vendor is secure */
        $newCheckbookVendor = filter_var($newCheckbookVendor, FILTER_SANITIZE_STRING);
        if(empty($newCheckbookVendor) === true) {
            throw(new \InvalidArgumentException("vendor content is empty or insecure"));
        }
        /**store the vendor cotent**/
        $this->checkbookVendor = $newCheckbookVendor;
    }
}