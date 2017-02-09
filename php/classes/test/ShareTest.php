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
	 * valid share image
	 * @var string $VALID_SHAREIMAGE
	 **/
	protected $VALID_SHAREIMAGE = "valid share image";
	/**
	 * valid share url
	 * @var string $VALID_SHAREURL
	 **/
	protected $VALID_SHAREURL = "http://google.com";
	/**
	*
	**/
	protected $share = null;

	/**
	 * test inserting a valid profile and verify that the actual mySQL data matches
	 **/
	public function testInsertValidShare() {

		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("share");

		//create a new profile and insert into mySQL
		$share = new Share(null, $this->VALID_SHAREIMAGE, $this->VALID_SHAREURL);
		$share->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoShare = Share::getShareByShareId($this->getPDO(), $share->getShareId());
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("share"));
		$this->assertEquals($pdoShare->getShareImage(), $this->VALID_SHAREIMAGE);
		$this->assertEquals($pdoShare->getShareUrl(), $this->VALID_SHAREURL);
	}

	/**
	 * test inserting a share that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidShare() {
		// create a profile with a non null shareId and watch it fail
		$share = new Share(AbqVastTest::INVALID_KEY, $this->VALID_SHAREIMAGE, $this->VALID_SHAREURL);
		$share->insert($this->getPDO());
	}

		/**
		 * test grabbing a share that does not exist
		 **/
		public function testGetInvalidShareByShareId() {
			//grab a Share id that exceeds the maximum allowable share id
			$share = Share::getShareByShareId($this->getPDO(), AbqVastTest::INVALID_KEY);
			$this->assertNull($share);
		}
}