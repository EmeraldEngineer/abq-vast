<?php
namespace Edu\Cnm\AbqVast\Test;

use Edu\Cnm\AbqVast\{Field};

// grab the project test parameters
require_once("AbqVastTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

/**
 * Full PHPUnit test for the Field Class
 *
 * This is a complete PHPUnit test of the Field Class. It is complete because *ALL* mySQL/PDO enabled methods are tested for both invalid and valid inputs.
 *
 * @see Field
 * @author Adan Pedroza <apedroza6@cnm.edu>
 **/
class FieldTest extends AbqVastTest {
	/**
	 * valid field type
	 * @var string $VALID_FIELDTYPE
	 **/
	protected $VALID_FIELDTYPE = "d";
	/**
	 * valid field name
	 * @var string $VALID_FIELDNAME
	 **/
	protected $VALID_FIELDNAME = "http://google.com";
	/**
	 *
	 **/
	protected $field = null;

	/**
	 * test inserting a valid profile and verify that the actual mySQL data matches
	 **/
	public function testInsertValidField() {

		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("field");

		//create a new profile and insert into mySQL
		$field = new Field(null, $this->VALID_FIELDTYPE, $this->VALID_FIELDNAME);
		$field->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoField = Field::getFieldByFieldId($this->getPDO(), $field->getFieldId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("field"));
		$this->assertEquals($pdoField->getFieldType(), $this->VALID_FIELDTYPE);
		$this->assertEquals($pdoField->getFieldName(), $this->VALID_FIELDNAME);
	}

	/**
	 * test inserting a field that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidField() {
		// create a profile with a non null fieldId and watch it fail
		$field = new Field(AbqVastTest::INVALID_KEY, $this->VALID_FIELDTYPE, $this->VALID_FIELDNAME);
		$field->insert($this->getPDO());
	}

	/**
	 * test grabbing a field that does not exist
	 **/
	public function testGetInvalidFieldByFieldId() {
		//grab a Field id that exceeds the maximum allowable field id
		$field = Field::getFieldByFieldId($this->getPDO(), AbqVastTest::INVALID_KEY);
		$this->assertNull($field);
	}
}