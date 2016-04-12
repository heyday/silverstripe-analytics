<?php
namespace Heyday\Analytics;

/**
 * Class GoogleTagManagerProvider
 *
 * @package silverstripe-analytics
 * @license MIT License https://github.com/heyday/silverstripe-analytics/LICENSE
 **/
class GoogleTagManagerProvider extends AnalyticsProvider
{

    /**
     * @var array $data Contains any manually set data layer key value pairs
     */
    private static $dataLayers = [];

    /**
     * @return string
     */
    public function getAnalyticsCode()
    {
        $id = $this->getAnalyticsID();

        $datalayers = self::getDataLayer();

        $analyticsCode = <<< EOS
            <!-- Google Tag Manager -->
			<noscript><iframe src="//www.googletagmanager.com/ns.html?id=$id height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','$id');</script>
			<!-- End Google Tag Manager -->
EOS;

        $code = $datalayers . "\n" . $analyticsCode;
        return $code;
    }

    /**
     * Assign a data layer key value pair. This is be the same as pushing to
     * the data layer.
     *
     * @param string $key The data layer key / name
     * @param string $value The data layer value
     *
     * @return void
     */
    public function insertDataLayer($key, $value)
    {
        self::$dataLayers[$key] = $value;
    }

    /**
     * Create the data layer code. All things like manually set data layer values
     * are processed and built as one data layer. Creating this way
     * stops the need of having to set a JavaScript data layer variable initially
     * within the page code and stops issues with undefined data layer when pushing.
     *
     * @return string
     */
    public static function getDataLayer()
    {
        $javascript = '<script>dataLayer = [{';

        // combine all the data layer values into a single data layer
        $javascript .= implode(',',
            array_filter(
                array(
                    self::buildDataLayer()
                )
            )
        );

        $javascript .= '}];</script>';

        return $javascript;
    }

    /**
     * Creates a JSON array formatted string containing our created data layer
     * key value pairs.
     *
     * @return string
     */
    private static function buildDataLayer()
    {
        $data = [];
        foreach (self::$dataLayers as $key => $value) {
            $data[] .= "'" . $key . "' : '" . $value . "'";
        }
        return implode(',', $data);
    }


}