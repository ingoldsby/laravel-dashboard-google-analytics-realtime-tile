<?php

namespace Ingoldsby\GoogleAnalyticsRealtimeTile;

use Illuminate\Support\ServiceProvider;
use Ingoldsby\GoogleAnalyticsRealtimeTile\GoogleAnalyticsRealtimeStore;
use Ingoldsby\GoogleAnalyticsRealtimeTile\Commands\FetchGoogleAnalyticsRealtimeCommand;
use Ingoldsby\GoogleAnalyticsRealtimeTile\Components\GoogleAnalyticsRealtimeActiveUsersComponent;
use Ingoldsby\GoogleAnalyticsRealtimeTile\Components\GoogleAnalyticsRealtimeDevicesComponent;
use Ingoldsby\GoogleAnalyticsRealtimeTile\Components\GoogleAnalyticsRealtimeUrlsComponent;
use Livewire\Livewire;

class GoogleAnalyticsRealtimeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchGoogleAnalyticsRealtimeCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/dashboard-google-analytics-realtime-tiles'),
        ], 'dashboard-google-analytics-realtime-tiles');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dashboard-google-analytics-realtime-tiles');

        Livewire::component('google-analytics-realtime-active-users-tile', GoogleAnalyticsRealtimeActiveUsersComponent::class);
        Livewire::component('google-analytics-realtime-devices-tile', GoogleAnalyticsRealtimeDevicesComponent::class);
        Livewire::component('google-analytics-realtime-urls-tile', GoogleAnalyticsRealtimeUrlsComponent::class);
        
    }
}
