<?php
namespace Edu\Cnm\AbqVast\Test;

use Edu\Cnm\AbqVast\{Checkbook};

// grab the project test parameters
require_once("AbqVastTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

/**
 * Full PHPUnit test for the checkbook class
 *
 * This is a complete PHPUnit test of the Checkbook class. it is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs
 *
 * @see Checkbook
 * @author Valente Meza <vmeza3@cnm.edu>
 **/
class CheckbookTest extends AbqVastTest {
    /**
     * Invoice Amount of the Checkbook
     * @var string $VALID_CHECKBOOKINVOICEAMOUNT
     **/
    protected $VALID_CHECKBOOKINVOICEAMOUNT = "PHPUnit test passing";
    /**
     * timestamp of the checkbook; this starts as null and is assigned later
     * @var DateTime $VALID_CHECKBOOKINVOICEDATE
     **/
    protected $VALID_CHECKBOOKINVOICEDATE = null;
    /**
     *  Invoice Number of the Checkbook
     * @var string $VALID_CHECKBOOKINVOICENUM
     **/
    protected $VALID_CHECKBOOKINVOICENUM = "PHPUnit test passing";
    /**
     * timestamp of the checkbook; this starts as null and is assigned later
     * @var DateTime $VALID_CHECKBOOKPAYMENTDATE
     **/
    protected $VALID_CHECKBOOKPAYMENTDATE = null;
    /**
     * Payment Date of the checkbook
     * @var string $VALID_REFERENCENUM
     **/
    protected $VALID_CHECKBOOOKREFERENCENUM = "PHPUnit test passing";
    /**
     * Vendor of the checkbook
     * @var string $VALID_CHECKBOOKVENDOR
     **/
    protected $VALID_CHECKBOOKVENDOR = "PHPUnit test passing";
    /**
     * Id that created the checkbook; this is for the primary key relations
     * @var CheckbookId checkbook
     **/
    protected $checkbookId = null;
    /**
     * create dependent objects before running each test
     **/
    public final function setUp() {
        // run the default setUp() method first
        parent::setUp();
        // create and insert a CheckbookId to own the test Checkbook
        $this->checkbookId = new Checkbook(null, "@phpunit", "test@phpunit.de");
        $this->checkbookId->insert($this->getPDO());
        // calculate the date (just use the time the unit test was setup...)
        $this->VALID_CHECKBOOKINVOICEDATE = new \DateTime();
        $this->VALID_CHECKBOOKPAYMENTDATE = new \DateTime();
    }
    /**
     * test inserting a valid Checkbook and verify that the actual mySQL data matches
     **/
    public function testInsertValidCheckbook() {
        // count the number of rows and save it for later
        $numRows = $this->getConnection()->getRowCount("checkbook");

        // create a new Checkbook and insert into mySQL
        $checkbook = new Checkbook(null, $this->checkbookId->getCheckbookId(), $this->VALID_CHECKBOOKINVOICEAMOUNT, $this->VALID_CHECKBOOKINVOICEDATE, $this->VALID_CHECKBOOKINVOICENUM, $this->VALID_CHECKBOOKPAYMENTDATE, $this->VALID_CHECKBOOOKREFERENCENUM, $this->VALID_CHECKBOOKVENDOR);
        $checkbook->insert($this->getPDO());

        // grab the data from mySQL and enforce the fields match our expectations
        $pdoCheckbook = Checkbook::getCheckbookByCheckbookId($this->getPDO(), $checkbook->getCheckbookId());
        $this->assertEquals($numRows + 1, $this->getConnection()->getConnection()->getRowCount("checkbook"));
        $this->assertEquals($pdoCheckbook->getCheckbookId(), $this->checkbook->getCheckbookId());
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceAmount(), $this->checkbook->getCheckbookInvoiceAmount());
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceDate(), $this->VALIDCHECKBOOKINVOICEDATE);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoicNum(), $this->checkbook->getCheckbookInvoiceNum());
        $this->assertEquals($pdoCheckbook->getCheckbookPaymentDate(), $this->VALIDCHECKBOOKPAYMENTDATE);
        $this->assertEquals($pdoCheckbook->getCheckbookReferenceNum(), $this->checkbook->getCheckbookReferenceNum);
        $this->assertEquals($pdoCheckbook->getCheckbookVendor(), $this->checkbook->getCheckbookVendor);
    }
    /**
     * test inserting a Checkbook that already exists
     *
     * @expectedException
     **/
    public function testInsertInvalidCheckbook(){
        // create a Checkbook with a non null checkbook id and watch it fail
        $checkbook = new Checkbook(CheckbookTest::INVALID_KEY, $this->checkbookId->checkbookId(), $this->VALID_CHECKBOOKINVOICEAMOUNT, $this->VALID_CHECKBOOKINVOICEDATE, $this->VALID_CHECKBOOKINVOICENUM, $this->VALID_CHECKBOOKPAYMENTDATE, $this->VALID_CHECKBOOOKREFERENCENUM, $this->VALID_CHECKBOOKVENDOR);
        $checkbook->insert($this->getPDO());
    }
    /**
     * test grabbing a Checkbook by checkbook Invoice Amount
     **/
    public function testGetValidCheckbookByCheckbookInvoiceAmount() {
        // count the number of rows and save it for later
        $numRows = $this->getConnection()->getRowcount("checkbook");

        // create a new Checkbook and insert it into mySQL
        $checkbook = new Checkbook(null, $this->checkbookId->getCheckbookId(), $this->VALID_CHECKBOOKINVOICEAMOUNT, $this->VALID_CHECKBOOKINVOICEDATE, $this->VALID_CHECKBOOKINVOICENUM, $this->VALID_CHECKBOOKPAYMENTDATE, $this->VALID_CHECKBOOOKREFERENCENUM, $this->VALID_CHECKBOOKVENDOR);
        $checkbook->insert($this->getPDO());
        // grab the data from mySQL and enforce the fields match our expectations
        $pdoCheckbook = Checkbook::getCheckbookByCheckbookId($this->getPDO(), $checkbook->getCheckbookId());
        $this->assertEquals($numRows + 1, $this->getConnection()->getConnection()->getRowCount("checkbook"));
        $this->assertEquals($pdoCheckbook->getCheckbookId(), $this->checkbook->getCheckbookId());
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceAmount(), $this->checkbook->getCheckbookInvoiceAmount());
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceDate(), $this->VALIDCHECKBOOKINVOICEDATE);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoicNum(), $this->checkbook->getCheckbookInvoiceNum());
        $this->assertEquals($pdoCheckbook->getCheckbookPaymentDate(), $this->VALIDCHECKBOOKPAYMENTDATE);
        $this->assertEquals($pdoCheckbook->getCheckbookReferenceNum(), $this->checkbook->getCheckbookReferenceNum);
        $this->assertEquals($pdoCheckbook->getCheckbookVendor(), $this->checkbook->getCheckbookVendor);
    }
}