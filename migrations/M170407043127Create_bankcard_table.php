<?php

namespace yuncms\wallet\migrations;

use yii\db\Migration;

class M170407043127Create_bankcard_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%bankcard}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'bank' => $this->string()->comment('银行名称'),
            'city' => $this->string()->comment('开户城市'),
            'username' => $this->string()->comment('开户名'),
            'name' => $this->string()->comment('开户行'),
            'number' => $this->string()->comment('银行卡号'),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);
        $this->addForeignKey('{{%bankcard_ibfk_1}}', '{{%bankcard}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%bankcard}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
