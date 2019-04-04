# Setup

### Code Snippet
```php
return [
    // ...
    'components' => [
        // ...
        'authClientCollection' => [
            'clients' => [
                // ...
                'rocketfirm' => [
                    'class' => 'humhub\modules\user\authclient\RocketFirm',
                    'clientId' => 'Your RocketFirm ID here',
                    'clientSecret' => 'Your RocketFirm Secret here',
                ],
            ],
        ],
        // ...
    ],
    // ...
];
```
