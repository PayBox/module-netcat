<?php

class Payment_platron {

    private $shop = null;

    function __construct($shop) {
        $this->shop = $shop;

        if (!$shop->OrderID && $_GET["OrderNumber"]) {
            $this->shop->LoadOrder($_GET["OrderNumber"]);
        }
    }

    function create_bill($to_string = false) {		
        $shop = $this->shop;
		$strDescription = "";
		$arrOrder = $shop->Order;
		foreach($shop->CartContents as $arrCartContent)
			$strDescription .= $arrCartContent["Name"]."*".$arrCartContent["Qty"].";";
		
		$strCurrency = $this->shop->Currencies[$this->shop->DefaultCurrencyID];
		if($strCurrency == "RUR")
			$strCurrency = "RUB";
		
		$strSuccessUrl = $shop->platron_success_url;
		$strFailureUrl = $shop->platron_failure_url;
		
		$arrFields = array(
            'pg_merchant_id'	=> $shop->platron_merchant_id,
            'pg_order_id'		=> $shop->OrderID,
			'pg_currency'		=> $strCurrency,
            'pg_amount'			=> sprintf("%0.2F", $shop->CartSum()),
            'pg_lifetime'		=> $shop->platron_lifetime*60, // в секундах
			'pg_testing_mode'	=> $shop->platron_testmode,
			'pg_user_ip'		=> $_SERVER['REMOTE_ADDR'],
            'pg_description'	=> mb_substr($strDescription, 0, 255, "UTF-8"),
			'pg_check_url'		=> $_SERVER['HTTP_HOST']."/netcat/modules/netshop/payment/response/platron.php?type=check",
			'pg_result_url'		=> $_SERVER['HTTP_HOST']."/netcat/modules/netshop/payment/response/platron.php?type=result",
			'pg_request_method'	=> 'GET',
            'pg_salt'			=> rand(21,43433), // Параметры безопасности сообщения. Необходима генерация pg_salt и подписи сообщения.
        );
		
		if(!empty($strSuccessUrl))
			$arrFields['pg_success_url'] = $strSuccessUrl;
		if(!empty($strFailureUrl))
			$arrFields['pg_failure_url'] = $strFailureUrl;
		if(!empty($arrOrder["Email"]))
			if(preg_match('/^.+@.+\..+$/', $arrOrder["Email"])){
				$arrFields['pg_user_email'] = $arrOrder["Email"];
				$arrFields['pg_user_contact_email'] = $arrOrder["Email"];
			}
		if(!empty($arrOrder['Phone'])){
			preg_match_all("/\d/", $arrOrder["Phone"], $array);
			if(!empty($array[0])){
				$strPhone = implode('',$array[0]);
				$arrFields['pg_user_phone'] = $strPhone;
			}
		}
		$arrFields['pg_sig'] = PG_Signature::make('payment.php', $arrFields, $shop->platron_secret_key);
		
        $strPaymentForm = "<form id='fplatron' target='_blank' action='https://paybox.kz/payment.php' method='POST' >";
		foreach($arrFields as $strFieldName => $strFieldValue)
			$strPaymentForm .= "<input type=hidden name='".htmlspecialchars($strFieldName)."' value='".htmlspecialchars($strFieldValue)."' />";
		
//		var_dump($strPaymentForm);
        if (!$to_string) {
			echo $strPaymentForm;
            echo "<input type=submit value='".NETCAT_MODULE_NETSHOP_PAYMENT_SUBMIT."'></form>";
            return true;
        } else {
            return $strPaymentForm.'</form>';
        }
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
