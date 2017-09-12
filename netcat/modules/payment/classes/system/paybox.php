<?php

class nc_payment_system_paybox extends nc_payment_system {

    const ERROR_MERCHANT_ID = NETCAT_MODULE_PAYMENT_PLATRON_ERROR_MERCHANT_ID_IS_NOT_VALID;
    const ERROR_SECRET_KEY = NETCAT_MODULE_PAYMENT_PLATRON_ERROR_SECRET_KEY_IS_NOT_VALID;
    const ERROR_CURRENCY = NETCAT_MODULE_PAYMENT_PLATRON_ERROR_CURRENCY_IS_NOT_VALID;
    const ERROR_SIGN_IS_NOT_VALID = NETCAT_MODULE_PAYMENT_PLATRON_ERROR_SIGN_IS_NOT_VALID;

    const TARGET_URL = "https://paybox.kz/payment.php";

    protected $automatic = TRUE;

    // принимаемые валюты
    public $accepted_currencies = array('USD', 'EUR', 'RUB', 'RUR', 'KZT');

    // параметры сайта в платежной системе
    protected $settings = array(
        'merchant_id'	=> null,
        'secret_key'	=> null,
		'lifetime'		=> 0,
		'testmode'		=> 0,
		'success_url'	=> null,
		'failure_url'	=> null,
    );

    // передаваемые параметры
    protected $request_parameters = array( // 'InvId' => null,
        // 'InvDesc' => null,
    );

    // получаемые параметры
    protected $callback_response = array(
        'InvId' => null,
        'OutSum' => null,
    );

    /**
     *
     */
    public function execute_payment_request(nc_payment_invoice $invoice) {
		$strCurrency = $invoice->get_currency();		
		if (!in_array($strCurrency, $this->accepted_currencies))
			$this->add_error(nc_payment_system_paybox::ERROR_CURRENCY);
		 
		if($strCurrency == "RUR")
			$strCurrency = "RUB";
		
		$netshop = nc_netshop::get_instance();
		$order = $netshop->load_order($invoice->get('order_id'));
		$strDescription = '';
		foreach($order->get_items() as $item){
			$strDescription .= $item->get('Vendor')." ";
			$strDescription .= $item->get('Name').";";
			if($item->get('Qty') > 1)
				$strDescription .= " * ".$item->get('Qty');
		}
		
		$arrFields = array(
            'pg_merchant_id'	=> $this->get_setting('merchant_id'),
            'pg_order_id'		=> $invoice->get('order_id'),
			'pg_currency'		=> $strCurrency,
            'pg_amount'			=> $invoice->get_amount("%0.2F"),
            'pg_lifetime'		=> $this->get_setting('lifetime')*60, // в секундах
			'pg_testing_mode'	=> $this->get_setting('testmode'),
			'pg_user_ip'		=> $_SERVER['REMOTE_ADDR'],
            'pg_description'	=> mb_substr($strDescription, 0, 255, "UTF-8"),
			'pg_check_url'		=> "https://www.".$_SERVER['HTTP_HOST']."/netcat/modules/payment/callback.php?paySystem=nc_payment_system_paybox&type=check&invoice_id=".$invoice->get_id(),
			'pg_result_url'		=> "https://www.".$_SERVER['HTTP_HOST']."/netcat/modules/payment/callback.php?paySystem=nc_payment_system_paybox&type=result&invoice_id=".$invoice->get_id(),
			'pg_request_method'	=> 'POST',
//			'pg_success_url'	=> $this->getAdapter()->getBackUrl(waAppPayment::URL_SUCCESS, array('order_id' => $order_data['order_id'])),
//			'pg_failure_url'	=> $this->getAdapter()->getBackUrl(waAppPayment::URL_DECLINE, array('order_id' => $order_data['order_id'])),
            'pg_salt'			=> rand(21,43433), // Параметры безопасности сообщения. Необходима генерация pg_salt и подписи сообщения.
        );
//		mb_substr($invoice->get_description(), 0, 255, "UTF-8")
		preg_match_all("/\d/", @$invoice->get('customer_phone'), $array);
		if(!empty($array[0])){
			$strPhone = implode('',$array[0]);
			$arrFields['pg_user_phone'] = $strPhone;
		}
		
		if(preg_match('/^.+@.+\..+$/', @$invoice->get('customer_email'))){
			$arrFields['pg_user_email'] = $invoice->get('customer_email');
			$arrFields['pg_user_contact_email'] = $invoice->get('customer_email');
		}
		
		
		$arrFields['pg_sig'] = PG_Signature::make('payment.php', $arrFields, $this->get_setting('secret_key'));
        ob_end_clean();
        $strForm = "
            <html>
              <body>
                    <form action='" . nc_payment_system_paybox::TARGET_URL . "' method='POST'>".
                     $this->make_inputs($arrFields)
					."
					<input type='submit' value='Оплатить'>
                </form>
                <script>
                  document.forms[0].submit();
                </script>
              </body>
            </html>";
        echo $strForm;
        exit;
    }

