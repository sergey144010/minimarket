<?php

use yii\db\Migration;

/**
 * Handles the creation of table `vendor`.
 */
class m180609_195917_create_vendor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "CREATE TABLE IF NOT EXISTS vendor(
    uuid varchar(255) not null,
    name varchar(255) not null,
    range_min int(3) not null,
    range_max int(3) not null,
    price int(11) not null,
    balance int(11) not null,
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
        $this->dropTable('vendor');
    }
}
