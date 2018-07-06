<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace OpenTechiz\Banner\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /**
         * Create table 'banner'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('banner')
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'primary' => true, 'identity' => true],
            'Banner ID'
        )->addColumn(
            'image',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Image Banner'
        )->addColumn(
            'link',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Image Banner'
        )->addIndex($installer->getIdxName('banner_index', ['image']), ['image'])
        ->setComment('Banner');
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
