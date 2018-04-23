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
            'id_status' => $this->integer(11)->notNull()->comment('ID статуса отправки в КИС'),
            'name' => $this->string(50)->notNull()->comment('Наименование'),
            'note' => $this->string(100)->null()->comment('Примечание'),
        ], 'ENGINE=InnoDB');

        $this->createIndex('idx_unique_id_status', '{{%g_e_send_cis_status}}', ['id_status'], true);
        $this->addCommentOnTable('{{%g_e_send_cis_status}}', 'Перечисление статусов отправки в КИС');

        /**
         * FIXME: перенести в документацию (скорее всего в модель для таблицы g_e_send_cis_status)!!!
         * 0   - Статус по умолчанию
         * 100 - успех попадания в КИС
         * 200 - нет необходимости отправки в КИС (дубликат, "незаливабельный статус")
         * 300 - ПреСендер
         * 800 - невозможность попадания в КИС (ошибка)
         * 900 - мои статусы (игнорировать)
         */

        $this->insert('{{%g_e_send_cis_status}}', [
            'id_status' => 0,
            'name' => 'Не определен',
            'note' => 'Статус по умолчанию',
        ]);

        $this->insert('{{%g_e_send_cis_status}}', [
            'id_status' => 100,
            'name' => 'Отправлен',
            'note' => 'Успешно отправлен в КИС и подписан',
        ]);

        $this->insert('{{%g_e_send_cis_status}}', [
            'id_status' => 101,
            'name' => 'Отправлен (не подписан)',
            'note' => 'Успешно отправлен в КИС, но не подписан',
        ]);

        $this->insert('{{%g_e_send_cis_status}}', [
            'id_status' => 200,
            'name' => 'Не нужен',
            'note' => 'Нет необходимости в отправке в КИС',
        ]);

        $this->insert('{{%g_e_send_cis_status}}', [
            'id_status' => 201,
            'name' => 'Дубликат',
            'note' => 'Уже существует в КИС',
        ]);

        $this->insert('{{%g_e_send_cis_status}}', [
            'id_status' => 300,
            'name' => 'Обработан ПреСендером',
            'note' => 'Обработан ПреСендером и может заливаться в КИС',
        ]);

        $this->insert('{{%g_e_send_cis_status}}', [
            'id_status' => 800,
            'name' => 'Ошибка',
            'note' => 'В КИС не создан по причине ошибки',
        ]);

        $this->insert('{{%g_e_send_cis_status}}', [
            'id_status' => 801,
            'name' => 'Ошибка Пресендера',
            'note' => 'Не удалось подготовить данные для отправки в КИС',
        ]);

        $this->insert('{{%g_e_send_cis_status}}', [
            'id_status' => 900,
            'name' => 'Игнорировать',
            'note' => 'Игнорировать отправку в КИС',
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
