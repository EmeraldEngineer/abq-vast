<?php
namespace Edu\Cnm\AbqVast\Test;

use Edu\Cnm\AbqVast\{Checkbook};

// grab the project test parameters
require_once("AbqVastTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");

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
        $checkbook = new Checkbook(null, $this->checkbookId->getCheckbookId(), $this->VALID_CHECKBOOKID, $checkbook->insert($this->getPDO()));

        // grab the data from mySQL and enforce the fields match our expectations
        $pdoCheckbook = Checkbook::getCheckbookByCheckbookId($this->getPDO(), $checkbook->getCheckbookId());
        $this->assertEquals($numRows + 1, $this->getConnection()->getConnection()->getRowCount("checkbook"));
        $this->assertEquals($pdoCheckbook->getCheckbookId(), $this->checkbook->getCheckbookId());
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceAmount(), $this->checkbook->getCheckbookInvoiceAmount());
        $this->assertEquals($pdoCheckbook->getCheckbookInvoiceDate(), $this->VALIDCHECKBOOKINVOICEDATE);
    }
}