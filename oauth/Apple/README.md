## Setup
Add to your HumHub configuration file (`/protected/config/common.php`):

```php
return [
    // ...
    'components' => [
        // ...
        'authClientCollection' => [
            'clients' => [
                // ...
                'apple' => [
                    'class' => 'gm\modules\oauth\authclient\Apple',
                    'clientId' => 'com.example.your.service.id', // Your Services ID
                    'clientSecret' => 'YOUR_APPLE_PRIVATE_KEY',  // Content of .p8 file or JWT token
                    'teamId' => 'YOUR_TEAM_ID',                  // Your Team ID
                    'keyId' => 'YOUR_KEY_ID',                    // Your Key ID
                ],
            ],
        ],
        // ...
    ],
];
```
