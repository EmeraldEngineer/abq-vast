<?php
/**
 * Created by PhpStorm.
 * User: blue
 * Date: 2/1/17
 * Time: 3:29 PM
 * This is a change.
 */
namespace Edu\Cnm\AbqVast\Test;

use Edu\Cnm\AbqVast\{criteria};

//grab the project test parameters
require_once("AbqVastTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");

/**
 * PHPUnit test for the Criteria class.
 **/

class CriteriaTest extends AbqVastTest {
	/**
	 * content of criteriaId
	 * @var string $VALID_CRITERIAID
	 **/
	protected $VALID_CRITERIAID = "PHPUnit criteriaId test passing";

	/**
	 * content of criteriaFieldId
	 * @var $CRITERIAFIELDID criteriafieldid
	 **/
	protected $CRITERIAFIELDID = null;

	/**
	 * content of criteriaShareId
	 * @var $CRITERIASHAREID criteriashareid
	 **/
	protected $CRITERIASHAREID = null;

	/**
	 * content of criteriaOperator
	 * @var string $VALID_CRITERIAOPERATOR
	 **/
	protected $VALID_CRITERIAOPERATOR = "PHPUnit criteriaOperator test passing";

	/**
	 * content of criteriaValue
	 * @var string $VALID_CRITERIAVALUE
	 **/
	protected $VALID_CRITERIAVALUE = "PHPUnit criteriaValue test passing";

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();
	}

}