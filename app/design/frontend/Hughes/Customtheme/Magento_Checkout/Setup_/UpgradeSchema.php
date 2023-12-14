<?php

namespace Magento_Checkout\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $quoteAddressTable = 'quote';
        $orderTable = 'sales_order';

        //Quote address table
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteAddressTable),
                'custom_test',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' =>'Custom Test'
                ]
            );
        //Order address table
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($orderTable),
                'custom_test',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' =>'Custom Test'

                ]
            );

        $setup->endSetup();
    }
}