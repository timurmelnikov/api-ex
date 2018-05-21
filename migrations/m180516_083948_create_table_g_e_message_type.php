<?php

use yii\db\Migration;

/**
 * Class m180516_084839_create_table_g_e_message_type
 */
class m180516_083948_create_table_g_e_message_type extends Migration
{
       /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%g_e_message_type}}', [
            'id' => $this->primaryKey(11),
            'name' => $this->string(50)->notNull()->comment('Наименование'),
            'note' => $this->string(100)->null()->comment('Примечание'),
        ], 'ENGINE=InnoDB');

        $this->addCommentOnTable('{{%g_e_message_type}}', 'Перечисление типов сообщений');

        /**
         * Убираем автоинкримент
         */
        $sql = "ALTER TABLE {{%g_e_message_type}} CHANGE `id` `id` INT(11) NOT NULL";
        $this->execute($sql);

        $this->insert('{{%g_e_message_type}}', [
            'id' => 1,
            'name' => 'e-mail',
            'note' => 'Сообщение электронной почты',
        ]);

        $this->insert('{{%g_e_message_type}}', [
            'id' => 2,
            'name' => 'СМС',
            'note' => 'Сообщение СМС',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%g_e_message_type}}');
    }
}
