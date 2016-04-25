<?php

class TeleShoppingCart extends BaseTele {
	public function __construct($token=false) {
		parent::__construct($token);
		$this->controller = 'cart';
	}

	public function get() {
		$this->function = 'get';
		$this->data = array();
		return $this->call();
	}

	public function checkout() {
		$this->function = 'checkout';
		$this->data = array();
		return $this->call();
	}

	public function remove_item($item_id) {
		$this->function = 'item/remove';
		$this->data = array( 'item_id' => $item_id );
		return $this->call();
	}
}
