<?php

namespace NotificationChannels\NetCoreSms;

use Exception;
use GuzzleHttp\Client;
use NotificationChannels\NetCoreSms\Exceptions\CouldNotSendNotification;

class NetCoreClient {

	protected $client;
	protected $feed_id;
	protected $username;
	protected $password;

	/**
	 * NetCoreClient constructor.
	 * @param Client $client
	 * @param $access_key string API Key from NetCore API
	 */
	public function __construct(Client $client, $feed_id, $username, $password)
	{
		$this->client = $client;
		$this->feed_id = $feed_id;
		$this->username = $username;
		$this->password = $password;
	}

	/**
	 * Send the Message.
	 * @param NetCoreMessage $message
	 * @throws CouldNotSendNotification
	 */
	public function send(NetCoreMessage $message)
	{
		try {
			$url = $this->buildUri($message);
			$this->client->request('POST', $url);
		} catch (Exception $exception) {
			throw CouldNotSendNotification::serviceRespondedWithAnError($exception);
		}
	}

	/**
	 * Build Uri
	 *
	 * @param $to
	 * @param $message
	 * @return mixed
	 */
	public function buildUri($message)
	{
		$params = [
			'feedid'   => $this->feed_id,
			'username' => $this->username,
			'password' => $this->password,
			'to'       => $message->to,
			'text'     => $message->message,
		];

		return 'https://bulkpush.mytoday.com/BulkSms/SingleMsgApi' . '?' . http_build_query($params);
	}
}