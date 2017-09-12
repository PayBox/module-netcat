<?php
/* Module */
define("NETCAT_MODULE_PAYMENT_NAME", "���� ��������");
define("NETCAT_MODULE_PAYMENT_DESCRIPTION", "������ ��� ����� ��������");

/* Events description */
define("NETCAT_MODULE_PAYMENT_EVENT_ON_INIT", "������������� ��������� �������");
define("NETCAT_MODULE_PAYMENT_EVENT_BEFORE_PAY_REQUEST", "���������� ������� �� ������"); // "����� �������� �� ������"
define("NETCAT_MODULE_PAYMENT_EVENT_AFTER_PAY_REQUEST", "������ �� ������"); // "����� ������� �� ������"
define("NETCAT_MODULE_PAYMENT_EVENT_ON_PAY_REQUEST_ERROR", "������ � ���������� ������� �� ������");
define("NETCAT_MODULE_PAYMENT_EVENT_BEFORE_PAY_CALLBACK", "���������� � ��������� callback-������ ��������� �������"); // "����� ���������� callback ������ ��������� �������"
define("NETCAT_MODULE_PAYMENT_EVENT_AFTER_PAY_CALLBACK", "��������� callback-������ ��������� �������"); // "����� ��������� callback ������ ��������� �������"
define("NETCAT_MODULE_PAYMENT_EVENT_ON_PAY_CALLBACK_ERROR", "������ � ���������� ��� callback-������"); // "������ � ���������� ��� callback ������"
define("NETCAT_MODULE_PAYMENT_EVENT_ON_PAY_SUCCESS", "������ ������� ��������"); // "������ ������� ��������"
define("NETCAT_MODULE_PAYMENT_EVENT_ON_PAY_FAILURE", "������ �� ������������"); // "������ �� ������������"

/* Order description string */
define("NETCAT_MODULE_PAYMENT_PAYMENT_DESCRIPTION", "������ ������ �%s");

/* Error messages */
define("NETCAT_MODULE_PAYMENT_REQUEST_ERROR", "������ � ���������� �������");
define("NETCAT_MODULE_PAYMENT_ORDER_ID_IS_NOT_UNIQUE", "����� ������ �� ����������");
define("NETCAT_MODULE_PAYMENT_ORDER_ID_IS_NULL", "�� ���������� �������� 'OrderId'");
define("NETCAT_MODULE_PAYMENT_INCORRECT_PAYMENT_AMOUNT", "����� ������� �� ������� ��� ������ �����������");
define("NETCAT_MODULE_PAYMENT_INCORRECT_PAYMENT_CURRENCY", "�������� ������� �� ��������� ������� � ������ �%s�");
define("NETCAT_MODULE_PAYMENT_CANNOT_LOAD_INVOICE_ON_CALLBACK", "�������� ������� ������� ������������ ������������� �������");

/* admin.php */
define("NETCAT_MODULE_PAYMENT_SITES", "���� ��� ���������");
define("NETCAT_MODULE_PAYMENT_CHOICE_SITE", "����� �����");
define("NETCAT_MODULE_PAYMENT_PAYMENT_SYSTEM", "��������� �������");
define("NETCAT_MODULE_PAYMENT_LIST_PAYMENT_SYSTEMS", "������ ��������� ������");
define("NETCAT_MODULE_PAYMENT_SETTINGS_PAYMENT_SYSTEM", "���������");
define("NETCAT_MODULE_PAYMENT_ONOFF_PAYMENT_SYSTEM", "���/����");
define("NETCAT_MODULE_PAYMENT_ADMIN_BUTTON_SAVE", "���������");
define("NETCAT_MODULE_PAYMENT_ADMIN_BUTTON_ADD_PARAMETER", "�������� ��������");
define("NETCAT_MODULE_PAYMENT_PAYMENT_SYSTEM_PARAMETERS", "��������� ��������� �������");
define("NETCAT_MODULE_PAYMENT_PARAMETER", "��������");
define("NETCAT_MODULE_PAYMENT_PARAMETER_VALUE", "��������");
define("NETCAT_MODULE_PAYMENT_ADMIN_BUTTON_DELETE","�������");
define("NETCAT_MODULE_PAYMENT_ADMIN_BUTTON_CHANGE_SETTINGS","�������� ��������� �������");

