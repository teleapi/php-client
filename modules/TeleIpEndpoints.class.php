<?php

class TeleIpEndpoints extends BaseTele {
	public function __construct($token=false) {
		parent::__construct($token);
		$this->controller = 'ipendpoints';
	}

	public function create($ip_address, $friendly_name) {
		$this->function = 'create';
		$this->data = array(
			'ip_address' => $ip_address,
			'ip_name' => $friendly_name
		);
		return $this->call();
	}

	public function list_endpoints() {
		$this->function = 'list';
		$this->data = array();
		return $this->call();
	}

	public function remove($endpoint_id) {
		$this->function = 'remove';
		$this->data = array( 'endpoint_id' => $endpoint_id );
		return $this->call();
	}
}
