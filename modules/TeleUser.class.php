<?php

class TeleUser extends BaseTele {
	public function __construct($token=false) {
		parent::__construct($token);
		$this->controller = 'user';
	}

	public function update($opts = array()) {
		$this->function = 'update';
		$this->data = $opts;
		return $this->call();
	}

	public function update_password($current_password, $new_password) {
		$this->function = 'password/update';
		$this->data = array(
			'curpass' => $current_password,
			'newpass' => $new_password
		);
		return $this->call();
	}
}
