<?php

namespace NotificationChannels\NetCoreSms;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use NotificationChannels\NetCoreSms\Exceptions\InvalidConfiguration;

class NetCoreServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap the application services.
	 */
	public function boot()
	{
		$this->app->when(NetCoreChannel::class)
			->needs(NetCoreClient::class)
			->give(function () {
				$config = (object)Config::get('services.netcore');
				if (is_null($config)) {
					throw InvalidConfiguration::configurationNotSet();
				}

				return new NetCoreClient(new Client(), $config->feed_id, $config->username, $config->password);
			});
	}
}