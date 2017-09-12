# module-netcat
Модуль для CMS (https://netcat.ru)

Тестировалось и писалось для NetCat 5.2

1. Регистрируемся на platron.ru
2. Вставляем распакованную папку netcat в корень сайта
3. Заходим в админку NetCat -> Карта сайта -> Интернет магазин\* -> Каталог товаров -> Способы оплаты -> Добавить
4. При добавлении заполнить поле Интерфейс ЦПП = platron
5. Настройки->Интернет магазин->Добавить параметр
`PLATRON_MERCHANT_ID` – номер магазина в platron
`PLATRON_SECRET_KEY` – секретный ключ
`PLATRON_LIFETIME` – время жизни счета в ПС, которые не поддерживают проверку возможности оплаты. При значении 0 – не ограничивается. Указывается в минутах. Максимальное значение 7 суток.
`PLATRON_TESTMODE` – тестовый режим. Если не в тестовом пишите 0.
`PLATRON_SUCCESS_URL` и `PLATRON_FAILURE_URL` – страницы, которые можно создать через админку CMS. При их указании человек будет попадать на эти странице при удачной и не удачной оплате, соответственно.

Данные по магазину берем из `https://www.platron.ru/admin/merchants.php`.
\* Если подключаете к другому сайту - аналогично
