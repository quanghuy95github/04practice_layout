<?php 
namespace OpenTechiz\Banner\Model;

class Banner  extends \Magento\Framework\Model\AbstractModel
{
	/**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('OpenTechiz\Banner\Model\ResourceModel\Banner');
    }
}