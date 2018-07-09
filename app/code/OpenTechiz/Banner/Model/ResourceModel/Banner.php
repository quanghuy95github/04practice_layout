<?php
namespace OpenTechiz\Banner\Model\ResourceModel;

/**
 * Blog post mysql resource
 */
class Banner extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

	/**
     * Initialize resource model table name+ primary
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('banner', 'id');
    }
}
