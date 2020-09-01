# Setup

```php
return [
    // ...
    'components' => [
        // ...
        'authClientCollection' => [
            'clients' => [
                // ...
                'apple' => [
                    'class' => 'humhub\modules\user\authclient\Apple',
                    'clientId' => 'Your ID here',
                    'clientSecret' => 'Your Secret ID here',
                ],
            ],
        ],
        // ...
    ],
    // ...
];
```
