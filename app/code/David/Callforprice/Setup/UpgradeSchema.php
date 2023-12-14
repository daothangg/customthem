<?php
namespace David\Callforprice\Setup;


use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
	
	 public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
		if(version_compare($context->getVersion(), '1.0.4', '<')) {
		  
		
			$installer->getConnection()->addColumn(
				$installer->getTable('david_callforprice_request'),
				'comment',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
				[
					'nullable' => false
                ],
                'Comment'
			);
            $installer->getConnection()->addColumn(
				$installer->getTable('david_callforprice_request'),
				'details',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
				[
					'nullable' => false
                ],
                'details'
			);
            $setup->getConnection()->dropColumn($setup->getTable('david_callforprice_request'), 'details');
            $setup->getConnection()->dropColumn($setup->getTable('david_callforprice_request'), 'comment');
		}
        $setup->endSetup();
    }
}
