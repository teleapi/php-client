<?php

class TeleSipAccounts extends BaseTele {
	public function __construct($token=false) {
		parent::__construct($token);
		$this->controller = 'sipaccounts';
	}

	public function create($username, $password, $type) {
		$this->function = 'create';
		$this->data = array(
			'username' => $username,
			'password' => $password,
			'account_type' => $type
		);
		return $this->call();
	}

	public function list_accounts() {
		$this->function = 'list';
		$this->data = array();
		return $this->call();
	}

	public function update($sipaccount_id, $username, $password, $type) {
		$this->function = 'update';
		$this->data = array(
			'sipaccount_id' => $sipaccount_id,
			'username' => $username,
			'password' => $password,
			'account_type' => $type
		);
		return $this->call();
	}

	public function remove($sipaccount_id) {
		$this->function = 'remove';
		$this->data = array(
			'sipaccount_id' => $sipaccount_id
		);
		return $this->call();
	}
}
