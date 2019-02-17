# Setup
To use this you'll have to first acquire your `clientId` & `clientSecret` from `https://api.slack.com/apps` then make sure that you also set your redirect URL to `http://YOUR-HUMHUB.com/user/auth/external?authclient=slack` or it won't work.

```php
return [
    // ...
    'components' => [
        // ...
        'authClientCollection' => [
            'clients' => [
                // ...
                'slack' => [
                    'class' => 'humhub\modules\user\authclient\Slack',
                    'clientId' => 'Your App ID here',
                    'clientSecret' => 'Your App Secret here',
                ],
            ],
        ],
        // ...
    ],
    // ...
];
```
