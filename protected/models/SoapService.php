<?php
class SoapService
{
	function app_server_ws($function_name,$param)
	{
		try {
			$client = new SoapClient("http://app.bookoke.com/soap/ws", array('cache_wsdl' => "WSDL_CACHE_NONE"));
			$result = $client->$function_name(CJSON::encode($param)); 
            return CJSON::decode($result);
		} catch (SoapFault $fault) {
			trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
		}
	}

	function webservice_server_ws($function_name,$param)
	{
	
		try {
			$client = new SoapClient("http://webservice.bookoke.com/soap/ws", array('cache_wsdl' => "WSDL_CACHE_NONE"));
			$result = $client->$function_name(CJSON::encode($param)); 
            return CJSON::decode($result);
		} catch (SoapFault $fault) {
			trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
		}
	}
}
?>