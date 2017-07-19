<?php

namespace Heyday\Analytics;

/**
 * Interface AnalyticsProviderInterface
 * @package silverstripe-analytics
 *
 * @license MIT License https://github.com/heyday/silverstripe-analytics/LICENSE
 **/
interface AnalyticsProviderInterface
{

    /**
     * @return mixed
     */
    public function getAnalyticsCode();


}