    /**
     * @param nc_payment_invoice $invoice
     */
    public function on_response(nc_payment_invoice $invoice = null) {
    }

    /**
     *
     */
    public function validate_payment_request_parameters() {
		if (!$this->get_setting('merchant_id')) {
            $this->add_error(nc_payment_system_paybox::ERROR_MERCHANT_ID);
        }
		elseif(!$this->get_setting('secret_key')) {
            $this->add_error(nc_payment_system_paybox::ERROR_SECRET_KEY);
        }
		
    }

    /**
     * @param nc_payment_invoice $invoice
     */
    public function validate_payment_callback_response(nc_payment_invoice $invoice = null) {		
		$arrRequest = $_POST;
		$thisScriptName = PG_Signature::getOurScriptName();
		if (empty($arrRequest['pg_sig']) || !PG_Signature::check($arrRequest['pg_sig'], $thisScriptName, $arrRequest, $this->get_setting('secret_key')))
			die("Wrong signature");

		
		$arrResponse = array();
		@$nInvoiceStatus = $invoice->status;
		
		if($arrRequest['type'] == 'check'){
			$bCheckResult = 1;
			if(!$invoice && !in_array($nInvoiceStatus, array(nc_payment_invoice::STATUS_NEW, nc_payment_invoice::STATUS_SENT_TO_PAYMENT_SYSTEM, nc_payment_invoice::STATUS_WAITING))){
				$bCheckResult = 0;
				$error_desc = "Товар не доступен. Либо заказа нет, либо его статус ".$nInvoiceStatus;
			}
			
			$arrResponse['pg_salt']              = $arrRequest['pg_salt']; // в ответе необходимо указывать тот же pg_salt, что и в запросе
			$arrResponse['pg_status']            = $bCheckResult ? 'ok' : 'error';
			$arrResponse['pg_error_description'] = $bCheckResult ?  ""  : $error_desc;
			$arrResponse['pg_sig']				 = PG_Signature::make($thisScriptName, $arrResponse, $this->get_setting('secret_key'));
			
			$objResponse = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><response/>');
			$objResponse->addChild('pg_salt', $arrResponse['pg_salt']);
			$objResponse->addChild('pg_status', $arrResponse['pg_status']);
			$objResponse->addChild('pg_error_description', $arrResponse['pg_error_description']);
			$objResponse->addChild('pg_sig', $arrResponse['pg_sig']);
			
		}
		elseif($arrRequest['type'] == 'result'){
			if(!$invoice && !in_array($nInvoiceStatus, array(nc_payment_invoice::STATUS_NEW, nc_payment_invoice::STATUS_SENT_TO_PAYMENT_SYSTEM, nc_payment_invoice::STATUS_WAITING))){
				$strResponseDescription = "Товар не доступен. Либо заказа нет, либо его статус ".$nInvoiceStatus;
				if($arrRequest['pg_can_reject'] == 1)
					$strResponseStatus = 'rejected';
				else
					$strResponseStatus = 'error';
			} 
			else {
				$strResponseStatus = 'ok';
				$strResponseDescription = "Оплата принята";
				if ($arrRequest['pg_result'] == 1) {
					if ($invoice) {
						$invoice->set('status', nc_payment_invoice::STATUS_SUCCESS);
						$invoice->save();
						$this->on_payment_success($invoice);
					}
				}
				else {
					// Изменить статус заказа на отказ
					// Если он у них есть
				}
			}
			
			$objResponse = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><response/>');
			$objResponse->addChild('pg_salt', $arrRequest['pg_salt']); // в ответе необходимо указывать тот же pg_salt, что и в запросе
			$objResponse->addChild('pg_status', $strResponseStatus);
			$objResponse->addChild('pg_description', $strResponseDescription);
			$objResponse->addChild('pg_sig', PG_Signature::makeXML($thisScriptName, $objResponse, $this->secret_key));
		} 
		else 
			exit("Wrong type request");
		
		header('Content-type: text/xml');
		print $objResponse->asXML();
		exit();
    }

    public function load_invoice_on_callback() {
		return $this->load_invoice($this->get_response_value('invoice_id'));
    }
}

class PG_Signature {

