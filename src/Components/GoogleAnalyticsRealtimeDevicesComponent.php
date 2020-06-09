<?php

namespace Ingoldsby\GoogleAnalyticsRealtimeTile\Components;

use Ingoldsby\GoogleAnalyticsRealtimeTile\GoogleAnalyticsRealtimeStore;
use Livewire\Component;

class GoogleAnalyticsRealtimeDevicesComponent extends Component
{
    /** @var string */
    public $position;

    public function mount(string $position)
    {
        $this->position = $position;
    }

    public function render()
    {
        return view('dashboard-google-analytics-realtime-tiles::devices.tile', [
            'devices' => GoogleAnalyticsRealtimeStore::make()->analyticsRealtimeDevices(),
            'refreshIntervalInSeconds' => config('dashboard.tiles.google_analytics_realtime.refresh_interval_in_seconds') ?? 60,
        ]);
    }
}