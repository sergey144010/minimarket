<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m180609_194807_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "CREATE TABLE IF NOT EXISTS category(
                  uuid varchar(255) not null,
                  name varchar(255) not null,
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
        $this->dropTable('category');
    }
}
