<?php

namespace Ingoldsby\GoogleAnalyticsRealtimeTile;

use Spatie\Dashboard\Models\Tile;

class GoogleAnalyticsRealtimeStore
{
    private Tile $tile;

    public static function make()
    {
        return new static();
    }

    public function __construct()
    {
        $this->tile = Tile::firstOrCreateForName("google_analytics_realtime");
    }

    public function setAnalyticsRealtime(array $analyticsRealtime) : self
    {
        $this->tile->putData('active_users', $analyticsRealtime['active_users']);
        $this->tile->putData('urls', $analyticsRealtime['urls']);
        $this->tile->putData('devices', $analyticsRealtime['devices']);

        return $this;
    }

    public function analyticsRealtimeActiveUsers()
    {
        return $this->tile->getData('active_users') ?? [];
    }

    public function analyticsRealtimeUrls()
    {
        return $this->tile->getData('urls') ?? [];
    }

    public function analyticsRealtimeDevices()
    {
        return $this->tile->getData('devices') ?? [];
    }

}
