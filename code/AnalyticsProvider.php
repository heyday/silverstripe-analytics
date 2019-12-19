<?php

namespace Heyday\Analytics;

/**
 * Class AnalyticsProvider
 * @package Heyday\Analytics
 *
 * @license MIT License https://github.com/heyday/silverstripe-analytics/LICENSE
 *
 */
class AnalyticsProvider implements AnalyticsProviderInterface
{

    private $id;

    /**
     * AnalyticsProvider constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getAnalyticsID()
    {
        if (is_null($this->id) || empty($this->id)) {
            return trigger_error("Fatal error: You are calling google analytics snippet without any ID. Please add Google Analytics ID in mysite/_config/config.yml", E_USER_ERROR);
        }

        return $this->id;
    }

    public function getAnalyticsCode()
    {
        // TODO: Implement getAnalyticsCode() method.
    }

}