<?php
/* Module */
define("NETCAT_MODULE_PAYMENT_NAME", "Payment module");
define("NETCAT_MODULE_PAYMENT_DESCRIPTION", "Provides integration with payment processing systems");

/* Events description */
define("NETCAT_MODULE_PAYMENT_EVENT_ON_INIT", "Payment system initialization");
define("NETCAT_MODULE_PAYMENT_EVENT_BEFORE_PAY_REQUEST", "Preparing payment request");
define("NETCAT_MODULE_PAYMENT_EVENT_AFTER_PAY_REQUEST", "Executing payment request");
define("NETCAT_MODULE_PAYMENT_EVENT_ON_PAY_REQUEST_ERROR", "Error in payment request parameters");
define("NETCAT_MODULE_PAYMENT_EVENT_BEFORE_PAY_CALLBACK", "Preparing to process payment system callback response");
define("NETCAT_MODULE_PAYMENT_EVENT_AFTER_PAY_CALLBACK", "Payment system callback response processing");
define("NETCAT_MODULE_PAYMENT_EVENT_ON_PAY_CALLBACK_ERROR", "Error in callback response parameters");
define("NETCAT_MODULE_PAYMENT_EVENT_ON_PAY_SUCCESS", "Payment complete");
define("NETCAT_MODULE_PAYMENT_EVENT_ON_PAY_FAILURE", "Payment failed");

/* Order description string */
define("NETCAT_MODULE_PAYMENT_PAYMENT_DESCRIPTION", "Payment for the order #%s");

/* Error messages */
define("NETCAT_MODULE_PAYMENT_REQUEST_ERROR", "Error in request parameters");
define("NETCAT_MODULE_PAYMENT_ORDER_ID_IS_NOT_UNIQUE", "Order identifier is not unique");
define("NETCAT_MODULE_PAYMENT_ORDER_ID_IS_NULL", "Parameter 'OrderId' must be set");
define("NETCAT_MODULE_PAYMENT_INCORRECT_PAYMENT_AMOUNT", "Payment amount is not set or is incorrect");
define("NETCAT_MODULE_PAYMENT_INCORRECT_PAYMENT_CURRENCY", "Payment system does not accept payments in the &quot;%s&quot; currency");
define("NETCAT_MODULE_PAYMENT_CANNOT_LOAD_INVOICE_ON_CALLBACK", "Payment system returned wrong invoice ID");

/* admin.php */
define("NETCAT_MODULE_PAYMENT_SITES", "Site for control");
define("NETCAT_MODULE_PAYMENT_CHOICE_SITE", "Site choice");
define("NETCAT_MODULE_PAYMENT_PAYMENT_SYSTEM", "Payment system");
define("NETCAT_MODULE_PAYMENT_LIST_PAYMENT_SYSTEMS", "List of payment systems");
define("NETCAT_MODULE_PAYMENT_SETTINGS_PAYMENT_SYSTEM", "Settings");
define("NETCAT_MODULE_PAYMENT_ONOFF_PAYMENT_SYSTEM", "On/Of");
define("NETCAT_MODULE_PAYMENT_ADMIN_BUTTON_SAVE", "Save");
define("NETCAT_MODULE_PAYMENT_ADMIN_BUTTON_ADD_PARAMETER", "Add parameter");
define("NETCAT_MODULE_PAYMENT_PAYMENT_SYSTEM_PARAMETERS", "Parameters of payment system");
define("NETCAT_MODULE_PAYMENT_PARAMETER", "Parameter");
define("NETCAT_MODULE_PAYMENT_PARAMETER_VALUE", "Value");
define("NETCAT_MODULE_PAYMENT_ADMIN_BUTTON_DELETE","Delete");
define("NETCAT_MODULE_PAYMENT_ADMIN_BUTTON_CHANGE_SETTINGS","Change parameters of payment system");