	/**
	 * Get script name from URL (for use as parameter in self::make, self::check, etc.)
	 *
	 * @param string $url
	 * @return string
	 */
	public static function getScriptNameFromUrl ( $url )
	{
		$path = parse_url($url, PHP_URL_PATH);
		$len  = strlen($path);
		if ( $len == 0  ||  '/' == $path{$len-1} ) {
			return "";
		}
		return basename($path);
	}
	
	/**
	 * Get name of currently executed script (need to check signature of incoming message using self::check)
	 *
	 * @return string
	 */
	public static function getOurScriptName ()
	{
		return self::getScriptNameFromUrl( $_SERVER['PHP_SELF'] );
	}

	/**
	 * Creates a signature
	 *
	 * @param array $arrParams  associative array of parameters for the signature
	 * @param string $strSecretKey
	 * @return string
	 */
	public static function make ( $strScriptName, $arrParams, $strSecretKey )
	{
		return md5( self::makeSigStr($strScriptName, $arrParams, $strSecretKey) );
	}

	/**
	 * Verifies the signature
	 *
	 * @param string $signature
	 * @param array $arrParams  associative array of parameters for the signature
	 * @param string $strSecretKey
	 * @return bool
	 */
	public static function check ( $signature, $strScriptName, $arrParams, $strSecretKey )
	{
		return (string)$signature === self::make($strScriptName, $arrParams, $strSecretKey);
	}


	/**
	 * Returns a string, a hash of which coincide with the result of the make() method.
	 * WARNING: This method can be used only for debugging purposes!
	 *
	 * @param array $arrParams  associative array of parameters for the signature
	 * @param string $strSecretKey
	 * @return string
	 */
	static function debug_only_SigStr ( $strScriptName, $arrParams, $strSecretKey ) {
		return self::makeSigStr($strScriptName, $arrParams, $strSecretKey);
	}


	private static function makeSigStr ( $strScriptName, $arrParams, $strSecretKey ) {
		unset($arrParams['pg_sig']);
		
		ksort($arrParams);

		array_unshift($arrParams, $strScriptName);
		array_push   ($arrParams, $strSecretKey);

		return join(';', $arrParams);
	}

	/********************** singing XML ***********************/

	/**
	 * make the signature for XML
	 *
	 * @param string|SimpleXMLElement $xml
	 * @param string $strSecretKey
	 * @return string
	 */
	public static function makeXML ( $strScriptName, $xml, $strSecretKey )
	{
		$arrFlatParams = self::makeFlatParamsXML($xml);
		return self::make($strScriptName, $arrFlatParams, $strSecretKey);
	}

	/**
	 * Verifies the signature of XML
	 *
	 * @param string|SimpleXMLElement $xml
	 * @param string $strSecretKey
	 * @return bool
	 */
	public static function checkXML ( $strScriptName, $xml, $strSecretKey )
	{
		if ( ! $xml instanceof SimpleXMLElement ) {
			$xml = new SimpleXMLElement($xml);
		}
		$arrFlatParams = self::makeFlatParamsXML($xml);
		return self::check((string)$xml->pg_sig, $strScriptName, $arrFlatParams, $strSecretKey);
	}

	/**
	 * Returns a string, a hash of which coincide with the result of the makeXML() method.
	 * WARNING: This method can be used only for debugging purposes!
	 *
	 * @param string|SimpleXMLElement $xml
	 * @param string $strSecretKey
	 * @return string
	 */
	public static function debug_only_SigStrXML ( $strScriptName, $xml, $strSecretKey )
	{
		$arrFlatParams = self::makeFlatParamsXML($xml);
		return self::makeSigStr($strScriptName, $arrFlatParams, $strSecretKey);
	}

	/**
	 * Returns flat array of XML params
	 *
	 * @param (string|SimpleXMLElement) $xml
	 * @return array
	 */
	private static function makeFlatParamsXML ( $xml, $parent_name = '' )
	{
		if ( ! $xml instanceof SimpleXMLElement ) {
			$xml = new SimpleXMLElement($xml);
		}

		$arrParams = array();
		$i = 0;
		foreach ( $xml->children() as $tag ) {
			
			$i++;
			if ( 'pg_sig' == $tag->getName() )
				continue;
				
			/**
			 * Имя делаем вида tag001subtag001
			 * Чтобы можно было потом нормально отсортировать и вложенные узлы не запутались при сортировке
			 */
			$name = $parent_name . $tag->getName().sprintf('%03d', $i);

			if ( $tag->children()->count() > 0 ) {
				$arrParams = array_merge($arrParams, self::makeFlatParamsXML($tag, $name));
				continue;
			}

			$arrParams += array($name => (string)$tag);
		}

		return $arrParams;
	}
}