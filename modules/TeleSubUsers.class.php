<?php

class TeleSubUsers extends BaseTele {
	public function __construct($token=false) {
		parent::__construct($token);
		$this->controller = 'subusers';
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

	public function list_subusers() {
		$this->function = 'list';
		$this->data = array();
		return $this->call();
	}

	public function update($subuser_id, $options=array()) {
		$this->function = 'update';
		$this->data = array( 'subuser_id' => $subuser_id );
		$this->data = array_merge($this->data, $options);
		return $this->call();
	}

	public function remove($subuser_id) {
		$this->function = 'remove';
		$this->data = array('subuser_id' => $subuser_id);
		return $this->call();
	}
}
