<?php

class TeleFlows extends BaseTele { 
	public function __construct($token=false) {
		parent::__construct($token);
		$this->controller = 'flows';
	}
	
	public function create($flow_name, $flow_data) {
		$this->function = 'create';
		$this->data = array(
			'flow_name' => $flow_name,
			'flow_data' => $flow_data
		); 
		return $this->call();
	}
	
	public function default_set($flow_id) {
		$this->function = 'default/set';
		$this->data = array(
			'flow_id' => $flow_id
		);
		return $this->call();
	}
	
	public function did_assign($did_id, $flow_id) {
		$this->function = 'did/assign';
		$this->data = array(
			'did_id' => $did_id,
			'flow_id' => $flow_id
		);
		return $this->call();
	}
	
	public function get($flow_id) {
		$this->function = 'get';
		$this->data = array( 'flow_id' => $flow_id );
		return $this->call();
	}
	
	public function list_flows() {
		$this->function = 'list';
		$this->data = array();
		return $this->call();
	}
	
	public function remove($flow_id) {
		$this->function = 'remove';
		$this->data = array( 'flow_id' => $flow_id );
		return $this->call();
	}
	
	public function update($flow_id, $flow_name, $flow_data) {
		$this->function = 'update';
		$this->data = array(
			'flow_id' => $flow_id,
			'flow_name' => $flow_name,
			'flow_data' => $flow_data
		);
		return $this->call();
	}
	
}
