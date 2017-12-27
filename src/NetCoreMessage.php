<?php

namespace NotificationChannels\NetCore;

class NetCoreMessage {

	public $body;
	public $recipient;

	public static function create($body = '')
	{
		return new static($body);
	}

	public function __construct($body = '')
	{
		if (!empty($body)) {
			$this->body = trim($body);
		}
	}

	public function setBody($body)
	{
		$this->body = trim($body);

		return $this;
	}

	public function setrecipient($recipient)
	{
		$this->recipient = $recipient;

		return $this;
	}

	public function toJson()
	{
		return json_encode($this);
	}
}