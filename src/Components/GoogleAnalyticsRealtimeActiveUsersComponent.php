<?php

namespace Ingoldsby\GoogleAnalyticsRealtimeTile\Components;

use Ingoldsby\GoogleAnalyticsRealtimeTile\GoogleAnalyticsRealtimeStore;
use Livewire\Component;

class GoogleAnalyticsRealtimeActiveUsersComponent extends Component
{
    /** @var string */
    public $position;

    public function mount(string $position)
    {
        $this->position = $position;
    }

    public function render()
    {
        return view('dashboard-google-analytics-realtime-tiles::active-users.tile', [
            'activeUsers' => GoogleAnalyticsRealtimeStore::make()->analyticsRealtimeActiveUsers(),
            'refreshIntervalInSeconds' => config('dashboard.tiles.google_analytics_realtime.refresh_interval_in_seconds') ?? 60,
        ]);
    }
}