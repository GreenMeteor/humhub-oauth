# Setup
1. Under `/protected/humhub/modules/user/authclient` place the [GitLab.php](GitLab/GitLab.php) file here.
2. Under `/protected/config` in `common.php` place the following snippet in and save.

```php
return [
    // ...
    'components' => [
        // ...
        'authClientCollection' => [
            'clients' => [
                // ...
                'gitlab' => [
                    'class' => 'humhub\modules\user\authclient\GitLab',
                    'clientId' => 'Your client ID here',
                    'clientSecret' => 'Your client Secret here',
                ],
            ],
        ],
        // ...
    ],
    // ...
];
```

> Note: For more information on HumHub's oauth clients please refer to their [docs](http://docs.humhub.org/admin-authentication.html).
