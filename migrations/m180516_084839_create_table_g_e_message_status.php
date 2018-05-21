<?php

use yii\db\Migration;

/**
 * Class m180516_084839_create_table_g_e_message_status
 */
class m180516_084839_create_table_g_e_message_status extends Migration
{
       /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%g_e_message_status}}', [
            'id' => $this->primaryKey(11),
            'name' => $this->string(50)->notNull()->comment('Наименование'),
            'note' => $this->string(100)->null()->comment('Примечание'),
        ], 'ENGINE=InnoDB');

        $this->addCommentOnTable('{{%g_e_message_status}}', 'Перечисление статусов сообщений');

        /**
         * Убираем автоинкримент
         */
        $sql = "ALTER TABLE {{%g_e_message_status}} CHANGE `id` `id` INT(11) NOT NULL";
        $this->execute($sql);

        $this->insert('{{%g_e_message_status}}', [
            'id' => 0,
            'name' => 'Не определен',
            'note' => 'STATUS_DAFAULT - Статус по умолчанию',
        ]);

        $this->insert('{{%g_e_message_status}}', [
            'id' => 100,
            'name' => 'Сообщение отправлено',
            'note' => 'STATUS_SEND - Сообщение успешно отправлено адресату',
        ]);

        $this->insert('{{%g_e_message_status}}', [
            'id' => 800,
            'name' => 'Ошибка отправки сообщения',
            'note' => 'STATUS_ERROR - Не удалось отправить сообщение',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%g_e_message_status}}');
    }
}
