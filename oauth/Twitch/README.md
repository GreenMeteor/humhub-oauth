# Setup

```php
return [
    // ...
    'components' => [
        // ...
        'authClientCollection' => [
            'clients' => [
                // ...
                'twitch' => [
                    'class' => 'humhub\modules\user\authclient\Twitch',
                    'clientId' => 'Your Twitch App ID here',
                    'clientSecret' => 'Your Twitch App Secret here',
                ],
            ],
        ],
        // ...
    ],
    // ...
];
```
