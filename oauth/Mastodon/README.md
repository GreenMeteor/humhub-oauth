# Setup
Once you have logged into your Mastodon account go to your account settings then down to development and create a new application,
once you've done this enter your app info into the below snippet into your `/protected/config/common.php` file.

```php
return [
    // ...
    'components' => [
        // ...
        'authClientCollection' => [
            'clients' => [
                // ...
                'mastodon' => [
                    'class' => 'humhub\modules\user\authclient\Mastodon',
                    'clientId' => 'Your Mastodon App ID here',
                    'clientSecret' => 'Your Mastodon App Secret here',
                    'returnUrl' => 'http://yourdomain.com/user/auth/external?authclient=mastodon',
                ],
            ],
        ],
        // ...
    ],
    // ...
];
```
