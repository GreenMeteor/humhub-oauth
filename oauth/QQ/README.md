# Setup

```php
return [
    // ...
    'components' => [
        // ...
        'authClientCollection' => [
            'clients' => [
                // ...
                'qq' => [
                    'class' => 'humhub\modules\user\authclient\QQ',
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
