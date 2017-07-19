<?php

namespace Heyday\Analytics;


use SilverStripe\ORM\DataExtension;
use SilverStripe\Core\Injector\Injector;

/**
 * Class AnalyticsExtension
 *
 * @package silverstripe-analytics
 * @license MIT License https://github.com/heyday/silverstripe-analytics/LICENSE
 **/
class AnalyticsExtension extends DataExtension
{

    /**
     * @return string
     */
    public function getAnalyticsCode()
    {
        if ($analyticsService = Injector::inst()->get('AnalyticsService')) {
            return $analyticsService->getAnalyticsCode();
        }
    }

    /**
     * @return string
     */
    public function getTagManagerNoScript()
    {
        if ($analyticsService = Injector::inst()->get('AnalyticsService')) {
            return $analyticsService->getTagManagerNoScript();
        }
    }
}