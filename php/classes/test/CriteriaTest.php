<?php
/**
 * Created by PhpStorm.
 * User: blue
 * Date: 2/1/17
 * Time: 3:29 PM
 * This is a change. again
 */
namespace Edu\Cnm\AbqVast\Test;

use Edu\Cnm\AbqVast\{
	Criteria, Field, Share
};

// TODO: add share and field reference dependency classes (use)
//grab the project test parameters
require_once("AbqVastTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

/**
 * PHPUnit test for the Criteria class.
 * @see Criteria
 * @author Taylor McCarthy <tmccarthy4@cnm.edu>
 **/
class CriteriaTest extends AbqVastTest {
	/**
	 * content of criteriaId
	 * @var string $VALID_CRITERIAID
	 **/
	protected $VALID_CRITERIAID = null;

	/**
	 * field foreign key
	 **/
	protected $field = null;
	/**
	 * share foreign key
	 **/
	protected $share = null;

	/**
	 * content of criteriaOperator
	 * @var string $VALID_CRITERIAOPERATOR
	 **/
	protected $VALID_CRITERIAOPERATOR = "Pass";

	/**
	 * content of criteriaValue
	 * @var string $VALID_CRITERIAVALUE
	 **/
	protected $VALID_CRITERIAVALUE = "passValue";

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		//run the default setup method first
		parent::setUp();

		//create and insert foreign field
		$this->field = new Field(null, "passN", "S");
		$this->field->insert($this->getPDO());
		$this->share = new Share(null, "passShI", "passShU");
		$this->share->insert($this->getPDO());
	}

	/**
	 * test inserting a valid criteria and verify that the mySQL data matches.
	 **/
	public function testInsertValidCriteria() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("criteria");

		// create a new criteria and insert into mySQL
		$criteria = new Criteria(null, $this->field->getFieldId(), $this->share->getShareId(), $this->VALID_CRITERIAOPERATOR, $this->VALID_CRITERIAVALUE);
		$criteria->insert($this->getPDO());
		//grab the data from mySQL and enforce the fields match our expectations.
		$pdoCriteria = Criteria::getCriteriaIdByCriteriaId($this->getPDO(), $criteria->getCriteriaId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("criteria"));
		$this->assertEquals($pdoCriteria->getCriteriaId(), $this->VALID_CRITERIAID);
		$this->assertEquals($pdoCriteria->getCriteriaFieldId(), $this->field->getFieldId());
		$this->assertEquals($pdoCriteria->getCriteriaShareId(), $this->share->getShareId());
		$this->assertEquals($pdoCriteria->getCriteriaOperator(), $this->VALID_CRITERIAOPERATOR);
		$this->assertEquals($pdoCriteria->getCriteriaValue(), $this->VALID_CRITERIAVALUE);
	}

	/**
	 * test inserting a Criteria that already exists
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidCriteria() {
		//create a criteria will a non null criteria id and watch the world burn
		$criteria = new Criteria(AbqVastTest::INVALID_KEY, $this->VALID_CRITERIAID, $this->field->getFieldId, $this->share->getShareId);
		$criteria->insert($this->getPDO());
	}






}