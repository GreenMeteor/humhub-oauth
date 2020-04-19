# Setup
> **DO NOT USE AT THIS TIME!**

```php
return [
    // ...
    'components' => [
        // ...
        'authClientCollection' => [
            'clients' => [
                // ...
                'humhub' => [
                    'class' => 'humhub\modules\user\authclient\Humhub',
                    'jwt' => 'Your JWT Key here',
                    'returnUrl' => 'Return URL here',
                ],
            ],
        ],
        // ...
    ],
    // ...
];
```

> Note: This OAuth requires the use of the [Rest Module](https://github.com/humhub/humhub-modules-rest) to be installed.
