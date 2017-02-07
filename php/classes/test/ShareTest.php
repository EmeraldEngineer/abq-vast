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
	protected $VALID_SHAREIMAGE = "PHPUnit test passing";
	/**
	 * valid share url
	 * @var string $VALID_SHAREURL
	 **/
	protected $VALID_SHAREURL = "PHPUnit test still passing";
	/**
	*
	**/
	protected $share = null;

	/**
	 * test inserting a valid profile and verify that the actual mySQL data matches
	 **/
	public function testInsertValidProfile() {

		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("share");

		//create a new profile and insert into mySQL
		$share = new Share(null, $this->VALID_SHAREIMAGE, $this->VALID_SHAREURL);
		$share->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoShare = Share::getShareByShareId($this->getPDO(), $share->getShareId());
		$this->assertSame($numRows +1, $this->getConnection()->getRowCount("share"));
		$this->assertSame($pdoShare->getShareImage(), $this->VALID_SHAREIMAGE);
		$this->assertSame($pdoShare->getShareUrl(), $this->VALID_SHAREURL);
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
	 * test inserting a Share, editing it, and then updating it
	 **/
	public function testUpdateValidShare() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("share");

		//create a new share and insert into mySQL
		$share = new Share(null, $this->VALID_SHAREIMAGE, $this->VALID_SHAREURL);
		$share->insert($this->getPDO());

		//edit the share and update it in mySQL
		$share->setShareByShareId($this->VALID_SHAREIMAGE);
		$share->update($this->getPDO());

		//grabd the data from mySQL and enforce the fields to match our expectations
		$pdoShare = Share::getShareByShareId($this->getPDO(), $share->getShareId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("share"));
		$this->assertSame($pdoShare->getShareImage(), $this->VALID_SHAREIMAGE);
		$this->assertSame($pdoShare->getShareUrl(), $this->VALID_SHAREURL);
	}

	/**
	 * test updating a Share that does not exist
	 *
	 * @expectedException \PDOException
	 **/
	public function testUpdateInvalidShare() {
		//create a Share and and try to update it without actually inserting it
		$share = new Share(null, $this->VALID_SHAREIMAGE, $this->VALID_SHAREURL);
		$share->insert($this->getPDO());
	}

	/**
	 * test creating a Share and then deleting it
	 **/
	public function testDeleteValidShare() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("share");

		//create a new share and insert into mySQL
		$share = new Share(null, $this->VALID_SHAREIMAGE, $this->VALID_SHAREURL);
		$share->insert($this->getPDO());

		//delete the share from mySQL
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("share"));
		$share->delete($this->getPDO());

		//grab the data from mySQL and enforce the Share does not exist
		$pdoShare = Share::getShareByShareId($this->getPDO(), $share->getShareId());
		$this->assertNull($pdoShare);
		$this->assertSame($numRows, $this->getConnection()->getRowCount("share"));
		}

	/**
	 * test deleting a Share that does not exist
	 *
	 * @expectedException \PDOException
	 **/
	public function testDeleteInvalidShare() {
		//create a share and try to delete it without actually inserting it
		$share = new Share(null, $this->VALID_SHAREIMAGE, $this->VALID_SHAREURL);
		$share->delete($this->getPDO());
		}

	/**
	 * test inserting a profile and regrabbing it from mySQL
	 **/
	public function testGetValidShareByShareId() {
		//count number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("share");

		//create a new share and insert it into mySQL
		$share = new Share(null, $this->VALID_SHAREIMAGE, $this->VALID_SHAREURL);
		$share->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoShare = Share::getShareByShareId($this->getPDO(), $share->getShareId());
		$this->assertSame($numRows + 1, $this->getConnection->getRowCount("share"));
		$this->assertSame($pdoShare->getShareImage(), $this->VALID_SHAREIMAGE);
		$this->assertSame($pdoShare->getShareUrl(), $this->VALID_SHAREURL);
		}

		/**
		 * test grabbing a share that does not exist
		 **/
		public function testGetInvalidShareByShareId() {
			//grab a Share id that exceeds the maximum allowable share id
			$share = Share::getShareByShareId($this->getPDO(), AbqVastTest::INVALID_KEY);
			$this->assertNull($share);
		}

		public function testGetValidShareByShareImage() {
			//count number of rows and save it for later
			$numRows = $this->getConnection()->getRowCount("share");

			//create a share and insert into mySQL
			$share = new Share(null, $this->VALID_SHAREIMAGE, $this->VALID_SHAREURL);
			$share->insert($this->getPDO());

			//grab the data from my SQL and enforce the fields match our expectations
			$pdoShare = Share::getShareByShareImage($this->getPDO(), $this->VALID_SHAREIMAGE);
			$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("share"));
			$this->assertSame($pdoShare->getShareImage(), $this->VALID_SHAREIMAGE);
			$this->assertSame($pdoShare->getShareUrl(), $this->VALID_SHAREURL);
		}

		/**
		 * test grabbing a share by Image that does not exist
		 **/
		public function testGetInvalidShareByShareImage() {
			//grab an Image that does not exist
			$share = Share::getShareByShareImage($this->getPDO(), "Who Lost the Image?");
		}


}