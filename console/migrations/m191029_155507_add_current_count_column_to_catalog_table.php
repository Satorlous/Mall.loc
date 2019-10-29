<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%catalog}}`.
 */
class m191029_155507_add_current_count_column_to_catalog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%catalog}}', 'current_count', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%catalog}}', 'current_count');
    }
}
