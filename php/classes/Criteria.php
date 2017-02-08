<?php
// FIXME: convert criteriaValue to varchar(82)
namespace Edu\Cnm\AbqVast;

require_once("autoload.php");
/**
 * Criteria class, allows the user to select what data they would like to graph.
 * @author Taylor McCarthy <tmccarthy4@cnm.edu>
 * This is a change
 **/
class Criteria implements \JsonSerializable {
	/**
	 *id for criteria, primary key.
	 * @var int $criteriaId
	 **/
	private $criteriaId;
	/**
	 * criteriaFieldId - foreign key from field.
	 * @var int $criteriaFieldId
	 **/
	private $criteriaFieldId;
	/**
	 * criteriaShareId - foreign key from share.
	 * @var int $criteriaShareId
	 **/
	private $criteriaShareId;
	/**
	 * operator for criteria.
	 * @var string $criteriaOperator
	 **/
	private $criteriaOperator;
	/**
	 * value of criteria
	 * @var string $criteraValue
	 **/
	private $criteriaValue;
	/**
	 *Constructor for criteria
	 * @param int|null $newCriteriaId id of criteria or null or null if new.
	 * @param int $newCriteriaFieldId id of foreign key from field.
	 * @param int $newCriteriaShareId id of foreign key from share.
	 * @param string $newCriteriaOperator mathematical operator for criteria.
	 * @param int $newCriteriaValue value of the criteria to be operated upon.
	 * @throws \InvalidArgumentException if data type is not valid.
	 * @throws \RangeException if data values are out of bounds.
	 * @throws \TypeError if data types violate type hints.
	 * @throws \Exception if any other exception occurs.
	 **/
	public function __construct(int $newCriteriaId = null, int $newCriteriaFieldId, int $newCriteriaShareId, string $newCriteriaOperator, string $newCriteriaValue) {
		try {
			$this->setCriteriaId($newCriteriaId);
			$this->setCriteriaFieldId($newCriteriaFieldId);
			$this->setCriteriaShareId($newCriteriaShareId);
			$this->setCriteriaOperator($newCriteriaOperator);
			$this->setCriteriaValue($newCriteriaValue);
		}	catch(\InvalidArgumentException $invalidArgument) {
				throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		}	catch(\RangeException $range) {
				throw(new \RangeException($range->getMessage(), 0, $range));
		}	catch(\TypeError $typeError) {
				throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		}	catch(\Exception $exception) {
				throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}


	/**
	 * accessor method for criteriaId
	 * @return int value for criteriaId
	 **/
	public function getCriteriaId() {
		return ($this->criteriaId);
	}
	/**
	 * mutator method for criteriaId
	 * @param int $setCriteriaId new value of criteriaId
	 * @throws \InvalidArgumentException if $setCriteriaId is insecure
	 * @throws \TypeError if $setCriteriaId is not an integer
	 **/
	public function setCriteriaId(int $setCriteriaId = null) {
		// if criteriaId is null, this is a new criteria without a mySQL assigned id
		if($setCriteriaId === null) {
			$this->criteriaId = null;
			return;
		}
		//verify criteriaId is positive
		if($setCriteriaId <= 0) {
			throw(new \RangeException("Criteria Id is not positive"));
		}
		//convert and store the criteriaId
		$this->criteriaId = $setCriteriaId;
	}

	/**
	 * accessor method for criteriaFieldId
	 * @return int value for criteriaFieldId
	 **/
	public function getCriteriaFieldId() {
		return ($this->criteriaFieldId);
	}
	/**
	 * mutator method for criteriaFieldId
	 * @param int $newCriteriaFieldId
	 * @throws \RangeException if $newCriteriaFieldId is not positive
	 * @throws \TypeError if $newCriteriaFieldId is not an integer
	 **/
	public function setCriteriaFieldId(int $newCriteriaFieldId) {
		if($newCriteriaFieldId <= 0) {
			throw(new \RangeException("criteriaFieldId is not positive"));
		}
		$this->criteriaFieldId = $newCriteriaFieldId;
	}
	/**
	 * Accessor method for criteriaShareId
	 * @return int value of criteriaShareId
	 **/
	public function getCriteriaShareId() {
		return($this->criteriaShareId);
	}
	/**
	 * mutator for criteriaShareId
	 * @param int $newCriteriaShareId
	 * @throws \RangeException if $newCriteriaShareId is not positive
	 * @throws \TypeError if $newCriteriaShareId is not an integer
	 **/
	public function setCriteriaShareId(int $newCriteriaShareId) {
		if($newCriteriaShareId <=0) {
			throw(new \RangeException("criteriaShareId is not positive"));
		}
		$this->criteriaShareId = $newCriteriaShareId;
	}
	/**
	 * accessor method for criteriaOperator
	 **/
	public function getCriteriaOperator() {
		return($this->criteriaOperator);
	}
	/**
	 * mutator for criteria Operator
	 * @param string $newCriteriaOperator
	 * @throws \RangeException if $newCriteriaOperator is > 4 characters
	 * @throws \TypeError if $newCriteriaOperator is not a string
	 **/
	public function setCriteriaOperator(string $newCriteriaOperator) {
		$newCriteriaOperator = trim($newCriteriaOperator);
		$newCriteriaOperator = filter_var($newCriteriaOperator, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newCriteriaOperator) === true) {
			throw(new \InvalidArgumentException("operator can't be empty or insecure"));
		}
		if(strlen($newCriteriaOperator) > 4) {
			throw(new \RangeException("operator cannot be greater than four characters"));
		}
		$this->criteriaOperator = $newCriteriaOperator;
	}
	/**
	 * accessor method for criteriaValue
	 **/
	public function getCriteriaValue() {
		return($this->criteriaValue);
	}
	/**
	 * mutator for criteriaValue
	 * @param string $newCriteriaValue
	 * @throw \InvalidArgumentException if $newCriteriaValue is empty or insecure
	 * @throw \RangeException if $newCriteriaValue is greater than 82 characters
	 **/
	public function setCriteriaValue(string $newCriteriaValue) {
		$newCriteriaValue = trim($newCriteriaValue);
		$newCriteriaValue = filter_var($newCriteriaValue, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newCriteriaValue) === true) {
			throw(new \InvalidArgumentException("value cannot be empty or insecure"));
		}
		if(strlen($newCriteriaValue) > 82) {
			throw(new \RangeException("value cannot be greater than 82 characters"));
		}
		$this->criteriaValue = $newCriteriaValue;
	}


