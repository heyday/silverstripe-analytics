# silverstripe-analytics
Heyday's standard analytics module to be used across all sites requiring analytics

-- This module is still in Alpha phase, not ready to use in production --

First, add Google Tag Manager or Google analytics ID to your config.yml file:
```
Analytics:
  GoogleTagManagerID: GTM-XXXXX
```

```
Analytics:
  GoogleAnalyticsID: UA-XXXXXXXXX-X
```

In order to implement analytics tracker on your website, you need to declare this function in mysite/code/Page.php :

```
public function TagManager()
{
	$Analytics = new Analytics;

	$Analytics->insertDataLayer('key','value');
	$Analytics->insertDataLayer('key2','value2');

	return $Analytics->getGoogleTagManager();
}
```




