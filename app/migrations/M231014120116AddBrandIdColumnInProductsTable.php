<?php

namespace app\migrations;

use yii\db\Migration;

/**
 * Class M231014120116AddBrandIdColumnInProductsTable
 */
class M231014120116AddBrandIdColumnInProductsTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product', 'brand_id', $this->integer()->null());

        $this->createIndex('idx-product-brand_id', 'product', 'brand_id');
        $this->addForeignKey(
            'fk-product-brand_id',
            'product',
            'brand_id',
            'brands',
            'id',
            'SET NULL',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('product', 'brand_id');

        // drops foreign key for table `product`
        $this->dropForeignKey(
            'fk-product-brand_id',
            'product'
        );

        // drops index for column `brand_id`
        $this->dropIndex(
            'idx-product-brand_id',
            'product'
        );
    }

}
