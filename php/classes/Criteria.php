<?php
/**
 * Criteria class, allows the user to select what data they would like to graph.
 * @author Taylor McCarthy <tmccarthy4@cnm.edu>
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
	 * @var int $criteraValue
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
	public function __construct(int $newCriteriaId = null, int $newCriteriaFieldId, int $newCriteriaShareId, string $newCriteriaOperator, int $newCriteriaValue) {
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
		return ($this->profileId);
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
}