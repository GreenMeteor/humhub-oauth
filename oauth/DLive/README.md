# Setup
To use this you'll have to first acquire your `clientId` & `clientSecret` from `https://dlive.typeform.com/to/uchbIE`, make sure that the given redirect URI is to `http(or https if you have that enabled on yoru server)://YOUR-HUMHUB.com/user/auth/external?authclient=dlive` or your app will fail.

```php
return [
    // ...
    'components' => [
        // ...
        'authClientCollection' => [
            'clients' => [
                // ...
                'dlive' => [
                    'class' => 'humhub\modules\user\authclient\Dlive',
                    'clientId' => 'Your DLive App ID here',
                    'clientSecret' => 'Your DLive App Secret here',
                ],
            ],
        ],
        // ...
    ],
    // ...
];
```
