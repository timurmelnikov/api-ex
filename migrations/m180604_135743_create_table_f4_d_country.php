<?php

use yii\db\Migration;

/**
 * Class m180604_135743_create_table_f4_d_country
 */
class m180604_135743_create_table_f4_d_country extends Migration
{

    /**
     * Тип движка таблиц
     *
     * @var string
     */
    private $tableOptions = 'ENGINE=InnoDB';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable(
            '{{%f4_d_country}}',
            [
                'id' => $this->primaryKey(11),
                'id_country' => $this->integer(11)->notNull()->comment('ID страны (Сиеста)'),
                'country_name_rus' => $this->string(50)->notNull()->comment('Наименование страны'),
                'code' => $this->string(2)->notNull()->comment('Код страны'),

            ],
            $this->tableOptions
        );

        $this->addCommentOnTable('{{%f4_d_country}}', 'Словарь стран для Сиеста');

        $this->createIndex('idx_unique_id_country', '{{%f4_d_country}}', ['id_country'], true);
        $this->createIndex('idx_unique_code', '{{%f4_d_country}}', ['code'], true);
       
        $this->insert('{{%f4_d_country}}', ['id_country' => 1, 'country_name_rus' => 'Украина', 'code'=>'UA']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 2, 'country_name_rus' => 'Россия', 'code'=>'RU']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 3, 'country_name_rus' => 'Германия', 'code'=>'DE']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 4, 'country_name_rus' => 'США', 'code'=>'US']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 5, 'country_name_rus' => 'Белорусь', 'code'=>'BY']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 6, 'country_name_rus' => 'Молдова', 'code'=>'MD']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 7, 'country_name_rus' => 'ЮАР', 'code'=>'ZA']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 8, 'country_name_rus' => 'Узбекистан', 'code'=>'UZ']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 9, 'country_name_rus' => 'Казахстан', 'code'=>'KZ']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 10, 'country_name_rus' => 'Ангола', 'code'=>'AO']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 11, 'country_name_rus' => 'Канада', 'code'=>'CA']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 12, 'country_name_rus' => 'Европа', 'code'=>'EU']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 13, 'country_name_rus' => 'Турция', 'code'=>'TR']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 14, 'country_name_rus' => 'Латвия', 'code'=>'LV']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 15, 'country_name_rus' => 'Израиль', 'code'=>'IL']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 16, 'country_name_rus' => 'Литва', 'code'=>'LT']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 17, 'country_name_rus' => 'Вьетнам', 'code'=>'VN']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 18, 'country_name_rus' => 'Армения', 'code'=>'AM']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 19, 'country_name_rus' => 'Польша', 'code'=>'PL']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 20, 'country_name_rus' => 'Палестина', 'code'=>'PS']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 21, 'country_name_rus' => 'Швеция', 'code'=>'SW']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 23, 'country_name_rus' => 'Азейрбаджан', 'code'=>'AZ']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 24, 'country_name_rus' => 'Куба', 'code'=>'CU']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 25, 'country_name_rus' => 'Сирия', 'code'=>'SY']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 28, 'country_name_rus' => 'Абхазия', 'code'=>'A']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 29, 'country_name_rus' => 'Ирак', 'code'=>'IQ']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 30, 'country_name_rus' => 'Ливан', 'code'=>'LB']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 31, 'country_name_rus' => 'Перу', 'code'=>'PE']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 33, 'country_name_rus' => 'Румыния', 'code'=>'RO']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 34, 'country_name_rus' => 'Чехия', 'code'=>'CZ']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 35, 'country_name_rus' => 'Австралия', 'code'=>'AU']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 36, 'country_name_rus' => 'Австрия', 'code'=>'AT']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 37, 'country_name_rus' => 'Азорские острова', 'code'=>'P']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 38, 'country_name_rus' => 'Аландские острова', 'code'=>'AX']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 39, 'country_name_rus' => 'Албания', 'code'=>'AL']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 40, 'country_name_rus' => 'Алжир', 'code'=>'DZ']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 41, 'country_name_rus' => 'Американское Самоа', 'code'=>'AS']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 42, 'country_name_rus' => 'Ангилья', 'code'=>'AI']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 43, 'country_name_rus' => 'Андорра', 'code'=>'AD']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 44, 'country_name_rus' => 'Антигуа и Барбуда', 'code'=>'AG']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 45, 'country_name_rus' => '', 'code'=>'AN']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 46, 'country_name_rus' => 'Макао', 'code'=>'MO']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 48, 'country_name_rus' => 'Аруба', 'code'=>'AW']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 49, 'country_name_rus' => 'Афганистан', 'code'=>'AF']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 50, 'country_name_rus' => 'Багамские острова', 'code'=>'BS']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 51, 'country_name_rus' => 'Бангладеш', 'code'=>'BD']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 52, 'country_name_rus' => 'Барбадос', 'code'=>'BB']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 53, 'country_name_rus' => 'Бахрейн', 'code'=>'BH']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 54, 'country_name_rus' => 'Белиз', 'code'=>'BZ']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 55, 'country_name_rus' => 'Бельгия', 'code'=>'BE']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 56, 'country_name_rus' => 'Бенин', 'code'=>'BJ']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 57, 'country_name_rus' => 'Бермудские острова', 'code'=>'BM']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 58, 'country_name_rus' => 'Болгария', 'code'=>'BG']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 59, 'country_name_rus' => 'Боливия', 'code'=>'BO']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 60, 'country_name_rus' => 'Босния и Герцеговина', 'code'=>'BA']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 61, 'country_name_rus' => 'Ботсвана', 'code'=>'BW']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 62, 'country_name_rus' => 'Бразилия', 'code'=>'BR']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 63, 'country_name_rus' => 'Британская территория в Индийском океане', 'code'=>'IO']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 64, 'country_name_rus' => 'Бруней', 'code'=>'BN']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 65, 'country_name_rus' => 'Буркина Фасо', 'code'=>'BF']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 66, 'country_name_rus' => 'Бурунди', 'code'=>'BI']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 67, 'country_name_rus' => 'Бутан', 'code'=>'BT']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 68, 'country_name_rus' => 'Вануату', 'code'=>'VU']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 69, 'country_name_rus' => 'Ватикан', 'code'=>'VA']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 70, 'country_name_rus' => 'Великобритания', 'code'=>'GB']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 71, 'country_name_rus' => 'Венгрия', 'code'=>'HU']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 72, 'country_name_rus' => 'Венесуэла', 'code'=>'VE']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 73, 'country_name_rus' => 'Виргинские острова (Британские)', 'code'=>'VG']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 74, 'country_name_rus' => 'Виргинские острова (Американские)', 'code'=>'VI']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 75, 'country_name_rus' => 'Внешние малые острова (США)', 'code'=>'UM']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 76, 'country_name_rus' => 'Восточный Тимор', 'code'=>'TL']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 77, 'country_name_rus' => 'Габон', 'code'=>'GA']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 79, 'country_name_rus' => 'Гаити', 'code'=>'HT']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 80, 'country_name_rus' => 'Гайана', 'code'=>'GY']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 81, 'country_name_rus' => 'Гамбия', 'code'=>'GM']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 82, 'country_name_rus' => 'Гана', 'code'=>'GH']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 83, 'country_name_rus' => 'Гваделупа', 'code'=>'GP']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 84, 'country_name_rus' => 'Гватемала', 'code'=>'GT']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 85, 'country_name_rus' => 'Гвинея', 'code'=>'GN']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 86, 'country_name_rus' => 'Гвинея-Бисау', 'code'=>'GW']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 87, 'country_name_rus' => 'Гернси', 'code'=>'GG']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 88, 'country_name_rus' => 'Гибралтар', 'code'=>'GI']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 89, 'country_name_rus' => 'Гондурас', 'code'=>'HN']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 90, 'country_name_rus' => 'Гонконг', 'code'=>'HK']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 91, 'country_name_rus' => 'Гренада', 'code'=>'GD']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 92, 'country_name_rus' => 'Гренландия', 'code'=>'GL']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 93, 'country_name_rus' => 'Греция', 'code'=>'GR']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 94, 'country_name_rus' => 'Грузия', 'code'=>'GE']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 95, 'country_name_rus' => 'Гуам', 'code'=>'GU']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 96, 'country_name_rus' => 'Дания', 'code'=>'DK']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 97, 'country_name_rus' => 'Джерси', 'code'=>'JE']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 98, 'country_name_rus' => 'Джибути', 'code'=>'DJ']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 99, 'country_name_rus' => 'Доминика', 'code'=>'DM']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 100, 'country_name_rus' => 'Доминиканская республика', 'code'=>'DO']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 101, 'country_name_rus' => 'Египет', 'code'=>'EG']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 102, 'country_name_rus' => 'Замбия', 'code'=>'ZM']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 103, 'country_name_rus' => 'Сахарская Арабская Демократическая Республика', 'code'=>'EH']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 104, 'country_name_rus' => 'Зимбабве', 'code'=>'ZW']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 105, 'country_name_rus' => 'Индия', 'code'=>'IN']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 106, 'country_name_rus' => 'Индонезия', 'code'=>'ID']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 107, 'country_name_rus' => 'Иордания', 'code'=>'JO']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 108, 'country_name_rus' => 'Иран', 'code'=>'IR']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 109, 'country_name_rus' => 'Ирландия', 'code'=>'IE']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 110, 'country_name_rus' => 'Исландия', 'code'=>'IS']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 111, 'country_name_rus' => 'Испания', 'code'=>'ES']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 112, 'country_name_rus' => 'Италия', 'code'=>'IT']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 113, 'country_name_rus' => 'Йемен', 'code'=>'YE']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 114, 'country_name_rus' => 'Кабо-Верде', 'code'=>'CV']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 115, 'country_name_rus' => 'Каймановы острова', 'code'=>'KY']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 116, 'country_name_rus' => 'Камбоджа', 'code'=>'KH']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 117, 'country_name_rus' => 'Камерун', 'code'=>'CM']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 118, 'country_name_rus' => 'Катар', 'code'=>'QA']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 119, 'country_name_rus' => 'Кения', 'code'=>'KE']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 120, 'country_name_rus' => 'Кипр', 'code'=>'CY']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 121, 'country_name_rus' => 'Киргизстан', 'code'=>'KG']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 122, 'country_name_rus' => 'Кирибати', 'code'=>'KI']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 123, 'country_name_rus' => 'КНР', 'code'=>'CN']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 124, 'country_name_rus' => 'Кокосовые острова', 'code'=>'CC']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 125, 'country_name_rus' => 'Колумбия', 'code'=>'CO']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 126, 'country_name_rus' => 'Коморы', 'code'=>'KM']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 127, 'country_name_rus' => 'Конго', 'code'=>'CG']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 128, 'country_name_rus' => 'Демократическая Республика Конго', 'code'=>'CD']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 129, 'country_name_rus' => 'КНДР', 'code'=>'KP']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 130, 'country_name_rus' => 'Южная Корея', 'code'=>'KR']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 132, 'country_name_rus' => 'Коста-Рика', 'code'=>'CR']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 133, 'country_name_rus' => ' Кот-д’Ивуар', 'code'=>'CI']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 134, 'country_name_rus' => 'Кувейт', 'code'=>'KW']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 135, 'country_name_rus' => 'Острова Кука', 'code'=>'CK']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 136, 'country_name_rus' => 'Лаос', 'code'=>'LA']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 137, 'country_name_rus' => 'Лесото', 'code'=>'LS']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 138, 'country_name_rus' => 'Либерия', 'code'=>'LR']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 139, 'country_name_rus' => 'Ливия', 'code'=>'LY']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 140, 'country_name_rus' => 'Лихтенштейн', 'code'=>'LI']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 141, 'country_name_rus' => 'Люксембург', 'code'=>'LU']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 142, 'country_name_rus' => 'Маврикий', 'code'=>'MU']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 143, 'country_name_rus' => 'Мавритания', 'code'=>'MR']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 144, 'country_name_rus' => 'Мадагаскар', 'code'=>'MG']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 146, 'country_name_rus' => 'Майотта', 'code'=>'YT']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 147, 'country_name_rus' => 'Македония', 'code'=>'MK']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 148, 'country_name_rus' => 'Малави', 'code'=>'MW']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 149, 'country_name_rus' => 'Малайзия', 'code'=>'MY']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 150, 'country_name_rus' => 'Мали', 'code'=>'ML']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 151, 'country_name_rus' => 'Мальдивы', 'code'=>'MV']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 152, 'country_name_rus' => 'Мальта', 'code'=>'MT']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 153, 'country_name_rus' => 'Марокко', 'code'=>'MA']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 154, 'country_name_rus' => 'Мартиника', 'code'=>'MQ']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 155, 'country_name_rus' => 'Маршалловы Острова', 'code'=>'MH']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 156, 'country_name_rus' => 'Мексика', 'code'=>'MX']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 157, 'country_name_rus' => 'Микронезия', 'code'=>'FM']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 158, 'country_name_rus' => 'Мозамбик', 'code'=>'MZ']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 159, 'country_name_rus' => 'Монако', 'code'=>'MC']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 160, 'country_name_rus' => 'Монголия', 'code'=>'MN']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 161, 'country_name_rus' => 'Монтсеррат', 'code'=>'MS']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 162, 'country_name_rus' => 'Мьянма', 'code'=>'MM']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 163, 'country_name_rus' => 'Остров Мэн', 'code'=>'IM']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 165, 'country_name_rus' => 'Намибия', 'code'=>'NA']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 166, 'country_name_rus' => 'Науру', 'code'=>'NR']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 167, 'country_name_rus' => 'Непал', 'code'=>'NP']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 168, 'country_name_rus' => 'Нигер', 'code'=>'NE']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 169, 'country_name_rus' => 'Нигерия', 'code'=>'NG']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 170, 'country_name_rus' => 'Нидерланды', 'code'=>'NL']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 171, 'country_name_rus' => 'Никарагуа', 'code'=>'NI']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 172, 'country_name_rus' => 'Ниуэ', 'code'=>'NU']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 173, 'country_name_rus' => 'Новая Зеландия', 'code'=>'NZ']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 174, 'country_name_rus' => 'Новая Каледония', 'code'=>'NC']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 175, 'country_name_rus' => 'Норвегия', 'code'=>'NO']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 176, 'country_name_rus' => 'Остров Норфолк', 'code'=>'NF']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 177, 'country_name_rus' => 'ОАЭ', 'code'=>'AE']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 178, 'country_name_rus' => 'Оман', 'code'=>'OM']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 179, 'country_name_rus' => 'Пакистан', 'code'=>'PK']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 180, 'country_name_rus' => 'Палау', 'code'=>'PW']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 181, 'country_name_rus' => 'Панама', 'code'=>'PA']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 182, 'country_name_rus' => 'Папуа-Новая Гвинея', 'code'=>'PG']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 183, 'country_name_rus' => 'Парагвай', 'code'=>'PY']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 184, 'country_name_rus' => 'Острова Питкэрн', 'code'=>'PN']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 185, 'country_name_rus' => 'Португалия', 'code'=>'PT']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 187, 'country_name_rus' => 'Пуэрто-Рико', 'code'=>'PR']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 188, 'country_name_rus' => 'Реюньон', 'code'=>'RE']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 189, 'country_name_rus' => 'Остров Рождества', 'code'=>'CX']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 190, 'country_name_rus' => 'Руанда', 'code'=>'RW']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 191, 'country_name_rus' => 'Сальвадор', 'code'=>'SV']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 192, 'country_name_rus' => 'Самоа', 'code'=>'WS']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 193, 'country_name_rus' => 'Сан-Марино', 'code'=>'SM']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 194, 'country_name_rus' => 'Сан-Томе и Принсипи', 'code'=>'ST']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 195, 'country_name_rus' => 'Саудовская Аравия', 'code'=>'SA']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 196, 'country_name_rus' => 'Свазиленд', 'code'=>'SZ']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 198, 'country_name_rus' => ' Острова Святой Елены, Вознесения и Тристан-да-Кунья', 'code'=>'SH']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 199, 'country_name_rus' => 'Северные Марианские острова', 'code'=>'MP']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 201, 'country_name_rus' => 'Сейшельские Острова', 'code'=>'SC']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 202, 'country_name_rus' => 'Сенегал', 'code'=>'SN']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 203, 'country_name_rus' => 'Сен-Пьер и Микелон', 'code'=>'PM']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 204, 'country_name_rus' => 'Сент-Винсент и Гренадины', 'code'=>'VC']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 205, 'country_name_rus' => 'Сент-Китс и Невис', 'code'=>'KN']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 206, 'country_name_rus' => 'Сент-Люсия', 'code'=>'LC']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 207, 'country_name_rus' => 'Сербия', 'code'=>'RS']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 208, 'country_name_rus' => 'Сингапур', 'code'=>'SG']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 209, 'country_name_rus' => 'Словакия', 'code'=>'SK']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 210, 'country_name_rus' => 'Словения', 'code'=>'SI']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 211, 'country_name_rus' => 'Соломоновы Острова', 'code'=>'SB']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 212, 'country_name_rus' => 'Сомали', 'code'=>'SO']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 214, 'country_name_rus' => 'Судан', 'code'=>'SD']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 215, 'country_name_rus' => 'Суринам', 'code'=>'SR']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 216, 'country_name_rus' => 'Сьерра-Леоне', 'code'=>'SL']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 217, 'country_name_rus' => 'Таджикистан', 'code'=>'TJ']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 218, 'country_name_rus' => 'Таиланд', 'code'=>'TH']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 219, 'country_name_rus' => 'Китайская Республика', 'code'=>'TW']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 221, 'country_name_rus' => 'Танзания', 'code'=>'TZ']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 222, 'country_name_rus' => 'Тёркс и Кайкос', 'code'=>'TC']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 223, 'country_name_rus' => 'Того', 'code'=>'TG']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 224, 'country_name_rus' => 'Токелау', 'code'=>'TK']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 225, 'country_name_rus' => 'Тонга', 'code'=>'TO']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 226, 'country_name_rus' => 'Тринидад и Тобаго', 'code'=>'TT']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 227, 'country_name_rus' => 'Тувалу', 'code'=>'TV']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 228, 'country_name_rus' => 'Тунис', 'code'=>'TN']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 229, 'country_name_rus' => 'Туркменистан', 'code'=>'TM']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 230, 'country_name_rus' => 'Уганда', 'code'=>'UG']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 231, 'country_name_rus' => 'Уоллис и Футуна', 'code'=>'WF']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 232, 'country_name_rus' => 'Уругвай', 'code'=>'UY']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 233, 'country_name_rus' => 'Фареры', 'code'=>'FO']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 234, 'country_name_rus' => 'Фиджи', 'code'=>'FJ']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 235, 'country_name_rus' => 'Филиппины', 'code'=>'PH']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 236, 'country_name_rus' => 'Финляндия', 'code'=>'FI']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 237, 'country_name_rus' => 'Фолклендские острова', 'code'=>'FK']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 238, 'country_name_rus' => 'Франция', 'code'=>'FR']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 239, 'country_name_rus' => 'Гвиана', 'code'=>'GF']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 240, 'country_name_rus' => 'Французская Полинезия', 'code'=>'PF']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 241, 'country_name_rus' => 'Французские Южные и Антарктические Территории', 'code'=>'TF']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 242, 'country_name_rus' => 'Хорватия', 'code'=>'HR']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 243, 'country_name_rus' => 'ЦАР', 'code'=>'CF']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 244, 'country_name_rus' => 'Чад', 'code'=>'TD']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 245, 'country_name_rus' => 'Черногория', 'code'=>'ME']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 246, 'country_name_rus' => 'Чили', 'code'=>'CL']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 247, 'country_name_rus' => 'Швейцария', 'code'=>'CH']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 248, 'country_name_rus' => 'Шри-Ланка', 'code'=>'LK']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 249, 'country_name_rus' => 'Эквадор', 'code'=>'EC']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 250, 'country_name_rus' => 'Экваториальная Гвинея', 'code'=>'GQ']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 251, 'country_name_rus' => 'Эритрея', 'code'=>'ER']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 252, 'country_name_rus' => 'Эстония', 'code'=>'EE']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 253, 'country_name_rus' => 'Эфиопия', 'code'=>'ET']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 254, 'country_name_rus' => 'Южная Георгия и Южные Сандвичевы острова', 'code'=>'GS']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 256, 'country_name_rus' => 'Ямайка', 'code'=>'JM']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 257, 'country_name_rus' => 'Япония', 'code'=>'JP']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 259, 'country_name_rus' => 'Антаркида', 'code'=>'AQ']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 260, 'country_name_rus' => 'Остров Буве', 'code'=>'BV']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 261, 'country_name_rus' => 'Херд и Макдональд', 'code'=>'HM']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 262, 'country_name_rus' => 'Южный Судан', 'code'=>'SS']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 263, 'country_name_rus' => 'Шпицберген и Ян-Майен', 'code'=>'SJ']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 264, 'country_name_rus' => 'Сен-Бартелеми', 'code'=>'BL']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 265, 'country_name_rus' => 'Сен-Мартен', 'code'=>'MF']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 268, 'country_name_rus' => 'Бонэйр, Синт-Эстатиус и Саба', 'code'=>'BQ']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 269, 'country_name_rus' => 'Кюрасао', 'code'=>'CW']);
        $this->insert('{{%f4_d_country}}', ['id_country' => 270, 'country_name_rus' => 'Синт-Мартен', 'code'=>'SX']);
        




    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%f4_d_country}}');
    }

}
