<?php
namespace Edu\Cnm\AbqVast;
require_once("autoload.php");
// FIXME: add getFieldByFieldId(), add getFieldName() accessor...

/**
 * ABQ Vast Field profile
 *
 * The field profile collects and compiles all the data the end user has requested.
 *
 * @author Adam Pedroza <apedroza6@cnm.edu>
 * @version
 **/
class Field implements \JsonSerializable {
	/**
	 * id for the Field; This is a primary key; unique
	 * @var int $fieldId
	 * **/
	private $fieldId;
	/**
	 * idetifies the Field using a Field Name;
	 * @var string $fieldName
	 * **/
	private $fieldName;
	/**
	 * idetifies the Field Type;
	 * @var string $fieldType
	 * **/
	private $fieldType;

	/**
	 * constructor for this Field
	 *
	 * @param int|null $newFieldId id of this Field or null if a new field
	 * @param string $newFieldName containing the name of the Field
	 * @param string $newFieldType containing the type of field
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g. strings too long, negative integers)
	 * @throws \TypeError if data violates type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newFieldId = null, string $newFieldName, string $newFieldType) {
		try {
			$this->setFieldId($newFieldId);
			$this->setFieldName($newFieldName);
			$this->setFieldType($newFieldType);
		} catch(\invalidArgumentException $invalidArgument) {
			// rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			// rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			// rethrow the exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			// rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for field id
	 *
	 * @return int|null value of field id
	 **/
	public function getFieldId() {
		return ($this->fieldId);
	}
	/**
	 * accessor method for getFieldByFieldId
	 *
	 *@return field|null
	 **/
	public static function getFieldByFieldId (\PDO $pdo, int $fieldId) {
		//sanitize the field id before searching
		if($fieldId <=0) {
			throw(new \RangeException("field id is not positive"));
		}
		//create query templet
		$query = "SELECT fieldId, FieldName, fieldType FROM field WHERE fieldId = :fieldId";
		$statement = $pdo->prepare($query);

		//bind the field id to the place holder in the template
		$perameters = ["fieldId" => $fieldId];
		$statement = $pdo->prepare($query);

		//grab the field from mySQL
		try {
				$field = null;
				$statement->setFetchMode(\PDO::FETCH_ASSOC);
				$row = $statement->fetch();
				if($row !== false) {
					$field = new Field($row["fieldId"], $row["fieldName"], $row["fieldType"]);
				}

		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->get message(),0,$exception));
		}
		return ($field);
	}

	/**
	 * mutator method for field id
	 *
	 * @param int $newFieldId new value of field id
	 * @throws \RangeException if $newFieldId is not positive
	 * @throws \TypeError if $newFieldId is not an integer
	 **/
	public function setFieldId(int $newFieldId = null) {
		// verify the profile id is positive
		if($newFieldId === null) {
			$this->fieldId = null;
			return;
		}

		//verify the field id is positive
		if($newFieldId <= 0) {
			throw(new \RangeException("field is not positive"));
		}

		//convert and store the field id
		$this->fieldId = $newFieldId;
	}

	/**
	 * accessor method for field type
	 *
	 * @return string value of field type
	 **/
	public function getFieldType() {
		return ($this->fieldType);
	}

	/**
	 * accessor method for field name
	 *
	* @return string value of field name
	 **/
	public function getFieldName() {
		return ($this->fieldName);
	}


	/**
	 * mutator method for field type
	 *
	 * @param string $newFieldType new value of field type
	 * @throws \InvalidArgumentException if $newFieldType is not a string
	 * @throws \RangeException if $newFieldType is !== 1 character
	 * @throws \TypeError if $newFieldType is not a string
	 **/
	public function setFieldType(string $newFieldType) {
		//verify the field type is a string
		$newFieldType = trim($newFieldType);
		$newFieldType = filter_var($newFieldType, FILTER_SANITIZE_STRING);

		if(empty($newFieldType) === true) {
			throw(new \InvalidArgumentException("Field Type is empty or insecure"));
		}

		//verify field type will fit into the database
		if(strlen($newFieldType) !== 1) {
			throw(new \RangeException("Field Type is incorrect"));
		}

		if(($newFieldType !== "d")) {
			throw(new \InvalidArgumentException("not a valid field type"));
		}

		//store the field type
		$this->fieldType = $newFieldType;
	}

	/**
	 * mutator method for field name
	 *
	 * @param string $newFieldType new value of field name
	 * @throws \InvalidArgumentException if $newFieldName is not a string
	 * @throws \RangeException if $newFieldName is > 64 character
	 * @throws \TypeError if $newFieldName is not a string
	 **/
	public function setFieldName(string $newFieldName) {
		//verify the field name is a string
		$newFieldName = trim($newFieldName);
		$newFieldName = filter_var($newFieldName, FILTER_SANITIZE_STRING);
		if(empty($newFieldName) === true) {
			throw(new \InvalidArgumentException("Field Name is empty or insecure"));
		}

		//verify field name will fit into the database
		if(strlen($newFieldName) > 64) {
			throw(new \RangeException("Field Name is too large"));
		}

		//store the field name
		$this->fieldName = $newFieldName;
	}
	/**
	 * inserts this share image into mySQL
	 *
	 * @param \PDO $pdo PDO Connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		//enforce the field id is null (i.e. don't insert a field id that already exists)
		if($this->fieldId !== null) {
			throw(new \PDOException("not a new field"));
		}

		//create query template
		$query = "INSERT INTO field(fieldName, fieldType) VALUES(:fieldName, :fieldType)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["fieldName" => $this->fieldName, "fieldType" => $this->fieldType];
		$statement->execute($parameters);

		//update the null fieldId with what mySQL just gave us
		$this->fieldId = intval($pdo->lastInsertId());
	}
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}
