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

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getPostId();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * Set ID
     *
     * @param int $id
     * @return \OpenTechiz\Blog\Api\Data\CommentInterface
     */
    public function setId($id);

    /**
     * Set content
     *
     * @param string $content
     * @return \OpenTechiz\Blog\Api\Data\CommentInterface
     */
    public function setContent($content);


    /**
     * Set ID
     *
     * @param int $id
     * @return \OpenTechiz\Blog\Api\Data\CommentInterface
     */
    public function setPostId($id);

    /**
     * Set ID
     *
     * @param int $id
     * @return \OpenTechiz\Blog\Api\Data\CommentInterface
     */
    public function setCustomerId($id);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return \OpenTechiz\Blog\Api\Data\CommentInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return \OpenTechiz\Blog\Api\Data\CommentInterface
     */
    public function setUpdateTime($updateTime);
}
