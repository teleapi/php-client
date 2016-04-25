<?php

function Tele_autoloader($class) {
	$file = sprintf('%s/modules/%s.class.php', dirname(__FILE__), $class);
	if (file_exists($file)) {
		include_once($file);
	}
}

spl_autoload_register('Tele_autoloader');

class BaseTele {
	public $token;
	public $url;
	public $controller;
	public $function;
	public $data;

	public function __construct($token=false) {
		if ($token) {
			$this->token = $token;
		}
		$this->url = 'https://apiv1.teleapi.net';
		$this->data = array();
	}

	public function call() {
		$full_url = sprintf('%s/%s/%s', $this->url, $this->controller, $this->function);

		if ($this->token) {
			$this->data['token'] = $this->token;
		}

		foreach ($this->data as $k => $v) {
			 if (is_object($v) || is_array($v)) {
				  $this->args[$k] = json_encode($v);
			 }
		}

		$this->data = http_build_query($this->data);

		$ch = curl_init($full_url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/x-www-form-urlencoded',
			'Content-Length: ' . strlen($this->data)
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);

		curl_close($ch);
		if (!$response) {
			 return (object) array('code' => 500, 'status' => 'no response', 'data' => curl_error($ch));
		}
		$return = json_decode($response);
		if (!$return) {
			 return (object) array('code' => 500, 'status' => 'bad data', 'data' => $response);
		}
		return $return;
	}
}
