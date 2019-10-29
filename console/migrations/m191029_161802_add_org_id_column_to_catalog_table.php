<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%catalog}}`.
 */
class m191029_161802_add_org_id_column_to_catalog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%catalog}}', 'org_id', $this->integer());

        $this->addForeignKey(
            'FK_org_id',  // это "условное имя" ключа
            'catalog', // это название текущей таблицы
            'org_id', // это имя поля в текущей таблице, которое будет ключом
            'user', // это имя таблицы, с которой хотим связаться
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
        $this->dropColumn('{{%catalog}}', 'org_id');
        $this->dropForeignKey(
            'FK_org_id',
            'catalog'
        );
    }
}
