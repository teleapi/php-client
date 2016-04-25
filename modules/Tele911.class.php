<?php

class Tele911 extends BaseTele {
	public function __construct($token=false) {
		parent::__construct($token);
		$this->controller = '911';
	}

	public function create($did_id, $full_name, $address, $city, $state, $zip, $unit_type=false, $unit_number=false) {
		$this->function = 'create';
		$this->data = array(
			'did_id' => $did_id,
			'full_name' => $full_name,
			'address' => $address,
			'city' => $city,
			'state' => $state,
			'zip' => $zip
		);
		if ($unit_type) {
			$this->data['unit_type'] = strtolower($unit_type);
		}
		if ($unit_number) {
			$this->data['unit_number'] = $unit_number;
		}
		return $this->call();
	}

	public function get_info($did_id) {
		$this->function = 'info';
		$this->data = array( 'did_id' => $did_id );
		return $this->call();
	}

	public function update($did_id, $full_name, $address, $city, $state, $zip, $unit_type=false, $unit_number=false) {
		$this->function = 'update';
		$this->data = array(
			'did_id' => $did_id,
			'full_name' => $full_name,
			'address' => $address,
			'city' => $city,
			'state' => $state,
			'zip' => $zip
		);
		if ($unit_type) {
			$this->data['unit_type'] = strtolower($unit_type);
		}
		if ($unit_number) {
			$this->data['unit_number'] = $unit_number;
		}
		return $this->call();
	}

	public function remove($did_id) {
		$this->function = 'remove';
		$this->data = array( 'did_id' => $did_id );
		return $this->call();
	}

	public function validate($address, $city, $state, $zip) {
		$this->function = 'validate';
		$this->data = array(
			'address' => $address,
			'city' => $city,
			'state' => $state,
			'zip' => $zip
		);
		return $this->call();
	}
}
