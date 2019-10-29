<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%cart_items}}`.
 */
class m191029_160415_add_ordered_count_column_to_cart_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%cart_items}}', 'ordered', $this->boolean()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%cart_items}}', 'ordered');
    }
}
