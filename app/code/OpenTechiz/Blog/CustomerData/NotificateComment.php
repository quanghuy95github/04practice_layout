<?php
namespace OpenTechiz\Blog\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;
use Magento\Framework\DataObject;

class NotificateComment extends DataObject implements SectionSourceInterface
{
    protected $_cmtCollectionFactory;
    protected $_customerSession;

    public function __construct(
        \OpenTechiz\Blog\Model\ResourceModel\Comment\CollectionFactory $cmtCollectionFactory,
        \Magento\Customer\Model\Session $customerSession
    )
    {
        $this->_cmtCollectionFactory = $cmtCollectionFactory;
        $this->_customerSession = $customerSession;
    }

    public function getSectionData()
    {
        if($this->_customerSession->isLoggedIn())
        {
            $customer = $this->_customerSession->getCustomer();
            $customer_id = $customer->getId();
            // get count comment not active
            $countComment = $this->_cmtCollectionFactory->create()
                ->addFieldToFilter('customer_id', $customer_id)
                ->addFieldToFilter('is_active', '0')
                ->count();
            if($countComment > 0)
            {
                $cmtCount = ['getCmtCount' => "Comment no active: $countComment"];
            }else $cmtCount = ['getCmtCount' => "0"];
            return $cmtCount;

        }
        else
        {
            $cmtCount = ['getCmtCount' => "0"];
            return $cmtCount;
        }

    }
} 