<?php

namespace Services\Auth\Realsmart;

class RealsmartLogin {

	protected $authkey = "bNtMy4Gqqo";

	protected $proxyName = "4430isa01";
	
	protected $proxyUsrPwd = 'NEWCASTLE\53706:f3ynM4Nd';

	protected $webSiteToLogIntoUrl = 'http://www.rlsmart.net/sso/cloud/welcome_token.php';

	protected $webServiceUrl = 'http://www.rlsmart.net/webservices/realsmart_access_server.php';

	public function login($upn) {
		
		$fitForTransmissionValue = md5($this->authkey . $upn);

		$url = $this->webServiceUrl . '?method=getToken&arg1=' . $fitForTransmissionValue;

		$result = $this->get_data($url);
		
		$xml = new \SimpleXMLElement($result);
		
		if ($xml->getToken->status == 'success') {
			$token = $xml->getToken->response;
			$location = $this->webSiteToLogIntoUrl . '?token=' . $token;
			return $location;	
		} 
	}
	public function get_data($url)
	{
		$ch = \curl_init();
		\curl_setopt($ch, \CURLOPT_URL, $url);
		\curl_setopt($ch, \CURLOPT_RETURNTRANSFER,1);
		\curl_setopt($ch, \CURLOPT_HTTPPROXYTUNNEL,0);
		\curl_setopt($ch, \CURLOPT_PROXYAUTH, CURLAUTH_NTLM);
		\curl_setopt($ch, \CURLOPT_PROXYUSERPWD, $this->proxyUsrPwd); 
		\curl_setopt($ch, \CURLOPT_PROXYPORT, 80);
		\curl_setopt($ch, \CURLOPT_PROXY, $this->proxyName); 

		\curl_setopt($ch, \CURLOPT_VERBOSE, 1); 
		\curl_setopt($ch, \CURLOPT_HEADER, 0); 
		$data = \curl_exec($ch);
		echo \curl_error($ch);
		return $data;
	}

}