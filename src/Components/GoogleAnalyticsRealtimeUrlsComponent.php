<?php

namespace Ingoldsby\GoogleAnalyticsRealtimeTile\Components;

use Ingoldsby\GoogleAnalyticsRealtimeTile\GoogleAnalyticsRealtimeStore;
use Livewire\Component;

class GoogleAnalyticsRealtimeUrlsComponent extends Component
{
    /** @var string */
    public $position;

    public function mount(string $position)
    {
        $this->position = $position;
    }

    public function render()
    {
        return view('dashboard-google-analytics-realtime-tiles::urls.tile', [
            'urls' => GoogleAnalyticsRealtimeStore::make()->analyticsRealtimeUrls(),
            'refreshIntervalInSeconds' => config('dashboard.tiles.google_analytics_realtime.refresh_interval_in_seconds') ?? 60,
        ]);
    }
}