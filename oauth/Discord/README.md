# Setup
To use this you'll have to first acquire your `clientId` & `clientSecret` from `https://discordapp.com/developers/applications/me` then make sure that you also set your redirect URI to `http://YOUR-HUMHUB.com/user/auth/external?authclient=discord` or it won't work.

```php
return [
    // ...
    'components' => [
        // ...
        'authClientCollection' => [
            'clients' => [
                // ...
                'discord' => [
                    'class' => 'humhub\modules\user\authclient\Discord',
                    'clientId' => 'Your Discord App ID here',
                    'clientSecret' => 'Your Discord App Secret here',
                    'returnUrl' => 'http://YOUR-HUMHUB.com/user/auth/external?authclient=discord',
                ],
            ],
        ],
        // ...
    ],
    // ...
];
```

> Note: There is now a [Discord Oauth](https://github.com/GreenMeteor/humhub-discord-module) module available to the public.
