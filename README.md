Use this repo as a skeleton for your new channel, once you're done please submit a Pull Request on [this repo](https://github.com/laravel-notification-channels/new-channels) with all the files.

Here's the latest documentation on Laravel 5.3 Notifications System: 

https://laravel.com/docs/master/notifications

# NetCore notifications channel for Laravel 5.3 and above.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-notification-channels/:package_name.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/:package_name)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/laravel-notification-channels/:package_name/master.svg?style=flat-square)](https://travis-ci.org/laravel-notification-channels/:package_name)
[![StyleCI](https://styleci.io/repos/:style_ci_id/shield)](https://styleci.io/repos/:style_ci_id)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/:sensio_labs_id.svg?style=flat-square)](https://insight.sensiolabs.com/projects/:sensio_labs_id)
[![Quality Score](https://img.shields.io/scrutinizer/g/laravel-notification-channels/:package_name.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/:package_name)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/laravel-notification-channels/:package_name/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/:package_name/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-notification-channels/:package_name.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/:package_name)

This package makes it easy to send notifications using [NetCoreSMS](link to service) with Laravel 5.3.

## Contents
- [Requirements](#requirements)
- [Installation](#installation)
	- [Setting up the NetCoreSMS service](#setting-up-the-NetCoreSMS-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Requirements
- [Sign up](https://netcore.in/products/marketing-cloud/channels/sms/) for a Netcore account
- After registration you will get feed_id, username and password

## Installation
You can install the package via composer:
``` bash
composer require laravel-notification-channels/netcoresms
```

You must install the service provider:

```php
// config/app.php
'providers' => [
    ...
    NotificationChannels\NetCoreSms\NetCoreServiceProvider::class,
],
```

### Setting up the NetCoreSMS service

Add the environment variables to your `config/services.php`:

```php
// config/services.php
...
'netcore' => [
    'feed_id' => env('NETCORE_FEED_ID'),
    'username' => env('NETCORE_USERNAME'),
    'password' => env('NETCORE_PASSWORD'),
],
...
```

## Usage

Now you can use the channel in your `via()` method inside the notification:

### Available Message methods

``` php
use Illuminate\Notifications\Notification;
use NotificationChannels\NetCoreSms\NetCoreChannel;
use NotificationChannels\NetCoreSms\NetCoreMessage;

class VpsServerOrdered extends Notification
{
    public function via($notifiable)
   	{
   	    return [NetCoreChannel::class];
   	}

    
    public function toNetCore($notifiable)
    {
        return (new NetCoreMessage("Your One Time Password (OTP) from TrakNPay is " . $this->otp))->to($notifiable->mobile);
    }
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email psteenbergen@gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [:author_name](https://github.com/:author_username)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
