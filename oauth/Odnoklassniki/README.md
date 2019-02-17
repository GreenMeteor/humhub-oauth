# Setup

```php
return [
    // ...
    'components' => [
        // ...
        'authClientCollection' => [
            'clients' => [
                // ...
                'odnoklassniki' => [
                    'class' => 'humhub\modules\user\authclient\Odnoklassniki',
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
