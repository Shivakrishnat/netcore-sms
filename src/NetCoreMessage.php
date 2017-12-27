<?php

namespace NotificationChannels\NetCore;

class NetCoreMessage {

	/**
	 * The message content.
	 *
	 * @var string
	 */
	public $message;

	/**
	 * The phone number the message should be sent from.
	 *
	 * @var string
	 */
	public $to;

	/**
	 * Create a new message instance.
	 *
	 * @param  string $message
	 * @return void
	 */
	public function __construct($message = '')
	{
		$this->message = $message;
	}

	/**
	 * Set the message content.
	 *
	 * @param  string $content
	 * @return $this
	 */
	public function message($message)
	{
		$this->message = $message;

		return $this;
	}

	/**
	 * Set the phone number the message should be sent from.
	 *
	 * @param  string $number
	 * @return $this
	 */
	public function to($to = false)
	{
		$this->to = $to;

		return $this;
	}
}