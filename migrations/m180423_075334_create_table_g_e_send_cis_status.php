<?php

use yii\db\Migration;

/**
 * Class m180423_075334_create_table_g_e_send_cis_status
 */
class m180423_075334_create_table_g_e_send_cis_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%g_e_send_cis_status}}', [
            'id' => $this->primaryKey(11),
            'name' => $this->string(50)->notNull()->comment('Наименование'),
            'note' => $this->string(100)->null()->comment('Примечание'),
        ], 'ENGINE=InnoDB');

        $this->addCommentOnTable('{{%g_e_send_cis_status}}', 'Перечисление статусов отправки в КИС');


        


         /**
         * Убираем автоинкримент
         */
        $sql = "ALTER TABLE {{%g_e_send_cis_status}} CHANGE `id` `id` INT(11) NOT NULL";
        $this->execute($sql);


        $this->insert('{{%g_e_send_cis_status}}', [
            'id' => 0,
            'name' => 'Не определен',
            'note' => 'STATUS_DAFAULT - Статус по умолчанию',
        ]);

        $this->insert('{{%g_e_send_cis_status}}', [
            'id' => 100,
            'name' => 'Отправлен',
            'note' => 'STATUS_SEND - Успешно отправлен в КИС и подписан',
        ]);

        $this->insert('{{%g_e_send_cis_status}}', [
            'id' => 101,
            'name' => 'Отправлен (не подписан)',
            'note' => 'STATUS_SEND_NO_SIGN - Успешно отправлен в КИС, но не подписан',
        ]);

        $this->insert('{{%g_e_send_cis_status}}', [
            'id' => 200,
            'name' => 'Не нужен',
            'note' => 'STATUS_NOT_NEEDED - Нет необходимости в отправке в КИС',
        ]);

        $this->insert('{{%g_e_send_cis_status}}', [
            'id' => 201,
            'name' => 'Дубликат',
            'note' => 'STATUS_DUPLICATE - Уже существует в КИС',
        ]);

        $this->insert('{{%g_e_send_cis_status}}', [
            'id' => 300,
            'name' => 'Обработан ПреСендером',
            'note' => 'STATUS_PROCESSED_PRESENDER - Обработан ПреСендером и может заливаться в КИС',
        ]);

        $this->insert('{{%g_e_send_cis_status}}', [
            'id' => 800,
            'name' => 'Ошибка',
            'note' => 'STATUS_ERROR - Не удалось отправить в КИС',
        ]);

        $this->insert('{{%g_e_send_cis_status}}', [
            'id' => 801,
            'name' => 'Ошибка Пресендера',
            'note' => 'STATUS_ERROR_PRESENDER - Не удалось подготовить Пресендером данные для отправки в КИС',
        ]);

        $this->insert('{{%g_e_send_cis_status}}', [
            'id' => 900,
            'name' => 'Игнорировать',
            'note' => 'STATUS_IGNORE - Игнорировать отправку в КИС',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%g_e_send_cis_status}}');
    }

}
