<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace OpenTechiz\Blog\Model\Block\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class IsActive
 */
class IsActive implements OptionSourceInterface
{
    /**
     * @var \Magento\Cms\Model\Block
     */
    protected $commentBlock;

    /**
     * Constructor
     *
     * @param \Magento\Cms\Model\Block $cmsBlock
     */
    public function __construct(\OpenTechiz\Blog\Model\Comment $commentBlock)
    {
        $this->commentBlock = $commentBlock;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->commentBlock->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
