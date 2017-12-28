<?php

namespace NotificationChannels\NetCoreSms;

use Illuminate\Notifications\Notification;

class NetCoreChannel {

	/** @var \NotificationChannels\NetCoreSms\NetCoreClient */
	protected $client;

	public function __construct(NetCoreClient $client)
	{
		$this->client = $client;
	}

	/**
	 * Send the given notification.
	 *
	 * @param mixed $notifiable
	 * @param \Illuminate\Notifications\Notification $notification
	 *
	 */
	public function send($notifiable, Notification $notification)
	{
		$message = $notification->toNetCore($notifiable);
		if (is_string($message)) {
			$message = NetCoreMessage::create($message);
		}
		if ($to = $notifiable->routeNotificationFor('netcore')) {
			$message->to($to);
		}
		$this->client->send($message);
	}
}