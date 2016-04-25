<?php

class TeleUserDids extends BaseTele {
	public function __construct($token=false) {
		parent::__construct($token);
		$this->controller = 'user/dids';
	}

	public function list_dids($type='local', $limit=false, $offset=false) {
		$this->function = 'list';
		$this->data = array( 'type' => $type );
		if ($limit) {
			$this->data['limit'] = $limit;
		}
		if ($offset) {
			$this->data['offset'] = $offset;
		}
		return $this->call();
	}

	public function remove($did_id) {
		$this->function = 'remove';
		$this->data = array( 'did_id' => $did_id );
		return $this->call();
	}

	public function assign($did_id, $new_user_id) {
		$this->function = 'assign';
		$this->data = array(
			'did_id' => $did_id,
			'new_user_id' => $new_user_id
		);
		return $this->call();
	}

	public function set_flow($did_id, $flow_id) {
		$this->function = 'flow';
		$this->data = array(
			'did_id' => $did_id,
			'flow_id' => $flow_id
		);
		return $this->call();
	}

	public function set_channel_group($did_id, $channel_group_id) {
		$this->function = 'channelgroup';
		$this->data = array(
			'did_id' => $did_id,
			'channel_group_id' => $channel_group_id
		);
		return $this->call();
	}

	public function set_voicemail_inbox($did_id, $voicemail_inbox_id) {
		$this->function = 'voicemail';
		$this->data = array(
			'did_id' => $did_id,
			'inbox_id' => $voicemail_inbox_id
		);
		return $this->call();
	}

	public function convert_to_fax($did_id) {
		$this->function = 'convert/fax';
		$this->data = array( 'did_id' => $did_id );
		return $this->call();
	}

	public function convert_to_voice($did_id) {
		$this->function = 'convert/voice';
		$this->data = array( 'did_id' => $did_id );
		return $this->call();
	}
}
