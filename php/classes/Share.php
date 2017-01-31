<?php

/** Share is the image users will be able to share on their social media channels, emails, or print.
 * Share will also have a customizable url for sharing purposes.
 * This feature will also allow users to save an image in order to track historical data.
 *
 * @author Sarah Ruth Finkel <sfinkel@cnm.edu>
 * @version
 *
 **/
class Share {
	/**
	 * id for this Share; this is Id references criteriaShareId and is unique
	 * @var int $shareId
	 **/
	private $shareId;
	/**
	 * url for the Share; this url will be customizable to the end user.
	 * @var string $shareUrl
	 **/
	private $shareUrl;
	/**
	 * image of the data graph for the user to share and/or save.
	 * @var string $shareUrl
	 **/
	private $shareImage;
	/**
	 * constructor for this Share
	 *
	 * @param int|null $newShareId id of this Share or null is a new Share
	 *	@param string $newShareUrl string containing the url of the Share
	 * @param string $newShareImage string containing the image name of Share
	 *	@throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g. strings too long, negative integers)
	 * @throws \TypeError if data violates type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newShareId, string $newShareUrl, string $newShareImage) {
		try {
			$this->setShareId($newShareId);
			$this->setShareUrl($newShareUrl);
			$this->setShareImage($newShareImage);
		}	catch(\InvalidArgumentException $invalidArgument) {

			// rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		}	catch(\RangeException $range) {
			// rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			// rethrow the exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		}	catch(\Exception $exception) {
			// rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
 	* accessor method for share id
 	*
 	* @return int|null value of share id
 	**/
	public function getShareId() {
		return($this->shareId);
	}

	/**
	 * mutator method for share id
	 *
	 * @param int|null $newShareId new value of share id
	 * @throws \RangeException if $newTweetId is not positive
	 * @throws \TypeError if $newTweetId is not an integer
	 **/
	public function setShareId(int $newShareId = null) {
		// base case: if the share id is null, this is a new share without a mySQL assigned id (yet) and will also reference criteria share id
		if($newShareId === null) {
			$this->shareId = null;
			return;
		}

		//verify the share id is positive
		if($newShareId <= 0) {
			throw(new \RangeException("share is not positive"));
		}

		//convert and store the share id
		$this->shareId = $newShareId;
	}

	/**
	 * accessor method for the share url
	 *
	 * @return string value of share url
	 *
	 **/
	public function getShareUrl() {
		return($this->shareUrl);
	}

	/**
	 * mutator method for share url
	 *
	 * @param string $newShareUrl new value of share url
	 * @throws \InvalidArgumentException if $newShareUrl is not a string or not insecure
	 * @throws \RangeException if $newShareUrl is > 64 characters
	 * @throws \TypeError if $newShareUrl is not a string
	 **/
	public function setShareUrl(string $newShareUrl) {
		// verify url is secure
		$newShareUrl = trim($newShareUrl);
		$newShareUrl = filter_var($newShareUrl, FILTER_SANITIZE_URL);
		if(empty($newShareUrl) === true) {
			throw(new \InvalidArgumentException("Share content is empty or insecure"));
		}

		//verify the share url will fit into the database
		if(strlen($newShareUrl) > 64) ;
		throw(new \RangeException("Share URL is too long"));

		//store the new share url
		$this->shareUrl = $newShareUrl;
	}

	/**
	 * accessor method for share image
	 *
	 * @return string value of share image
	 **/
	public function getShareImage() {
		return($this->shareImage);
	}

	/**
	 * mutator method for share image
	 *
	 * @param string $newShareImage new value of share image
	 * @throws \InvalidArgumentException if $newShareImageis not a string
	 * @throws \RangeException if $newShareImage is > 64 characters
	 * @throws \TypeError if $newShareImage is not a string
	 **/
	public function setShareImage(string $newShareImage) {
		//verify the share image is a string
		$newShareImage = trim($newShareImage);
		$newShareImage = filter_var($newShareImage, FILTER_SANITIZE_STRING);
		if(empty($newShareImage) === true) {
			throw(new \InvalidArgumentException("Share Image Name is empty or insecure"));
		}

		//verify share image will fit into the database
		if(strlen($newShareImage) > 64) {
			throw(new \RangeException("Share Image Name is too large"));
		}

		//store the share image
		$this->shareImage = $newShareImage;
	}

	/**
	 *inserts this share image into mySQL
	 *
	 * @param \PDO $pdo PDO
	 **/
}