/* Payment common messages */
define("NETCAT_MODULE_PAYMENT_ERROR_PRIVATE_SECURITY_IS_NOT_VALID", "Invalid form signature");
define("NETCAT_MODULE_PAYMENT_ERROR_INVOICE_NOT_FOUND", "Invoice not found in NetCat");
define("NETCAT_MODULE_PAYMENT_ERROR_INVALID_SUM", "Invalid sum");
define("NETCAT_MODULE_PAYMENT_ERROR_ALREADY_PAID", "Invoice has already been paid");

/* Assist */
define("NETCAT_MODULE_PAYMENT_ASSIST_ERROR_CHECKVALUE_IS_NOT_VALID", "Invalid value of the 'CheckValue' parameter");
define("NETCAT_MODULE_PAYMENT_ASSIST_ERROR_ASSIST_SHOP_ID", "Parameter 'AssistShopId' must be numeric");
define("NETCAT_MODULE_PAYMENT_ASSIST_ERROR_ASSIST_SECRET_WORD_IS_NULL", "Parameter 'AssistSecretWord' must be set");

/* Mail */
define("NETCAT_MODULE_PAYMENT_MAIL_ERROR_SIGNATURE_IS_NOT_VALID", "Not valid signature");
define("NETCAT_MODULE_PAYMENT_MAIL_ERROR_SHOP_ID", "Parameter 'MailShopID' must be numeric");
define("NETCAT_MODULE_PAYMENT_MAIL_ERROR_SECRET_KEY_IS_NULL", "Parameter 'MailSecretKey' must be set");
define("NETCAT_MODULE_PAYMENT_MAIL_ERROR_HASH_IS_NULL", "Parameter 'MailHash' must be set");

/* Paymaster */
define("NETCAT_MODULE_PAYMENT_PAYMASTER_ERROR_MERCHANTID_IS_NOT_VALID", "Invalid value of the 'LMI_MERCHANT_ID' parameter");
define("NETCAT_MODULE_PAYMENT_PAYMASTER_ERROR_LMI_PAYMENT_DESC_IS_LONG", "The length of Parameter 'LMI_PAYMENT_DESC' must be less than 255");
define("NETCAT_MODULE_PAYMENT_PAYMASTER_ERROR_PRIVATE_SECURITY_IS_NOT_VALID", "Invalid value of the 'LMI_HASH' parameter");

/* Payonline */
define("NETCAT_MODULE_PAYMENT_PAYONLINE_ERROR_MERCHANT_ID", "Parameter 'MerchantId' must be numeric");
define("NETCAT_MODULE_PAYMENT_PAYONLINE_ERROR_PRIVATE_SECURITY_KEY_IS_NULL", "Parameter 'PrivateSecurityKey' must be set");
define("NETCAT_MODULE_PAYMENT_PAYONLINE_ERROR_PRIVATE_SECURITY_IS_NOT_VALID", "Invalid value of the 'SecurityKey' parameter");

/* Paypal */
define("NETCAT_MODULE_PAYMENT_PAYPAL_ERROR_SOME_PARAMETERS_ARE_NOT_VALID", "Some parameter is incorrect");
define("NETCAT_MODULE_PAYMENT_PAYPAL_ERROR_PAYPAL_MAIL_IS_NOT_VALID", "Paypal-email is incorrect");

/* Platidoma */
define("NETCAT_MODULE_PAYMENT_PLATIDOMA_ERROR_PGSHOPID_IS_NOT_VALID", "Parameter 'pd_shop_id' must be set");
define("NETCAT_MODULE_PAYMENT_PLATIDOMA_ERROR_PGLOGIN_IS_NOT_VALID", "Parameter 'pd_login' must be set");
define("NETCAT_MODULE_PAYMENT_PLATIDOMA_ERROR_PGGATEPASSWORD_IS_NOT_VALID", "Parameter 'pd_gate_password' must be set");
define("NETCAT_MODULE_PAYMENT_PLATIDOMA_ERROR_PRIVATE_SECURITY_KEY_IS_NULL", "Parameter 'PrivateSecurityKey' must be set");
define("NETCAT_MODULE_PAYMENT_PLATIDOMA_ERROR_PRIVATE_KEY_IS_NOT_VALID", "Invalid value of the 'pd_rnd' parameter");
define("NETCAT_MODULE_PAYMENT_PLATIDOMA_ERROR_PRIVATE_SECURITY_IS_NOT_VALID", "Invalid value of the 'pd_sign' parameter");
define("NETCAT_MODULE_PAYMENT_PLATIDOMA_ERROR_ORDER_ID_IS_LONG", "The length of Parameter 'OrderId' must be less than 50");