/* Payment common messages */
define("NETCAT_MODULE_PAYMENT_ERROR_PRIVATE_SECURITY_IS_NOT_VALID", "������������ ������� �����");
define("NETCAT_MODULE_PAYMENT_ERROR_INVOICE_NOT_FOUND", "������ �� ������ � NetCat");
define("NETCAT_MODULE_PAYMENT_ERROR_INVALID_SUM", "�������� ����� �������");
define("NETCAT_MODULE_PAYMENT_ERROR_ALREADY_PAID", "���� ��� �������");

/* Assist */
define("NETCAT_MODULE_PAYMENT_ASSIST_ERROR_CHECKVALUE_IS_NOT_VALID", "������������ �������� 'CheckValue'");
define("NETCAT_MODULE_PAYMENT_ASSIST_ERROR_ASSIST_SHOP_ID", "�������� 'AssistShopId' ������ ���� ������");
define("NETCAT_MODULE_PAYMENT_ASSIST_ERROR_ASSIST_SECRET_WORD_IS_NULL", "�������� 'AssistSecretWord' ������ ���� ����������");

/* Mail */
define("NETCAT_MODULE_PAYMENT_MAIL_ERROR_SIGNATURE_IS_NOT_VALID", "������������ �������� 'Signature'");
define("NETCAT_MODULE_PAYMENT_MAIL_ERROR_SHOP_ID", "�������� 'MailShopID' ������ ���� ������");
define("NETCAT_MODULE_PAYMENT_MAIL_ERROR_SECRET_KEY_IS_NULL", "�������� 'MailSecretKey' ������ ���� ����������");
define("NETCAT_MODULE_PAYMENT_MAIL_ERROR_HASH_IS_NULL", "�������� 'MailHash' ������ ���� ����������");

/* Paymaster */
define("NETCAT_MODULE_PAYMENT_PAYMASTER_ERROR_MERCHANTID_IS_NOT_VALID", "������������ �������� 'LMI_MERCHANT_ID'");
define("NETCAT_MODULE_PAYMENT_PAYMASTER_ERROR_LMI_PAYMENT_DESC_IS_LONG", "����� ��������� 'LMI_PAYMENT_DESC' ������ ���� ������ 255");
define("NETCAT_MODULE_PAYMENT_PAYMASTER_ERROR_PRIVATE_SECURITY_IS_NOT_VALID", "������������ �������� 'LMI_HASH'");

/* Payonline */
define("NETCAT_MODULE_PAYMENT_PAYONLINE_ERROR_MERCHANT_ID", "�������� 'MerchantId' ������ ���� ������");
define("NETCAT_MODULE_PAYMENT_PAYONLINE_ERROR_PRIVATE_SECURITY_KEY_IS_NULL", "�������� 'PrivateSecurityKey' ������ ���� ����������");
define("NETCAT_MODULE_PAYMENT_PAYONLINE_ERROR_PRIVATE_SECURITY_IS_NOT_VALID", "������������ �������� 'SecurityKey'");

/* Paypal */
define("NETCAT_MODULE_PAYMENT_PAYPAL_ERROR_SOME_PARAMETRS_ARE_NOT_VALID", "������������ ���������");
define("NETCAT_MODULE_PAYMENT_PAYPAL_ERROR_PAYPAL_MAIL_IS_NOT_VALID", "������������ �������� 'Paypal-email'");

/* Platidoma */
define("NETCAT_MODULE_PAYMENT_PLATIDOMA_ERROR_PGSHOPID_IS_NOT_VALID", "�������� 'pd_shop_id' ������ ���� ����������");
define("NETCAT_MODULE_PAYMENT_PLATIDOMA_ERROR_PGLOGIN_IS_NOT_VALID", "�������� 'pd_login' ������ ���� ����������");
define("NETCAT_MODULE_PAYMENT_PLATIDOMA_ERROR_PGGATEPASSWORD_IS_NOT_VALID", "�������� 'pd_gate_password' ������ ���� ����������");
define("NETCAT_MODULE_PAYMENT_PLATIDOMA_ERROR_PRIVATE_SECURITY_KEY_IS_NULL", "�������� 'PrivateSecurityKey' ������ ���� ����������");
define("NETCAT_MODULE_PAYMENT_PLATIDOMA_ERROR_PRIVATE_KEY_IS_NOT_VALID", "������������ �������� 'pd_rnd'");
define("NETCAT_MODULE_PAYMENT_PLATIDOMA_ERROR_PRIVATE_SECURITY_IS_NOT_VALID", "������������ �������� 'pd_sign'");
define("NETCAT_MODULE_PAYMENT_PLATIDOMA_ERROR_ORDER_ID_IS_LONG", "����� ��������� 'OrderId' ������ ���� ������ 50");

