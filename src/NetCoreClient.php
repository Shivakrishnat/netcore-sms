<?php

namespace NotificationChannels\NetCore;

use Exception;
use GuzzleHttp\Client;
use NotificationChannels\NetCore\Exceptions\CouldNotSendNotification;

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
			$this->client->request('POST', 'https://bulkpush.mytoday.com/BulkSms/SingleMsgApi', [
				'feed_id'  => $this->feed_id,
				'username' => $this->username,
				'password' => $this->password,
				'to'       => $message->recipient,
				'text'     => $message,
			]);
		} catch (Exception $exception) {
			throw CouldNotSendNotification::serviceRespondedWithAnError($exception);
		}
	}
}