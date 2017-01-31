<?php
namespace Edu\cnm\vmeza3\DataDesign;

/**
 *checkbook class
 *this will be the class for checkbook
 *@author Valente Meza <vmeza3@cnm.edu>
 *@version 3.2.0*/

class Checkbook implements \JsonSerializable {
    /**
    id for checkbook; this is the primary key
    @var int $checkbookId
     */
    private $checkbookId;
    /**
     *Vendor for checkbook
     */
    private $checkbookVendor;
    /**
     *Reference Number for checkbook
     */
    private $checkbookReferenceNum;
    /**
     *Invoice number for checkbook
     */
    private $checkbookInvoiceNum;
    /**
     *Invoice Date for checkbook
     */
    private $checkbookInvoiceDate;
    /**
     *Payment Date for checkbook
     */
    private $checkbookPaymenDate;
    /**
     * Invoice amount for checkbook
     */
    private $checkbookInvoiceAmount;

    /**
     * constructor for this checkbook
     * @param int $newCheckbookId id of this checkbook
     * @param string $newcheckbookVendor vendor name on checkbook
     * @param string $newCheckbookReferenceNum reference number for this checkbook
     * @param string $newCheckbookInvoiceNum invoice number for this checkbook
     * @param string $newCheckbookInvoiceDate invoice date for this checkbook
     * @param string $newCheckbookPaymentDate payment date for this checkbook
     * @param string $newCheckbookInvoiceAmount invoice amount for this checkbook
     * @throws \InvalidArgumentException if data types are not valid
     * @throws \RangeException if data values are out of bounds (to long, negative integers)
     * @throw \TypeError if data types violate type
     * @throw \Exception if some other exception occurs
     **/
    public function __construct(int $newCheckbookId = null, string $newCheckbookVendor, string $newCheckbookReferenceNum, string $newCheckbookInvoiceNum, string $newCheckbookInvoiceDate, string $newCheckbookPaymentDate, string $newCheckbookInvoiceAmount) {
        try{
            $this->setCheckbookId($newCheckbookId);
            $this->setCheckbookVendor($newCheckbookVendor);
            $this->setCheckbookReferenceNum($newCheckbookReferenceNum);
            $this->setCheckbookInvoiceNum($newCheckbookInvoiceNum);
            $this->setCheckbookInvoiceDate($newCheckbookInvoiceDate);
            $this->setChechbookPaymentDate($newCheckbookPaymentDate);
            $this->setCheckbookInvoiceAmount($newCheckbookInvoiceAmount);
        } catch (\InvalidArgumentException $invalidArgument) {
            //** rethrow the exception to the caller */
            throw(new\InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
        } catch(\RangeException $range){
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
}