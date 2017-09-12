<?php

class nc_response {

    private $types = array('assist', 'paypal', 'qiwi', 'robokassa', 'mail','platron');
    private $payment = null;

    public function __construct($type) {
        if (array_search($type, $this->types) !== false) {
            require_once "nc_$type.class.php";
            $payment_class_name = "nc_$type";
            $this->payment = new $payment_class_name($type);
        } else {
            echo NETCAT_MODULE_NETSHOP_NO_PAYMENT_SYSTEM;
            exit;
        }
    }

    public function check() {
        return $this->payment->check();
    }

    public function error() {
        return $this->payment->get_error_message();
    }

    public function update_order() {
        $this->payment->update_order();
    }

}
?>
