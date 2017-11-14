<?php

namespace yuncms\coin\migrations;

use yii\db\Migration;

class M171114105503Create_coin_recharge_table extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%coin_recharge}}', [
            'id' => $this->primaryKey()->unsigned()->comment('ID'),
            'payment_id' => $this->string()->unsigned()->comment('Payment Id'),
            'user_id' => $this->integer()->unsigned()->comment('User Id'),
            'name' => $this->integer()->comment('Name'),
            'gateway' => $this->string(50)->notNull()->comment('Gateway'),
            'currency' => $this->string(20)->notNull()->comment('Currency'),
            'money' => $this->decimal(10, 2)->notNull()->defaultValue(0.00)->comment('Money'),
            'trade_state' => $this->smallInteger()->notNull()->comment('Trade State'),
            'trade_type' => $this->smallInteger()->notNull()->comment('Trade Type'),
            'created_at' => $this->integer()->unsigned()->notNull()->comment('Created At'),
            'updated_at' => $this->integer()->unsigned()->notNull()->comment('Updated At'),
        ], $tableOptions);

        $this->addForeignKey('{{%coin_recharge_fk_1}}', '{{%coin_recharge}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');

    }

    public function safeDown()
    {
        $this->dropTable('{{%coin_recharge}}');
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M171114105503Create_coin_recharge_table cannot be reverted.\n";

        return false;
    }
    */
}
