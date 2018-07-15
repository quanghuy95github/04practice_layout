<?php
namespace OpenTechiz\Blog\Api\Data;

interface NotificationInterface
{
	/**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const NOTI_ID                  = 'noti_id';
    const CONTENT                  = 'content';
    const CUSTOMER_ID			   = 'customer_id';
    const POST_ID                  = 'post_id';
    const CREATION_TIME            = 'creation_time';

	public function getID();

	public function getContent();

	public function getCustomerID();

	public function getPostID();

	public function getCreationTime();

	public function setID($id);

	public function setContent($content);

	public function setCustomerID($customerID);

	public function setPostID($postID);

	public function setCreationTime($creatTime);
}