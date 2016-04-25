<?php

class TeleChannelGroups extends BaseTele {
	public function __construct($token=false) {
		parent::__construct($token);
		$this->controller = 'channelgroups';
	}

	public function create($name, $channels) {
		$this->function = 'create';
		$this->data = array(
			'name' => $name,
			'channels' => $channels
		);
		return $this->call();
	}

	public function get($channel_group_id) {
		$this->function = 'get';
		$this->data = array(
			'channel_group_id' => $channel_group_id
		);
		return $this->call();
	}

	public function list_groups() {
		$this->function = 'list';
		$this->data = array();
		return $this->call();
	}

	public function update($channel_group_id, $name, $channels) {
		$this->function = 'update';
		$this->data = array(
			'channel_group_id' => $channel_group_id,
			'name' => $name,
			'channels' => $channels
		);
		return $this->call();
	}

	public function remove($channel_group_id) {
		$this->function = 'remove';
		$this->data = array( 'channel_group_id' => $channel_group_id );
		return $this->call();
	}
}
