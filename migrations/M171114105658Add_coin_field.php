<?php

namespace yuncms\coin\migrations;

use yii\db\Migration;

class M171114105658Add_coin_field extends Migration
{

    public function safeUp()
    {
        $this->addColumn('{{%user_extra}}', 'coins', $this->integer()->unsigned()->defaultValue(0)->comment('Coins'));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%user_extra}}', 'coins');
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M171114105658Add_coin_field cannot be reverted.\n";

        return false;
    }
    */
}
