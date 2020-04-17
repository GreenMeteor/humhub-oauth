# Setup
See [Storenvy docs](https://developers.storenvy.com/authentication) for more information.

```php
return [
    // ...
    'components' => [
        // ...
        'authClientCollection' => [
            'clients' => [
                // ...
                'storenvy' => [
                    'class' => 'humhub\modules\user\authclient\Storenvy',
                    'clientId' => 'Your Storenvy App ID here',
                    'clientSecret' => 'Your Storenvy App Secret here',
                ],
            ],
        ],
        // ...
    ],
    // ...
];
```
