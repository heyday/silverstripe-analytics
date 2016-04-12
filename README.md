# silverstripe-analytics

Heyday's standard analytics module to be used across all sites requiring analytics

First, add details to SilverStripe configuration; for instance by creating an _analytics.yml_ file with the following details:

```
Page:
  extensions:
    - Heyday\Analytics\AnalyticsExtension
Injector:
  AnalyticsService:
    class: Heyday\Analytics\GoogleTagManagerProvider
    constructor:
      0: 'AnalyticsID'
```

For Google Tag Manager _AnalyticsID_ will something like:

```
GTM-XXXXX
```

For Google Analytics _AnalyticsID_ will something like:

```
UA-XXXXXXXXX-X
```


Analytics for the site can now be included in a SilverStripe template simply with the following code in the relevant .SS file:

```
{$AnalyticsCode}
```

