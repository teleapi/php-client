<?php

class TeleVoicemail extends BaseTele {
	public function __construct($token=false) {
		parent::__construct($token);
		$this->controller = 'voicemail';
	}

	public function create_inbox($name, $inbox_number, $pin, $transcribe=true) {
		$this->function = 'inbox/create';
		$this->data = array(
			'name' => $name,
			'inbox_number' => $inbox_number,
			'pin' => $pin,
			'transcribe' => ($transcribe) ? 1 : 0
		);
		return $this->call();
	}

	public function get_inbox($inbox_id) {
		$this->function = 'inbox/get';
		$this->data = array(
			'inbox_id' => $inbox_id
		);
		return $this->call();
	}

	public function list_inboxes() {
		$this->function = 'inbox/list';
		$this->data = array();
		return $this->call();
	}

	public function update_inbox($inbox_id, $name, $inbox_number, $pin, $transcribe) {
		$this->function = 'inbox/update';
		$this->data = array(
			'inbox_id' => $inbox_id,
			'name' => $name,
			'inbox_number' => $inbox_number,
			'pin' => $pin,
			'transcribe' => ($transcribe) ? 1 : 0
		);
		return $this->call();
	}

	public function remove_inbox($inbox_id) {
		$this->function = 'inbox/remove';
		$this->data = array( 'inbox_id' => $inbox_id );
		return $this->call();
	}
}
