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
     * @throws \RangeException if data values are out of bounds (to long, negarive integers
     * @throw \TypeError if data types violate type
     **/
    public function __construct(int $newCheckbookId = null, string $newCheckbookVendor, string $newCheckbookReferenceNum, string $newCheckbookInvoiceNum, string $newCheckbookInvoiceDate, string $newCheckbookPaymentDate, string $newCheckbookInvoiceAmount) {
        try{
            $this->setCheckbookId($newCheckbookId);
            $this->setChechbookVendor($newCheckbookVendor);
            $this->setCheckbookReferenceNum($newCheckbookReferenceNum);
            $this->setCheckbookInvoiceNum($newCheckbookInvoiceNum);
            $this->setCheckbookInvoiceDate($newCheckbookInvoiceDate);
            $this->setChechbookPaymentDate($newCheckbookPaymentDate);
            $this->setCheckbookInvoiceAmount($newCheckbookInvoiceAmount);
        } catch (\InvalidArgumentException $invalidArgument) {
            //** rethrow the exception to the caller */
            throw(new\InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
        }
    }
}