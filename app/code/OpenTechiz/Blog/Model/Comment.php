<?php
namespace OpenTechiz\Blog\Model;

use OpenTechiz\Blog\Api\Data\CommentInterface;
use Magento\Framework\DataObject\IdentityInterface;

class Comment extends \Magento\Framework\Model\AbstractModel implements CommentInterface,IdentityInterface
{
    const CACHE_TAG='opentechiz_blog_comment';

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [])
    {
        $this->_urlBuilder = $urlBuilder;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }
    
    function _construct()
    {
        $this->_init('OpenTechiz\Blog\Model\ResourceModel\Comment');
    }
    
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function checkUrlKey($url_key)
    {
        return $this->_getResource()->checkUrlKey($url_key);
    }

    function getID(){
        return $this->getData(self::COMMENT_ID);
    }

    function getContent(){
        return $this->getData(self::CONTENT);
    }

    public function getEmail(){
        return $this->getData(self::EMAIL);
    }

    function getPostID(){
        return $this->getData(self::POST_ID);
    }

    function getCustomerId(){
        return $this->getData(self::CUSTOMER_ID);
    }


    function getCreationTime(){
        return $this->getData(self::CREATION_TIME);
    }

    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    function setID($id){
        $this->setData(self::COMMENT_ID,$id);
        return $this;
    }

    function setCustomerId($customer_id){
        $this->setData(self::CUSTOMER_ID,$customer_id);
        return $this;
    }

    function setContent($content){
        $this->setData(self::CONTENT,$content);
        return $this;
    }

    function setEmail($email){
        $this->setData(self::EMAIL,$email);
        return $this;
    }

    function setPostID($postId){
        $this->setData(self::POST_ID,$postId);
        return $this;
    }

    function setCreationTime($creatTime){
        $this->setData(self::CREATION_TIME,$creatTime);
        return $this;
    }

    public function setUpdateTime($update_time)
    {
        return $this->setData(self::UPDATE_TIME, $update_time);
    }

    public function setAvailableStatuses($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}