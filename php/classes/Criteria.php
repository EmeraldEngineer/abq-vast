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