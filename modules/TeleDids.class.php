<?php

class TeleDids extends BaseTele {
	public function __construct($token=false) {
		parent::__construct($token);
		$this->controller = 'dids';
	}

	public function list_states() {
		$this->function = 'states';
		$this->data = array();
		return $this->call();
	}

	public function list_ratecenters($state) {
		$this->function = 'ratecenters';
		$this->data = array( 'state' => $state );
		return $this->call();
	}

	/* $options = array(
		'search' => 'something to search on, e.g. 720 or 456' [optional],
		'type' => 'local' OR 'tollfree' OR 'international' OR 'fax' [optional]
	)
	*/
	public function list_dids($state, $ratecenter, $options=array()) {
		$this->function = 'list';
		$this->data = array(
			'state' => $state,
			'ratecenter' => $ratecenter
		);
		$this->data = array_merge($this->data, $options);
		return $this->call();
	}

	public function backorder_count($state, $ratecenter) {
		$this->function = 'backorder/count';
		$this->data = array(
			'state' => $state,
			'ratecenter' => $ratecenter
		);
		return $this->call();
	}

	public function add_to_cart($did_number, $fax=false) {
		$this->function = 'cart';
		$this->data = array(
			'did_number' => $did_number
		);
		if ($fax) {
			$this->data['fax'] = 'true';
		}
		return $this->call();
	}

	/* $options = arary(
		'fax' => 'true' OR 'false' [optional],
		'call_flow_id' => 555 [optional],
		'channel_group_id' => 555 [optional],
		'voicemail_inbox_id' => 555 [optional]
	);
	*/
	public function direct_order($did_number, $options=array()) {
		$this->function = 'order';
		$this->data = array(
			'number' => $did_number
		);
		$this->data = array_merge($this->data, $options);
		return $this->call();
	}

	public function add_backorder_to_cart($state, $ratecenter, $quantity) {
		$this->function = 'backorder/cart';
		$this->data = array(
			'state' => $state,
			'ratecenter' => $ratecenter,
			'quantity' => $quantity
		);
		return $this->call();
	}
}
