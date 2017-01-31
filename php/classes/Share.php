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
	 * @param int $newShareId new value of share id
	 * @throws \
	 **/

}
