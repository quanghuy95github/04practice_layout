<?php
namespace OpenTechiz\Blog\Api\Data;


interface CommentInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const COMMENT_ID       = 'comment_id';
    const CONTENT          = 'content';
    const POST_ID          = 'post_id';
    const CUSTOMER_ID      = 'customer_id';
    const CREATION_TIME    = 'creation_time';
    const UPDATE_TIME      = 'update_time';
    const EMAIL            = 'email';
    const STATUS           = 'status';

    public function getId();

    public function getContent();

    public function getEmail();

    public function getPostId();

    public function getCustomerId();

    public function getCreationTime();

    public function getUpdateTime();

    public function getAvailableStatuses();

    public function setId($id);

    public function setContent($content);

    public function setEmail($email);

    public function setPostId($id);

    public function setCustomerId($id);

    public function setCreationTime($creationTime);

    public function setUpdateTime($updateTime);

    public function setAvailableStatuses($status);
}
