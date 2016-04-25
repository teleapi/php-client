<?php

class TeleCustomers extends BaseTele {
	public function __construct($token=false) {
		parent::__construct($token);
		$this->controller = 'customers';
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

	public function list_customers() {
		$this->function = 'list';
		$this->data = array();
		return $this->call();
	}

	public function update($customer_id, $options=array()) {
		$this->function = 'update';
		$this->data = array( 'id' => $customer_id );
		$this->data = array_merge($this->data, $options);
		return $this->call();
	}

	public function enable($customer_id) {
		$this->function = 'enable';
		$this->data = array( 'customer_id' => $customer_id );
		return $this->call();
	}

	public function disable($customer_id) {
		$this->function = 'disable';
		$this->data = array( 'customer_id' => $customer_id );
		return $this->call();
	}

	public function rates($customer_id) {
		$this->function = 'rates';
		$this->data = array( 'customer_id' => $customer_id );
		return $this->call();
	}

	public function fund($customer_id, $amount) {
		$this->function = 'fund';
		$this->data = array(
			'customer_id' => $customer_id,
			'amount' => $amount
		);
		return $this->call();
	}
}
