<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%catalog}}`.
 */
class m191028_151240_create_catalog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%catalog}}', [
            'id' => $this->primaryKey(),
            'good_id' => $this->integer()->notNull(),
            'req_count' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'FK_good_id',  // это "условное имя" ключа
            'catalog', // это название текущей таблицы
            'good_id', // это имя поля в текущей таблице, которое будет ключом
            'goods', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE', // что делать при удалении сущности, на которую ссылаемся
            'CASCADE'  // что делать при обновлении сущности, на которую ссылаемся
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%catalog}}');
        $this->dropForeignKey(
            'FK_good_id',
            'catalog'
        );
    }
}
