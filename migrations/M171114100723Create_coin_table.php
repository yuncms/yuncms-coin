<?php

namespace yuncms\coin\migrations;

use yii\db\Migration;

class M171114100723Create_coin_table extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%coins}}', [
            'id' => $this->primaryKey()->unsigned()->comment('ID'),
            'user_id' => $this->integer()->unsigned()->notNull()->comment('User Id'),
            'action' => $this->string(100)->notNull()->comment('Action'),
            'model_id' => $this->integer()->comment('Model Id'),
            'model_subject' => $this->string()->comment('Model Subject'),
            'coins' => $this->decimal(8, 2)->defaultValue('0.00')->notNull()->comment('Coins'),
            'created_at' => $this->integer()->unsigned()->notNull()->comment('Created At'),
        ], $tableOptions);

        $this->addForeignKey('{{%coins_fk_1}}', '{{%coins}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%coins}}');
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M171114100723Create_coin_table cannot be reverted.\n";

        return false;
    }
    */
}
