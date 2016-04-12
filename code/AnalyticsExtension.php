<?php
namespace Heyday\Analytics;

/**
 * Class AnalyticsExtension
 *
 * @package silverstripe-analytics
 * @license MIT License https://github.com/heyday/silverstripe-analytics/LICENSE
 **/
class AnalyticsExtension extends \DataExtension
{

    /**
     * @return string
     */
    public function getAnalyticsCode()
    {
        if ($analyticsService = \Injector::inst()->get('AnalyticsService')) {
            return $analyticsService->getAnalyticsCode();
        }
    }


}