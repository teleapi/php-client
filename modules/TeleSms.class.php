<?php

class TeleSms extends BaseTele {
	public function __construct($token=false) {
		parent::__construct($token);
		$this->url = 'https://sms.teleapi.net';
	}

	public function send_sms($source, $destination, $message, $callback_url=false) {
		$this->controller = 'sms';
		$this->function = 'send';
		$this->data = array(
			'source' => $source,
			'destination' => $destination,
			'message' => $message
		);
		if ($callback_url) {
			$this->data['notify_url'] = $callback_url;
		}
		return $this->call();
	}

	public function send_mms($source, $destination, $full_file_path, $callback_url=false) {
		$this->controller = 'mms';
		$this->function = 'send';
		if (!file_exists($full_file_path)) {
			return (object) array(
				'code' => 400,
				'status' => 'error',
				'data' => 'The file you are trying to send does not exist on this system'
			);
		}
		$file_split = explode('/', $full_file_path);
		$file_name = array_pop($file_split);
		$file_path = implode('/', $file_split);
		$file_data = base64_encode(file_get_contents($full_file_path));
		$this->data = array(
			'source' => $source,
			'destination' => $destination,
			'file_name' => $file_name,
			'file_data' => $file_data
		);
	}
}
