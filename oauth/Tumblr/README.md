# Setup

```php
return [
    // ...
    'components' => [
        // ...
        'authClientCollection' => [
            'clients' => [
                // ...
                'tumblr' => [
                    'class' => 'humhub\modules\user\authclient\Tumblr',
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
