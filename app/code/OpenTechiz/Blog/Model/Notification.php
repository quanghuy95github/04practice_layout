<?php
namespace OpenTechiz\Blog\Model;

use OpenTechiz\Blog\Api\Data\NotificationInterface;
use Magento\Framework\DataObject\IdentityInterface;

class Notification extends \Magento\Framework\Model\AbstractModel implements NotificationInterface,IdentityInterface
{

    const CACHE_TAG = 'opentechiz_blog_comment_notification';

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
        $this->_init('OpenTechiz\Blog\Model\ResourceModel\Notification');
    }
    
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function checkUrlKey($url_key)
    {
        return $this->_getResource()->checkUrlKey($url_key);
    }

    public function getID(){
        return $this->getData(self::NOTI_ID);
    }

    public function getContent(){
        return $this->getData(self::CONTENT);
    }

    public function getCustomerID()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    public function getPostID(){
        return $this->getData(self::POST_ID);
    }

    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    public function setID($id)
    {
        $this->setData(self::NOTI_ID,$id);
        return $this;
    }

    public function setContent($content)
    {
        $this->setData(self::CONTENT,$content);
        return $this;
    }

    public function setCustomerID($customerID)
    {
        $this->setData(self::CUSTOMER_ID,$customerID);
        return $this;
    }

    public function setPostID($postID)
    {
        $this->setData(self::POST_ID,$postID);
        return $this;
    }

    public function setCreationTime($creatTime)
    {
        $this->setData(self::CREATION_TIME,$creatTime);
        return $this;
    }
}