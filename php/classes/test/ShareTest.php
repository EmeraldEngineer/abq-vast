<?php
namespace Edu\Cnm\AbqVast\Test;

use Edu\Cnm\AbqVast\{Share};

// grab the project test parameters
require_once("AbqVastTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

/**
 * Full PHPUnit test for the Share Class
 *
 * This is a complete PHPUnit test of the Share Class. It is complete because *ALL* mySQL/PDO enabled methods are tested for both invalid and valid inputs.
 *
 * @see Share
 * @author Sarah Ruth Finkel <sfinkel@cnm.edu>
 **/
class ShareTest extends AbqVastTest {
	/**
	 * content of the Share
	 * @var string $VALID_SHARECONTENT
	 **/
	protected $VALID_SHARECONTENT = "PHPUnit test passing";
	/**
	 * content of the updated Share
	 * @var string $VALID_SHARECONTENT2
	 **/
	protected $VALID_SHARECONTENT2 = "PHPUnit test still passing";

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

		// create and insert a Profile to own the test Share
		$this->share = new Share(null, "@phpunit", "test@phpunit.de", "+12125551212");
		$this->share->insert($this->getPDO());
	}

	/**
	 * test inserting a valid Share and verify that the actual mySQL data matches
	 **/
	public function testInsertValidShare() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("share");

		//create a new share and insert into mySQL
		$share = new Share(null, $this->share	)
	}
}