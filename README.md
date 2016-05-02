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

Google Tag Manager and Google Analytics code should be set just after the <body> tag
```
</head>
<body>
	{$AnalyticsCode}
...
```

### Using Google Search Console verification with Google Tag Manager

If you have a **Google Tag Manager** account, you you can verify ownership of a site using your **Google Tag Manager** container snippet code.

To verify ownership using **Google Tag Manager**, choose **Google Tag Manager** in the verification details page for your site, and follow the instructions shown.

When copying Tag Manager code:

- You must have "View, Edit, and Manage" account level permissions in **Google Tag Manager**.
- Place the Tag Manager code immediately after the opening <body> tag of your page. If you do not, verification will fail.
- You cannot insert a data layer (or anything other than HTML comments) between the <body> tag and the tag manager code. If you do, verification will fail.
- Use the code exactly as provided; do no modify it. If you modify it, verification will fail.

For more information, check out this page: https://support.google.com/webmasters/answer/35179
