<?php 
namespace OpenTechiz\Banner\Model;

class Banner  extends \Magento\Framework\Model\AbstractModel
{

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 0;

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