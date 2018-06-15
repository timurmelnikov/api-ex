<?php

use yii\db\Migration;

/**
 * Class m180615_081142_migrate
 */
class m180615_081142_migrate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {


        $this->insert('{{%g_e_send_cis_status}}', [
            'id' => 102,
            'name' => 'Удален',
            'note' => 'STATUS_DELETED - Успешно удален из КИС',
        ]);


        $this->insert('{{%g_e_send_cis_status}}', [
            'id' => 202,
            'name' => 'Отсутствует',
            'note' => 'STATUS_ABSENT - Нет необходимости удаления из КИС',
        ]);


        $this->addCommentOnTable('{{%g_message}}', 'Сообщения');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180615_081142_migrate cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180615_081142_migrate cannot be reverted.\n";

        return false;
    }
    */
}
