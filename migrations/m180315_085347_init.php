<?php

use yii\db\Migration;

/**
 * Начальная инициализация БД приложения.
 */
class m180315_085347_init extends Migration
{

    /**
     * Тип движка таблиц для начальной инициализации
     *
     * @var string
     */
    private $tableOptions = 'ENGINE=InnoDB';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->сreateF1Contract();
        $this->createF1ContractMove();
        $this->сreateF1Claim();
        $this->сreateF1ClaimMove();
        $this->сreateGMessage();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%f1_contract_move}}');
        $this->dropTable('{{%f1_contract}}');
        $this->dropTable('{{%f1_claim_move}}');
        $this->dropTable('{{%f1_claim}}');
        $this->dropTable('{{%g_message}}');
    }

    /**
     * Создание таблицы f1_contract
     *
     * @return null
     */
    private function сreateF1Contract()
    {
        $this->createTable(
            '{{%f1_contract}}',
            [
                'id' => $this->primaryKey(11),
                'reg_date' => $this->date()->notNull()->comment('Дата регистрации'), //reqDate
                'tl_code' => $this->string(5)->notNull()->comment('Технология страхования'), //tlCode
                'req_id' => $this->string(20)->notNull()->comment('ID договора'), //reqId
                'ref' => $this->string(20)->notNull()->comment('№ договора'), //ref
                'status_deal' => $this->integer(11)->notNull()->comment('Текущий статус'), //statusDeal
                'id_cis' => $this->integer(11)->null()->defaultValue(null)->comment('ID КИС'),
            ],
            $this->tableOptions
        );
        $this->addCommentOnTable('{{%f1_contract}}', 'Договоры страхования');
        $this->createIndex('idx_unique', '{{%f1_contract}}', ['req_id', 'ref'], true);
        $this->createIndex('idx_code', '{{%f1_contract}}', ['tl_code'], false);
    }

    /**
     * Создание таблицы f1_contract_move
     *
     * @return null
     */
    private function createF1ContractMove()
    {
        $this->createTable('
        {{%f1_contract_move}}',
            [
                'id' => $this->primaryKey(11),
                'contract_id' => $this->integer(11)->notNull()->comment('ID договора'),
                'date_report' => $this->date()->notNull()->comment('Дата отчета'), //date
                'data_json' => $this->text()->notNull()->comment('Данные JSON'),
                'status_deal' => $this->integer(11)->notNull()->comment('Статус'), //statusDeal
                'is_current' => $this->integer(1)->notNull()->defaultValue(0)->comment('Является текущим'),
                'insert_date' => $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP")->comment('Дата создания записи'),
                'send_cis_date' => $this->datetime()->null()->defaultValue(null)->comment('Дата успешной отправки в КИС'),
                'send_cis_message' => $this->text()->notNull()->comment('Сообщение об отправке в КИС'),
                'send_cis_status_id' => $this->integer(11)->notNull()->comment('Статус отправки в КИС'),
            ],
            $this->tableOptions
        );
        $this->addCommentOnTable('{{%f1_contract_move}}', 'История статусов договоров страхования');
    }

    /**
     * Создание таблицы f1_claim
     *
     * @return null
     */
    private function сreateF1Claim()
    {
        $this->createTable(
            '{{%f1_claim}}',
            [
                'id' => $this->primaryKey(11),
                'reg_date' => $this->datetime()->notNull()->comment('Регистрация в ПБ'),
                'doc_type' => $this->string(5)->notNull()->comment('Тип договора'),
                'doc_num_pb' => $this->string(20)->notNull()->comment('№ договора'),
                'claim_id_pb' => $this->string(20)->notNull()->comment('ID заявки ПБ'),
                'claim_data' => $this->text()->notNull()->comment('Данные заявки'),
                'current_status' => $this->integer(11)->notNull()->comment('Текущий статус'),
                'insert_date' => $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP")->comment('Дата вставки в буфер'),
                'change_date' => $this->datetime()->null()->defaultExpression("CURRENT_TIMESTAMP")->comment('Дата изменения'),
                'loss_id_cis' => $this->integer(11)->null()->defaultValue(null)->comment('ID убытка КИС'),
            ],
            $this->tableOptions
        );
        $this->addCommentOnTable('{{%f1_claim}}', 'Заявки на страховые случаи ПБ');
        $this->createIndex('unique', '{{%f1_claim}}', ['doc_type', 'doc_num_pb', 'claim_id_pb'], true);
    }

    /**
     * Создание таблицы f1_claim_move
     *
     * @return null
     */
    private function сreateF1ClaimMove()
    {
        $this->createTable(
            '{{%f1_claim_move}}',
            [
                'id' => $this->primaryKey(11),
                'claim_id' => $this->integer(11)->notNull()->comment('ID заявки ПБ'),
                'report_date' => $this->date()->notNull()->comment('Дата отчета ПБ'),
                'status' => $this->integer(11)->notNull()->comment('Статус заявки ПБ'),
                'is_current' => $this->integer(1)->notNull()->defaultValue(0)->comment('Является текущим'),
                'insert_date' => $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
                'send_message' => $this->text()->notNull()->comment('Сообщение об отправке во внешнюю систему'),
                'send_status_id' => $this->integer(11)->notNull()->defaultValue(0)->comment('Статус отправки во внешнюю систему'),
            ],
            $this->tableOptions
        );
        $this->addCommentOnTable('{{%f1_claim_move}}', 'История статусов заявок на страховые случаи ПБ');
        $this->createIndex('claim_id', '{{%f1_claim_move}}', ['claim_id'], false);
        $this->addForeignKey('fk_f1_claim_move_claim_id',
            '{{%f1_claim_move}}', 'claim_id',
            '{{%f1_claim}}', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    private function сreateGMessage()
    {
        $this->createTable(
            '{{%g_message}}',
            [
                'id' => $this->primaryKey(11),
                'message_type_id' => $this->integer(11)->notNull()->comment('ID типа'),
                'message_status_id' => $this->integer(1)->notNull()->defaultValue(0)->comment('ID статуса'),
                'message_status_text' => $this->text()->notNull()->comment('Сообщение об отправке или ошибке'),
                'subject' => $this->string(250)->notNull()->comment('Тема'),
                'body' => $this->text()->notNull()->comment('Текст сообщения'),
                'send_to' => $this->string(250)->notNull()->comment('Кому (через ","'),
                'insert_date' => $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP")->comment('Дата создания'),
                'send_after' => $this->datetime()->notNull()->comment('Отправить после'),
                'send_date' => $this->datetime()->comment('Дата отправки'),
            ],
            $this->tableOptions
        );
    }
}
