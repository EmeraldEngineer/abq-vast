<?php
/**
 * Created by PhpStorm.
 * User: blue
 * Date: 2/1/17
 * Time: 3:29 PM
 * This is a change.
 */
namespace Edu\Cnm\AbqVast\Test;

use Edu\Cnm\AbqVast\{Criteria};

//grab the project test parameters
require_once("AbqVastTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");

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
	 * content of criteriaFieldId
	 * @var $CRITERIAFIELDID criteriafieldid
	 **/
	protected $VALID_CRITERIAFIELDID = null;

	/**
	 * content of criteriaShareId
	 * @var $CRITERIASHAREID criteriashareid
	 **/
	protected $VALID_CRITERIASHAREID = null;

	/**
	 * content of criteriaOperator
	 * @var string $VALID_CRITERIAOPERATOR
	 **/
	protected $VALID_CRITERIAOPERATOR = "Pass";

	/**
	 * content of criteriaValue
	 * @var int $VALID_CRITERIAVALUE
	 **/
	protected $VALID_CRITERIAVALUE = 500;

	/**
	 * test inserting a valid criteria and verify that the mySQL data matches.
	 **/
	public function testInsertValidCriteria() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("criteria");

		// create a new criteria and insert into mySQL
		$criteria = new Criteria(null, null, null, $this->VALID_CRITERIAOPERATOR, $this->VALID_CRITERIAVALUE);
		$criteria->insert($this->getPDO());

	}

}