/* QIWI */
define("NETCAT_MODULE_PAYMENT_QIWI_ERROR_AMOUNT_TOO_LARGE", 'Exceeds maximum amount of payment - 15 000 rub');
define("NETCAT_MODULE_PAYMENT_QIWI_ERROR_QIWI_FORM", "Parameter 'QiwiForm' must be numeric");

/* Robokassa */
define("NETCAT_MODULE_PAYMENT_ROBOKASSA_ERROR_MRCHLOGIN_IS_NOT_VALID", "Invalid value of the 'MrchLogin' parameter");
define("NETCAT_MODULE_PAYMENT_ROBOKASSA_ERROR_INVID_IS_NOT_VALID", "Parameter 'InvId' must be numeric");
define("NETCAT_MODULE_PAYMENT_ROBOKASSA_ERROR_INVDESC_ID_IS_LONG", "The length of Parameter 'InvDesc' must be less than 100");
define("NETCAT_MODULE_PAYMENT_ROBOKASSA_ERROR_PRIVATE_SECURITY_IS_NOT_VALID", "Invalid value of the 'SignatureValue' parameter");

/* Platron */
define("NETCAT_MODULE_PAYMENT_PLATRON_ERROR_MERCHANT_ID_IS_NOT_VALID", "Invalid value of the 'merchant_id' parameter");
define("NETCAT_MODULE_PAYMENT_PLATRON_ERROR_SECRET_KEY_IS_NOT_VALID", "Invalid value of the 'secret_key' parameter");
define("NETCAT_MODULE_PAYMENT_PLATRON_ERROR_CURRENCY_IS_NOT_VALID", "Invalid currency IM");
define("NETCAT_MODULE_PAYMENT_PLATRON_ERROR_SIGN_IS_NOT_VALID", "Invalid signature");

/* Webmoney */
define("NETCAT_MODULE_PAYMENT_WEBMONEY_ERROR_PURSE_IS_NOT_VALID", "Invalid value of the 'LMI_PAYEE_PURSE' parameter");
define("NETCAT_MODULE_PAYMENT_WEBMONEY_ERROR_PRIVATE_SECURITY_IS_NOT_VALID", "Invalid value of the 'LMI_HASH' parameter");
define("NETCAT_MODULE_PAYMENT_WEBMONEY_ERROR_ORDER_ID_IS_LONG", "The length of Parameter 'OrderId' must be less than 50");

/* Yandex_Email */
define("NETCAT_MODULE_PAYMENT_YANDEX_EMAIL_ERROR_RECEIVER", "Parameter 'Receiver' must be set");

/* Yandex CPP */
define("NETCAT_MODULE_PAYMENT_YANDEX_CPP_ERROR_SHOPID_IS_NOT_VALID", "Invalid value of the 'shopId' parameter");
define("NETCAT_MODULE_PAYMENT_YANDEX_CPP_ERROR_SCID_IS_NOT_VALID", "Invalid value of the 'scid' parameter");
define("NETCAT_MODULE_PAYMENT_YANDEX_CPP_ERROR_SHOP_PASSWORD_IS_NOT_VALID", "Invalid value of the 'shopPassword' parameter");
define("NETCAT_MODULE_PAYMENT_YANDEX_CPP_ERROR_ORDER_ID_IS_NOT_VALID", "Invalid value of the 'orderNumber' parameter");
define("NETCAT_MODULE_PAYMENT_YANDEX_CPP_ERROR_AMOUNT", "Parameter 'Amount' must be numeric");
define("NETCAT_MODULE_PAYMENT_YANDEX_CPP_ERROR_PRIVATE_SECURITY_IS_NOT_VALID", "Invalid value of the 'md5' parameter");