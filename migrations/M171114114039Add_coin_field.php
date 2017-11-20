<?php

namespace yuncms\coin\migrations;

use yii\db\Migration;

class M171114114039Add_coin_field extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%test}}', [
            'id' => $this->primaryKey(),
            //'user_id' => $this->integer()->comment('用户ID'),
            'status' => $this->smallInteger(1)->defaultValue(0)->comment('状态'),
            'published_at' => $this->integer(10)->unsigned()->comment('发布时间'),
            'created_at' => $this->integer(10)->unsigned()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer(10)->unsigned()->notNull()->comment('更新时间'),
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%test}}');
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M171114114039Add_coin_field cannot be reverted.\n";

        return false;
    }
    */
}
