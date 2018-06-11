<?php

use yii\db\Migration;

/**
 * Handles the creation of table `relation_product_category`.
 */
class m180609_195805_create_relation_product_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "CREATE TABLE IF NOT EXISTS relation_product_category(
    uuid_product varchar(255) not null,
    uuid_category varchar(255) not null,
    primary key (uuid_product)
)
engine = innodb
CHARACTER SET utf8
COLLATE utf8_general_ci;";

        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('relation_product_category');
    }
}
