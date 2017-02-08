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
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceNum(), $this->checkbook->getCheckbookInvoiceNum());
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
        $results = Checkbook::getCheckbookByCheckbookId($this->getPDO(), $checkbook->getCheckbookInvoiceAmount());
        $this->assertEquals($numRows +1, $this->getconnection()->getRowCount("checkbook"));
        $this->assertCount(1, $results);
        $this->assertContainsOnlyInstancesOf("Edu\\Cnm\\AbqVast\\Checkbook", $results);

        // grab the result from the array and validate it
        $pdoCheckbook = $results[0];
        $this->assertEquals($pdoCheckbook->getCheckbookId(), $this->checkbook->getCheckbookId());
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceAmount(), $this->VALID_CHECKBOOKINVOICEAMOUNT);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceDate(), $this->VALID_CHECKBOOKINVOICEDATE);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceNum(), $this->VALID_CHECKBOOKINVOICENUM);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoicePaymentDate(), $this->VALID_CHECKBOOKPAYMENTDATE);
        $this->assertEquals($pdoCheckbook->getCheckbookReferenceNum(), $this->VALID_CHECKBOOOKREFERENCENUM);
        $this->assertEquals($pdoCheckbook->getCheckbookVendor(), $this->VALID_CHECKBOOKVENDOR);
    }

    /**
     * test grabbing a Checkbook by content that does not exist
     **/
    public function testGetInvalidCheckbookByCheckbookInvoiceAmount(){
        // grab a invoice amount by searching for content that does not exist
        $checkbook = Checkbook::getCheckbookByCheckbookInvoiceAmount($this->getPDO(), "you will find nothing");
        $this->assertCount(0, $checkbook);
    }
    /**
     * test grabbing Checkbook by checkbook Invoice Date
     **/
    public function testGetValidCheckbookByCheckbookInvoiceDate() {
        // count the number of rows and save it for later
        $numRows = $this->getConnection()->getRowCount("checkbook");

        // create a new Checkbook and insert it into mySQL
        $checkbook = new Checkbook(null, $this->checkbookId->getCheckbookId(), $this->VALID_CHECKBOOKINVOICEAMOUNT, $this->VALID_CHECKBOOKINVOICEDATE, $this->VALID_CHECKBOOKINVOICENUM, $this->VALID_CHECKBOOKPAYMENTDATE, $this->VALID_CHECKBOOOKREFERENCENUM, $this->VALID_CHECKBOOKVENDOR);
        $checkbook->insert($this->getPDO());

        // grab the data from mySQL and enforce the fields match our expectations
        $results = Checkbook::getCheckbookByCheckbookId($this->getPDO(), $checkbook->getCheckbookInvoiceDate());
        $this->assertEquals($numRows +1, $this->getConnection()->getRowCount("checkbook"));
        $this->asserCount(1, $results);
        $this->assertContainsOnlyInstancesOf("Edu\\Cnm\\AbqVast\\Checkbook", $results);

        // grab the result from the array and validate it
        $pdoCheckbook = $results[0];
        $this->assertEquals($pdoCheckbook->getCheckbookId(), $this->checkbook->getCheckbookId());
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceAmount(), $this->VALID_CHECKBOOKINVOICEAMOUNT);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceDate(), $this->VALID_CHECKBOOKINVOICEDATE);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceNum(), $this->VALID_CHECKBOOKINVOICENUM);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoicePaymentDate(), $this->VALID_CHECKBOOKPAYMENTDATE);
        $this->assertEquals($pdoCheckbook->getCheckbookReferenceNum(), $this->VALID_CHECKBOOOKREFERENCENUM);
        $this->assertEquals($pdoCheckbook->getCheckbookVendor(), $this->VALID_CHECKBOOKVENDOR);
    }

    /**
     * test grabbing a Checkbook by content that does not exist
     **/
    public function testGetInvalidCheckbookByCheckbookInvoiceDate() {
        // grab a invoice date by searching for content that does not exist
        $checkbook = Checkbook::getCheckbookByCheckbookInvoiceDate($this->getPDO(), "you will find nothing");
        $this->asserCount(0, $checkbook);
    }
    /**
     * test grabbing Checkbook by checkbook Invoice Number
     **/
    public function testGetValidCheckbookByCheckbookInvoiceNum() {
        // count the number of rows and save it for later
        $numRows = $this->getConnection()->getRowCount("checkbook");

        // create a new Checkbook and insert it into mySQL
        $checkbook = new Checkbook(null, $this->checkbookId->getCheckbookId(), $this->VALID_CHECKBOOKINVOICEAMOUNT, $this->VALID_CHECKBOOKINVOICEDATE, $this->VALID_CHECKBOOKINVOICENUM, $this->VALID_CHECKBOOKPAYMENTDATE, $this->VALID_CHECKBOOOKREFERENCENUM, $this->VALID_CHECKBOOKVENDOR);
        $checkbook->insert($this->getPDO());

        // grab the data from mySQL and enforce the fields match our expectations
        $results = Checkbook::getCheckbookByCheckbookId($this->getPDO(), $checkbook->getCheckbookInvoiceNum());
        $this->assertEquals($numRows +1, $this->getConnection()->getRowCount("checkbook"));
        $this->asserCount(1, $results);
        $this->assertContainsOnlyInstancesOf("Edu\\Cnm\\AbqVast\\Checkbook", $results);

        // grab the result from the array and validate it
        $pdoCheckbook = $results[0];
        $this->assertEquals($pdoCheckbook->getCheckbookId(), $this->checkbook->getCheckbookId());
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceAmount(), $this->VALID_CHECKBOOKINVOICEAMOUNT);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceDate(), $this->VALID_CHECKBOOKINVOICEDATE);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceNum(), $this->VALID_CHECKBOOKINVOICENUM);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoicePaymentDate(), $this->VALID_CHECKBOOKPAYMENTDATE);
        $this->assertEquals($pdoCheckbook->getCheckbookReferenceNum(), $this->VALID_CHECKBOOOKREFERENCENUM);
        $this->assertEquals($pdoCheckbook->getCheckbookVendor(), $this->VALID_CHECKBOOKVENDOR);
    }

    /**
     * test grabbing a Checkbook by content that does not exist
     **/
    public function testGetInvalidCheckbookByCheckbookInvoiceNum() {
        // grab a invoice date by searching for content that does not exist
        $checkbook = Checkbook::getCheckbookByCheckbookInvoiceNum($this->getPDO(), "you will find nothing");
        $this->asserCount(0, $checkbook);
    }
    /**
     * test grabbing Checkbook by checkbook Invoice Number
     **/
    public function testGetValidCheckbookByCheckbookPaymentDate() {
        // count the number of rows and save it for later
        $numRows = $this->getConnection()->getRowCount("checkbook");

        // create a new Checkbook and insert it into mySQL
        $checkbook = new Checkbook(null, $this->checkbookId->getCheckbookId(), $this->VALID_CHECKBOOKINVOICEAMOUNT, $this->VALID_CHECKBOOKINVOICEDATE, $this->VALID_CHECKBOOKINVOICENUM, $this->VALID_CHECKBOOKPAYMENTDATE, $this->VALID_CHECKBOOOKREFERENCENUM, $this->VALID_CHECKBOOKVENDOR);
        $checkbook->insert($this->getPDO());

        // grab the data from mySQL and enforce the fields match our expectations
        $results = Checkbook::getCheckbookByCheckbookId($this->getPDO(), $checkbook->getCheckbookPaymentDate());
        $this->assertEquals($numRows +1, $this->getConnection()->getRowCount("checkbook"));
        $this->asserCount(1, $results);
        $this->assertContainsOnlyInstancesOf("Edu\\Cnm\\AbqVast\\Checkbook", $results);

        // grab the result from the array and validate it
        $pdoCheckbook = $results[0];
        $this->assertEquals($pdoCheckbook->getCheckbookId(), $this->checkbook->getCheckbookId());
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceAmount(), $this->VALID_CHECKBOOKINVOICEAMOUNT);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceDate(), $this->VALID_CHECKBOOKINVOICEDATE);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceNum(), $this->VALID_CHECKBOOKINVOICENUM);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoicePaymentDate(), $this->VALID_CHECKBOOKPAYMENTDATE);
        $this->assertEquals($pdoCheckbook->getCheckbookReferenceNum(), $this->VALID_CHECKBOOOKREFERENCENUM);
        $this->assertEquals($pdoCheckbook->getCheckbookVendor(), $this->VALID_CHECKBOOKVENDOR);
    }

    /**
     * test grabbing a Checkbook by content that does not exist
     **/
    public function testGetInvalidCheckbookByCheckbookPaymentDate() {
        // grab a invoice date by searching for content that does not exist
        $checkbook = Checkbook::getCheckbookByCheckbookInvoiceNum($this->getPDO(), "you will find nothing");
        $this->asserCount(0, $checkbook);
    }
    /**
     * test grabbing Checkbook by checkbook Invoice Number
     **/
    public function testGetValidCheckbookByCheckbookReferenceNum() {
        // count the number of rows and save it for later
        $numRows = $this->getConnection()->getRowCount("checkbook");

        // create a new Checkbook and insert it into mySQL
        $checkbook = new Checkbook(null, $this->checkbookId->getCheckbookId(), $this->VALID_CHECKBOOKINVOICEAMOUNT, $this->VALID_CHECKBOOKINVOICEDATE, $this->VALID_CHECKBOOKINVOICENUM, $this->VALID_CHECKBOOKPAYMENTDATE, $this->VALID_CHECKBOOOKREFERENCENUM, $this->VALID_CHECKBOOKVENDOR);
        $checkbook->insert($this->getPDO());

        // grab the data from mySQL and enforce the fields match our expectations
        $results = Checkbook::getCheckbookByCheckbookId($this->getPDO(), $checkbook->getCheckbookReferenceNum());
        $this->assertEquals($numRows +1, $this->getConnection()->getRowCount("checkbook"));
        $this->asserCount(1, $results);
        $this->assertContainsOnlyInstancesOf("Edu\\Cnm\\AbqVast\\Checkbook", $results);

        // grab the result from the array and validate it
        $pdoCheckbook = $results[0];
        $this->assertEquals($pdoCheckbook->getCheckbookId(), $this->checkbook->getCheckbookId());
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceAmount(), $this->VALID_CHECKBOOKINVOICEAMOUNT);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceDate(), $this->VALID_CHECKBOOKINVOICEDATE);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceNum(), $this->VALID_CHECKBOOKINVOICENUM);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoicePaymentDate(), $this->VALID_CHECKBOOKPAYMENTDATE);
        $this->assertEquals($pdoCheckbook->getCheckbookReferenceNum(), $this->VALID_CHECKBOOOKREFERENCENUM);
        $this->assertEquals($pdoCheckbook->getCheckbookVendor(), $this->VALID_CHECKBOOKVENDOR);
    }

    /**
     * test grabbing a Checkbook by content that does not exist
     **/
    public function testGetInvalidCheckbookByCheckbookReferenceNum() {
        // grab a invoice date by searching for content that does not exist
        $checkbook = Checkbook::getCheckbookByCheckbookInvoiceNum($this->getPDO(), "you will find nothing");
        $this->asserCount(0, $checkbook);
    }
    /**
     * test grabbing Checkbook by checkbook Invoice Number
     **/
    public function testGetValidCheckbookByCheckbookVendor() {
        // count the number of rows and save it for later
        $numRows = $this->getConnection()->getRowCount("checkbook");

        // create a new Checkbook and insert it into mySQL
        $checkbook = new Checkbook(null, $this->checkbookId->getCheckbookId(), $this->VALID_CHECKBOOKINVOICEAMOUNT, $this->VALID_CHECKBOOKINVOICEDATE, $this->VALID_CHECKBOOKINVOICENUM, $this->VALID_CHECKBOOKPAYMENTDATE, $this->VALID_CHECKBOOOKREFERENCENUM, $this->VALID_CHECKBOOKVENDOR);
        $checkbook->insert($this->getPDO());

        // grab the data from mySQL and enforce the fields match our expectations
        $results = Checkbook::getCheckbookByCheckbookId($this->getPDO(), $checkbook->getCheckbookVendor());
        $this->assertEquals($numRows +1, $this->getConnection()->getRowCount("checkbook"));
        $this->asserCount(1, $results);
        $this->assertContainsOnlyInstancesOf("Edu\\Cnm\\AbqVast\\Checkbook", $results);

        // grab the result from the array and validate it
        $pdoCheckbook = $results[0];
        $this->assertEquals($pdoCheckbook->getCheckbookId(), $this->checkbook->getCheckbookId());
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceAmount(), $this->VALID_CHECKBOOKINVOICEAMOUNT);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceDate(), $this->VALID_CHECKBOOKINVOICEDATE);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceNum(), $this->VALID_CHECKBOOKINVOICENUM);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoicePaymentDate(), $this->VALID_CHECKBOOKPAYMENTDATE);
        $this->assertEquals($pdoCheckbook->getCheckbookReferenceNum(), $this->VALID_CHECKBOOOKREFERENCENUM);
        $this->assertEquals($pdoCheckbook->getCheckbookVendor(), $this->VALID_CHECKBOOKVENDOR);
    }

    /**
     * test grabbing a Checkbook by content that does not exist
     **/
    public function testGetInvalidCheckbookByCheckbookVendor() {
        // grab a invoice date by searching for content that does not exist
        $checkbook = Checkbook::getCheckbookByCheckbookInvoiceNum($this->getPDO(), "you will find nothing");
        $this->asserCount(0, $checkbook);
    }
    /**
     * test grabbing all Checkbooks
     **/
    public function testGetAllValidCheckbooks() {
        // count the number of rows and save it for later
        $numRows = $this->getConnection()->getRowCount("tweet");

        // create a new Checkbook and insert to into mySQL
        $checkbook = new Checkbook(null, $this->checkbook->getCheckbookId(), $this->VALID_CHECKBOOKINVOICEAMOUNT, $this->VALID_CHECKBOOKINVOICEDATE, $this->VALID_CHECKBOOKINVOICENUM, $this->VALID_CHECKBOOKPAYMENTDATE, $this->VALID_CHECKBOOOKREFERENCENUM, $this->VALID_CHECKBOOKVENDOR);
        $checkbook->insert($this->getPDO());

        // grab the data from mySQL and enforce the fields match our expectations
        $results = Checkbook::getAllCheckbooks($this->getPDO());
        $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("checkbook"));
        $this->assertCount(1, $results);
        $this->assertContainsOnlyInstancesOf("Edu\\Cnm\\AbqVast\\Checkbook", $results);

        // grab the result from the array and validate it
        $pdoCheckbook = $results[0];
        $this->assertEquals($pdoCheckbook->getCheckbookId(), $this->checkbook->getCheckbookId());
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceAmount(), $this->VALID_CHECKBOOKINVOICEAMOUNT);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceDate(), $this->VALID_CHECKBOOKINVOICEDATE);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceNum(), $this->VALID_CHECKBOOKINVOICENUM);
        $this->assertEquals($pdoCheckbook->getCheckbookInvoicePaymentDate(), $this->VALID_CHECKBOOKPAYMENTDATE);
        $this->assertEquals($pdoCheckbook->getCheckbookReferenceNum(), $this->VALID_CHECKBOOOKREFERENCENUM);
        $this->assertEquals($pdoCheckbook->getCheckbookVendor(), $this->VALID_CHECKBOOKVENDOR);
    }
}