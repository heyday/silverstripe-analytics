<?php

namespace Heyday\Analytics;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Core\Injector\Injector;

/**
 * Class AnalyticsExtension
 *
 * @package Heyday\Analytics
 * @license MIT License https://github.com/heyday/silverstripe-analytics/LICENSE
 */
class AnalyticsExtension extends DataExtension
{
    /**
     * @var array
     */
    private static $casting = [
        'AnalyticsCode' => 'HTMLFragment',
        'TagManagerNoScript' => 'HTMLFragment'
    ];

    /**
     * @return string
     */
    public function getAnalyticsCode()
    {
        try {
            if ($analyticsService = Injector::inst()->get('AnalyticsService')) {
                return $analyticsService->getAnalyticsCode();
            }
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * @return string
     */
    public function getTagManagerNoScript()
    {
        try {
            if ($analyticsService = Injector::inst()->get('AnalyticsService')) {
                return $analyticsService->getTagManagerNoScript();
            }
        } catch (\Exception $e) {
            return '';
        }

    }
}
