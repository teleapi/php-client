<?php

class TeleLnp extends BaseTele {
	public function __construct($token=false) {
		parent::__construct($token);
		$this->controller = 'lnp';
	}

	public function create($numbers, $btn, $location_type, $bcontact_or_fname, $bname_or_lname, $acc_number, $address, $city, $state, $zip, $full_signature_path, $partial_details=false, $wireless_pin=false, $caller_id=false) {
		if (!is_array($numbers)) {
			return (object) array( 'code' => 400, 'status' => 'error', 'data' => '$numbers must be an array of number(s)');
		}
		foreach ($numbers as $i => $number) {
			$number = preg_replace('/[^0-9]/', '', $number);
			if (substr($number, 0, 1) == '1') {
				$number = substr($number, 1);
			}
			$numbers[$i] = $number;
		}
		if (!file_exists($full_signature_path)) {
			return (object) array( 'code' => 400, 'status' => 'error', 'data' => 'signature file does not exist at provided location');
		}
		$signature = base64_encode(file_get_contents($full_signature_path));
		$this->function = 'create';
		$this->data = array(
			'numbers' => implode(',', $numbers),
			'btn' => $btn,
			'location_type' => $location_type,
			'account_number' => $acc_number,
			'service_address' => $address,
			'service_city' => $city,
			'service_state' => $state,
			'service_zip' => $zip,
			'partial_port' => ($partial_details) ? 1 : 0,
			'wireless_number' => ($wireless_pin) ? 1 : 0,
			'signature' => $signature
		);
		if ($location_type == 'business') {
			$this->data['business_contact'] = $bcontact_or_fname;
			$this->data['business_name'] = $bname_or_lname;
		} else {
			$this->data['first_name'] = $bcontact_or_fname;
			$this->data['last_name'] = $bname_or_lname;
		}
		if ($partial_details) {
			$this->data['partial_port_details'] = $partial_details;
		}
		if ($wireless_pin) {
			$this->data['wireless_pin'] = $wireless_pin;
		}
		if ($caller_id) {
			$this->data['caller_id'] = $caller_id;
		}
		return $this->call();
	}

	public function list_requests() {
		$this->function = 'list';
		$this->data = array();
		return $this->call();
	}

	public function get_request($request_id) {
		$this->function = 'get';
		$this->data = array( 'request_id' => $request_id );
		return $this->call();
	}

	public function check_numbers($numbers) {
		if (!is_array($numbers)) {
			return (object) array( 'code' => 400, 'status' => 'error', 'data' => '$numbers must be an array of number(s)');
		}
		foreach ($numbers as $i => $number) {
			$number = preg_replace('/[^0-9]/', '', $number);
			if (substr($number, 0, 1) == '1') {
				$number = substr($number, 1);
			}
			$numbers[$i] = $number;
		}
		$this->function = 'check';
		$this->data = array( 'numbers' => implode(',', $numbers) );
		return $this->call();
	}
}
