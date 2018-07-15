<?php 
namespace OpenTechiz\Blog\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        // create tabel comment
        $table = $installer->getConnection()
            ->newTable($installer->getTable('opentechiz_blog_comment'))
            ->addColumn(
                'comment_id',
                Table::TYPE_SMALLINT,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Comment ID'
            )
            ->addColumn('content', Table::TYPE_TEXT, 255, ['nullable' => true, 'default' => null])
            ->addColumn('post_id', Table::TYPE_INTEGER, null, [], 'ID Post have this comment')
            ->addColumn('customer_id', Table::TYPE_INTEGER, null, [], 'id of customer for this comment')
            ->addColumn('creation_time', Table::TYPE_DATETIME, null, ['nullable' => false], 'Creation Time')
            ->addColumn('update_time', Table::TYPE_DATETIME, null, ['nullable' => false], 'Update Time')
            ->setComment('Comment Blog Posts');

        $installer->getConnection()->createTable($table);

        // add column email
        if (version_compare($context->getVersion(), '1.5.0', '<')) {
          $installer->getConnection()->addColumn(
                $installer->getTable('opentechiz_blog_comment'),
                'email',
                [
                    'type' => Table::TYPE_TEXT,
                    'length' => 255,
                    'nullable' => true,
                    'comment' => 'Email admin'
                ]
            );
        }

        // add column status
        if (version_compare($context->getVersion(), '1.5.0', '<')) {
          $installer->getConnection()->addColumn(
                $installer->getTable('opentechiz_blog_comment'),
                'is_active',
                [
                    'type' => Table::TYPE_SMALLINT,
                    'length' => null,
                    'nullable' => true,
                    'comment' => 'Email admin'
                ]
            );
        }

        $installer->endSetup();
    }

}
