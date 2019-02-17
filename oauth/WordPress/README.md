# Setup

```php
return [
    // ...
    'components' => [
        // ...
        'authClientCollection' => [
            'clients' => [
                // ...
                'wordpress' => [
                    'class' => 'humhub\modules\user\authclient\WordPress',
                    'clientId' => 'Your App ID here',
                    'clientSecret' => 'Your App Secret here',
                ],
            ],
        ],
        // ...
    ],
    // ...
];
