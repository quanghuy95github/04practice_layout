<?php
namespace OpenTechiz\Banner\Setup;
 
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function upgrade(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;

        $installer->startSetup();
        if (version_compare($context->getVersion(), "1.0.0", "<")) {
        //Your upgrade script
        }
        if (version_compare($context->getVersion(), '1.0.3', '<')) {
          $installer->getConnection()->addColumn(
                $installer->getTable('banner'),
                'sort_order',
                [
                    'type' => Table::TYPE_SMALLINT,
                    'length' => 6,
                    'nullable' => true,
                    'comment' => 'Order banner'
                ]
            );
          $installer->getConnection()->addColumn(
                $installer->getTable('banner'),
                'status',
                [
                    'type' => Table::TYPE_SMALLINT,
                    'length' => 1,
                    'nullable' => true,
                    'comment' => 'status banner'
                ]
            );
        }
        $installer->endSetup();
    }
}