/* QIWI */
define("NETCAT_MODULE_PAYMENT_QIWI_ERROR_AMOUNT_TOO_LARGE", "������������ ����� ������� � 15 000 ������");
define("NETCAT_MODULE_PAYMENT_QIWI_ERROR_QIWI_FORM", "�������� 'QiwiForm' ������ ���� ������");

/* Robokassa */
define("NETCAT_MODULE_PAYMENT_ROBOKASSA_ERROR_MRCHLOGIN_IS_NOT_VALID", "������������ �������� 'MrchLogin'");
define("NETCAT_MODULE_PAYMENT_ROBOKASSA_ERROR_INVID_IS_NOT_VALID", "�������� 'InvId' ������ ���� ������");
define("NETCAT_MODULE_PAYMENT_ROBOKASSA_ERROR_INVDESC_ID_IS_LONG", "����� ��������� 'InvDesc' ������ ���� ������ 100");
define("NETCAT_MODULE_PAYMENT_ROBOKASSA_ERROR_PRIVATE_SECURITY_IS_NOT_VALID", "������������ �������� 'SignatureValue'");

/* Platron */
define("NETCAT_MODULE_PAYMENT_PLATRON_ERROR_MERCHANT_ID_IS_NOT_VALID", "������������ �������� 'merchant_id'");
define("NETCAT_MODULE_PAYMENT_PLATRON_ERROR_SECRET_KEY_IS_NOT_VALID", "������������ �������� 'secret_key'");
define("NETCAT_MODULE_PAYMENT_PLATRON_ERROR_CURRENCY_IS_NOT_VALID", "������������ �������� currency");
define("NETCAT_MODULE_PAYMENT_PLATRON_ERROR_SIGN_IS_NOT_VALID", "������������ �������� 'signature'");

/* Webmoney */
define("NETCAT_MODULE_PAYMENT_WEBMONEY_ERROR_PURSE_IS_NOT_VALID", "������������ �������� 'LMI_PAYEE_PURSE'");
define("NETCAT_MODULE_PAYMENT_WEBMONEY_ERROR_PRIVATE_SECURITY_IS_NOT_VALID", "������������ �������� 'LMI_HASH'");
define("NETCAT_MODULE_PAYMENT_WEBMONEY_ERROR_ORDER_ID_IS_LONG", "����� ��������� 'OrderId' ������ ���� ������ 50");

/* Yandex_Email */
define("NETCAT_MODULE_PAYMENT_YANDEX_EMAIL_ERROR_RECEIVER", "�������� 'Receiver' ������ ���� ����������");

/* Yandex CPP */
define("NETCAT_MODULE_PAYMENT_YANDEX_CPP_ERROR_SHOPID_IS_NOT_VALID", "������������ �������� 'shopId'");
define("NETCAT_MODULE_PAYMENT_YANDEX_CPP_ERROR_SCID_IS_NOT_VALID", "������������ �������� 'scid'");
define("NETCAT_MODULE_PAYMENT_YANDEX_CPP_ERROR_SHOP_PASSWORD_IS_NOT_VALID", "������������ �������� 'shopPassword'");
define("NETCAT_MODULE_PAYMENT_YANDEX_CPP_ERROR_ORDER_ID_IS_NOT_VALID", "������������ �������� 'orderNumber'");
define("NETCAT_MODULE_PAYMENT_YANDEX_CPP_ERROR_AMOUNT", "�������� 'Amount' ������ ���� ������");
define("NETCAT_MODULE_PAYMENT_YANDEX_CPP_ERROR_PRIVATE_SECURITY_IS_NOT_VALID", "������������ �������� 'md5'");