/**
 * inserts criteria into mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/

	public function insert(\PDO $pdo) {
		// enforce criteriaId is null
		if($this->criteriaId !==null) {
			throw(new \PDOException("not a new criteria"));
		}
		/** create query template
		 * This is a change again
		 **/
		$query = "Insert INTO criteria(criteriaId, criteriaFieldId, criteriaShareId, criteriaOperator, criteriaValue) VALUES(:criteriaId, :criteriaFieldId, :criteriaShareId, :criteriaOperator, :criteriaValue)";
		$statement = $pdo->prepare($query);
	
	/**
	* bind the member variables to the place holders
	**/
		$parameters = ["criteriaId" => $this->criteriaId, "criteriaFieldId" => $this->criteriaFieldId, "criteriaShareId" => $this->criteriaShareId, "criteriaOperator" => $this->criteriaOperator, "criteriaValue" => $this->criteriaValue];
		$statement->execute($parameters);
	//update the null criteriaId with what mySQL output
		$this->criteriaId = intval($pdo->lastInsertId());
	}
	
	/**
	* deletes checkbook from mySQL
	*@param \PDO $pdo PDO connection object
	*@throws \PDOException when mySQL related errors occur
	*@throws \TypeError if $pdo is not a PDO connection object
	**/
	public function delete(\PDO $pdo) {
	// enforce the criteriaId is not null
		if($this->criteriaId === null) {
			throw(new \PDOException("unable to update a criteria that does not exist"));
		}
		//create query template
		$query = "DELETE FROM criteria WHERE criteriaId = :criteriaId";
		$statement = $pdo->prepare($query);
		//bind the member variables to the place holder in the template
		$parameters = ["criteriaId" => $this->criteriaId];
		$statement->execute($parameters);
	}

	/**
	* updates the criteria in mySQL
	*@param \PDO $pdo PDO connection object
	*@throws \PDOException when mySQL errors occur
	*@throws \TypeError if $pdo is not a PDO connection object
	**/

	/**
	* get criteria by criteriaId
	*
	*@param \PDO $pdo PDO connection object
	*@param int $criteriaId criteria id to search for
	*@return Criteria|null Criteria found or null if not found
	*@throws \PDOException when mySQL related errors occur
	*@throws \TypeError when variables are not the correct data type
	**/
	
	public static function getCriteriaIdByCriteriaId(\PDO $pdo, int $criteriaId) {
		//sanitize the criteriaId before searching
		if($criteriaId <= 0) {
			throw(new \PDOException("criteria id is not positive"));
		}
		//create query template
		$query = "SELECT criteriaId, criteriaFieldId, criteriaShareId, criteriaOperator, criteriaValue FROM criteria WHERE criteriaId = :criteriaId";
		$statement = $pdo->prepare($query);
		//criteriaId to the place holder in the template
		$parameters = ["criteriaId" => $criteriaId];
		$statement->execute($parameters);
		//grab the checkbook from mySQL
		try {
			$criteriaId = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !==false) {
				$criteriaId = new Criteria($row["criteriaId"], $row["criteriaFieldId"], $row["criteriaShareId"], $row["criteriaOperator"], $row["criteriaValue"]);
			}
		} catch(\Exception $exception) {
			// if new row could not be converted, rethrow it.
				throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($criteriaId);
	}
	public function jsonSerialize() {
	return(get_object_vars($this));

}
}