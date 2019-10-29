<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%catalog}}`.
 */
class m191029_090501_add_status_column_to_catalog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%catalog}}', 'status', $this->boolean()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%catalog}}', 'status');
    }
}
