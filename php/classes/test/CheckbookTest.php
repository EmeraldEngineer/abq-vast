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
}