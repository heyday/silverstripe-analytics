<?php
/**
 * Class Analytics
 *
 * @package silverstripe-analytics
 * @license MIT License https://github.com/heyday/silverstripe-analytics/LICENSE
 **/
class Analytics extends DataExtension {

	/**
	 * @var \Config
	 */
	protected $config;

	/**
	 * @var array $data Contains any manually set data layer key value pairs
	 */
	private static $dataLayers = array();

	/**
	 * Analytics constructor.
	 * @param Controller|null $controller
     */
	public function __construct(Controller $controller = null)
	{
		parent::__construct();
		$this->config = Config::inst()->forClass(__CLASS__);
	}

	/**
	 * @return bool|string
     */
	public function getGoogleTagManager()
	{
		$id = $this->config->get('GoogleTagManagerID');
		if(isset($id)) {
			return $this->displayGoogleTagManager($id);
		} else {
			return trigger_error("Fatal error: You are calling the google tag manager snippet without any ID. Please add Google Tag Manager ID in mysite/_config/config.yml", E_USER_ERROR);
		}
	}

	/**
	 * @return bool|string
     */
	public function getGoogleAnalytics() {
		$id = $this->config->get('GoogleAnalyticsID');
		if(isset($id)) {
			return $this->displayGoogleAnalytics($id);
		} else {
			return trigger_error("Fatal error: You are calling google analytics snippet without any ID. Please add Google Analytics ID in mysite/_config/config.yml", E_USER_ERROR);
		}
	}

	/**
	 * @param $id : format GTM-XXXXXX
	 * @return string
     */
	public function displayGoogleTagManager($id) {
		return self::getDataLayer().
		'<!-- Google Tag Manager -->
			<noscript><iframe src="//www.googletagmanager.com/ns.html?id='.$id.'"
			height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':
			new Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;j.src=
			\'//www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,\'script\',\'dataLayer\',\''.$id.'\');</script>
			<!-- End Google Tag Manager -->';
	}

	/**
	 * @param $id : format UA-XXXXXXXX-X
	 * @return string
	 */
	public function displayGoogleAnalytics($id) {
		return '<script>
		  (function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');

		  ga(\'create\', \''.$id.'\', \'auto\');
		  ga(\'send\', \'pageview\');

		</script>';
	}

	/**
	 * Assign a data layer key value pair. This is be the same as pushing to 
	 * the data layer.
	 *
	 * @param string $key   The data layer key / name
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
		$data = array();
		foreach(self::$dataLayers as $key => $value) {
			$data[] .= "'".$key."' : '".$value."'";
		}
		return implode(',',$data);
	}
}