<?php

namespace Ingoldsby\GoogleAnalyticsRealtimeTile;

use Google_Client;
use Google_Service_Analytics;

class GoogleAnalyticsRealtimeApi
{

    public static function getAnalyticsRealtime()
    {

        $analytics = self::initializeAnalytics();

        $optParams = array('dimensions' => 'rt:pagePath, rt:deviceCategory');

        try {
            $results = $analytics->data_realtime->get(
                'ga:' . config('dashboard.tiles.google_analytics_realtime.view_id'),
                'rt:activeUsers',
                $optParams);

            $realtimeInfo['active_users'] = $results->totalsForAllResults['rt:activeUsers'];

            [$url, $device] = self::extractUrlAndDeviceInfo($results->rows);

            $realtimeInfo['active_users'] = $results->totalsForAllResults['rt:activeUsers'];
            $realtimeInfo['urls'] = array_slice($url, 0, (config('dashboard.tiles.google_analytics_realtime.urls_displayed') ?? 10));
            $realtimeInfo['devices'] = $device;

            return $realtimeInfo;
        } catch (apiServiceException $e) {
            $error = $e->getMessage();

            return $error;
        }

    }

    /**
     * Initializes an Analytics Reporting API V4 service object.
     *
     * @return An authorized Analytics Reporting API V4 service object.
     */
    public static function initializeAnalytics() : Google_Service_Analytics
    {
        $client = new Google_Client();

        $client->setAuthConfig(config('dashboard.tiles.google_analytics_realtime.key_file_location'));
        $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
        $analytics = new Google_Service_Analytics($client);

        return $analytics;
    }

    public static function extractUrlAndDeviceInfo($rows) : array
    {

        $url = array();
        $device = array();

        if (isset($rows)) {
            foreach ($rows as $row) {
                $url = self::initOrUpdateArray($url, $row[0], $row[2]);
                $device = self::initOrUpdateArray($device, $row[1], $row[2]);
            }

            array_multisort($url, SORT_DESC);
            array_multisort($device, SORT_DESC);
        }

        return [$url, $device];

    }

    public static function initOrUpdateArray($array, $key, $value) : array
    {

        if (! array_key_exists($key, $array)) {
            $array[$key] = 0;
        }

        $array[$key] = $array[$key] + $value;

        return $array;

    }

}