<?php

class TeleResellers extends BaseTele {
	public function __construct($token=false) {
		parent::__construct($token);
		$this->controller = 'resellers';
	}

	public function create($username, $password, $email, $first_name, $last_name, $phone_number, $address, $city, $state, $zip) {
		$this->function = 'create';
		$this->data = array(
			'username' => $username,
			'password' => $password,
			'email' => $email,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'phone_number' => $phone_number,
			'address' => $address,
			'city' => $city,
			'state' => $state,
			'zip' => $zip
		);
		return $this->call();
	}

	public function list_resellers() {
		$this->function = 'list';
		$this->data = array();
		return $this->call();
	}

	public function update($reseller_id, $options=array()) {
		$this->function = 'update';
		$this->data = array( 'id' => $reseller_id );
		$this->data = array_merge($this->data, $options);
		return $this->call();
	}

	public function enable($reseller_id) {
		$this->function = 'enable';
		$this->data = array( 'reseller_id' => $reseller_id );
		return $this->call();
	}

	public function disable($reseller_id) {
		$this->function = 'disable';
		$this->data = array( 'reseller_id' => $reseller_id );
		return $this->call();
	}

	public function rates($reseller_id) {
		$this->function = 'rates';
		$this->data = array( 'reseller_id' => $reseller_id );
		return $this->call();
	}

	public function fund($reseller_id, $amount) {
		$this->function = 'fund';
		$this->data = array(
			'reseller_id' => $reseller_id,
			'amount' => $amount
		);
		return $this->call();
	}
}
