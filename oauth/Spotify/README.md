# Setup
To use the Spotify OAuth client you must register your application at `https://beta.developer.spotify.com/dashboard`. then make sure that you also set your redirect URI to `http://YOUR-HUMHUB.com/user/auth/external?authclient=spotify` in your common.php file or it won't work.

```php
return [
    // ...
    'components' => [
        // ...
        'authClientCollection' => [
            'clients' => [
                // ...
                'spotify' => [
                    'class' => 'humhub\modules\user\authclient\Spotify',
                    'clientId' => 'Your Spotify ID here',
                    'clientSecret' => 'Your Spotify secret ID here',
                    'returnUrl' => 'http://YOUR-HUMHUB.com/user/auth/external?authclient=spotify',
                ],
            ],
        ],
        // ...
    ],
    // ...
];
```
