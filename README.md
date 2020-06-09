# A tile to display Google Analytics realtime information

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ingoldsby/laravel-dashboard-google-analytics-realtime-tile.svg?style=flat-square)](https://packagist.org/packages/ingoldsby/laravel-dashboard-google-analytics-realtime-tile)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/ingoldsby/laravel-dashboard-google-analytics-realtime-tile/run-tests?label=tests)](https://github.com/ingoldsby/laravel-dashboard-google-analytics-realtime-tile/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/ingoldsby/laravel-dashboard-google-analytics-realtime-tile.svg?style=flat-square)](https://packagist.org/packages/ingoldsby/laravel-dashboard-google-analytics-realtime-tile)

This tile can be used on [the Laravel Dashboard](https://docs.spatie.be/laravel-dashboard) to display Google Analytics realtime information.

## Installation

You can install the package via composer:

```bash
composer require ingoldsby/laravel-dashboard-google-analytics-realtime-tile
```

## Google Analytics credentials

Before using this tile you need to ensure you have the correct credentials on your system. Follow the instructions on [Real Time Reporting API Overview](https://developers.google.com/analytics/devguides/reporting/realtime/v3) to sign up to access the API. When access is granted:
1. Enable the Google Analytics API.
2. Create a [Service Account](https://developers.google.com/identity/protocols/oauth2/service-account) with appropriate permissions.
3. Navigate to the Service Account and add a new JSON private key. A JSON file will be downloaded - rename this to 'analytics-credentials.json' and move it to your root Laravel directory.

Make note of the 'Service Account ID' that is generated. It will follow the format of "<service_account_name>@<name>.iam.gserviceaccount.com".

## Google Analytics view

Access [Google Analytics](https://analytics.google.com/analytics) and navigate to the required view (e.g. Account > Properties & Apps > View). Make note of the 'View ID' that is displayed underneath the view name. Click on 'View User Management' and add a new user. The email address is the Service Account ID that was used in the Google Analytics credentials step.

More information is available on the [Real Time Reporting API Developer Guide](https://developers.google.com/analytics/devguides/reporting/realtime/v3/devguide). Also take into account your [quotas and limits on API Requests](https://developers.google.com/analytics/devguides/config/mgmt/v3/limits-quotas).

## Usage

In the `dashboard` config file, you must add this configuration in the `tiles` key.

1. Enter the view ID that you wish to gather information for e.g. 123456789.
2. If you changed the name and/or location of the analytics credentials JSON from suggested below, update the field.
3. The number of URLs displayed on the URLs tile can be limited by amending the `urls_displayed` field, with a default value of 10.
4. The `active users` tile can have the background changed depending upon a threshold of how many active users you set. If the `active_users_warning_threshold` field is not in the settings, there will be no threshold and no change to the background. Setting to a value of 0 would use the warning background when there are 0 active users. Setting to a value of 10 would use the warning background when there are 10 or fewer active users.

```php
// in config/dashboard.php

return [
    // ...
    'tiles' => [
        'google_analytics_realtime' => [
            'view_id' => '123456789',
            'key_file_location' => __DIR__ . '/../analytics-credentials.json',
            'urls_displayed' => 4,
            'active_users_warning_threshold' => 0,
        ]
    ],
];
```

In `app\Console\Kernel.php` you should schedule the `\Ingoldsby\GoogleAnalyticsRealtimeTile\Commands\FetchGoogleAnalyticsRealtimeCommand` to run every minute, pending your Google API quotas and limits.

```php
// in app/console/Kernel.php

protected function schedule(Schedule $schedule)
{
    // ...
    $schedule->command(\Ingoldsby\GoogleAnalyticsRealtimeTile\Commands\FetchGoogleAnalyticsRealtimeCommand::class)->everyMinute();
}
```

In your dashboard view you can use three separate tiles:
* `livewire:google-analytics-realtime-active-users-tile`
* `livewire:google-analytics-realtime-devices-tile`
* `livewire:google-analytics-realtime-urls-tile`

```html
<x-dashboard>
    <livewire:google-analytics-realtime-active-users-tile position="a1:a4" />
    <livewire:google-analytics-realtime-devices-tile position="b1:b4" />
    <livewire:google-analytics-realtime-urls-tile position="a5:b8" />
</x-dashboard>
```

The layout above will produce something similar to:

![Dashboard tiles](https://user-images.githubusercontent.com/26500496/84089697-05779b00-aa33-11ea-86e3-e2d4da80fc6b.png)

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email instead of using the issue tracker.

## Support Spatie

I have learnt a lot from Spatie's various packages, including [Mailcoach](https://mailcoach.app), and would recommend you check them out if you want to know more.

Learn how to create a package like this one, by watching Spatie's premium video course:

[![Laravel Package training](https://spatie.be/github/package-training.jpg)](https://laravelpackage.training)

Spatie invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support them by [buying one of their paid products](https://spatie.be/open-source/support-us).

## Credits

- [Ingoldsby](https://github.com/ingoldsby)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.