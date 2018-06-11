<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m180609_195628_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "CREATE TABLE IF NOT EXISTS product(
    uuid varchar(255) not null,
    name varchar(255) not null,
    length enum('1', '2', '3', '4', '5') not null default '1',
    width enum('1', '2', '3', '4', '5') not null default '1',
    height enum('1', '2', '3', '4', '5') not null default '1',
    primary key (uuid)
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
        $this->dropTable('product');
    }
}
