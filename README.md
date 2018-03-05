# [HumHub](https://humhub.org/en) OAuths
A number of Social OAuth for the Social Platform HumHub

### OAuth Install & Setup
Once you've downloaded & uploaded the contents from both the Discord & Slack directories to `/protected/humhub/modules/user/authclient` add the following codes to your `common.php` file located in `/protected/config`.

#### [Discord](/oauth/Discord) (Not working)
To use this you'll have to first acquire your `clientId` & `clientSecret` from `https://discordapp.com/developers/applications/me` then make sure that you also set your redirect URI to `http://YOUR-HUMHUB.com/user/auth/external?authclient=discord` or it won't work.

```php
'discord' => [
                    'class' => 'humhub\modules\user\authclient\Discord',
                    'clientId' => 'YOUR CLIENT ID HERE',
                    'clientSecret' => 'YOUR SECRET HERE',
             ],
```

#### [Slack](/oauth/Slack) (Not Working)
To use this you'll have to first acquire your `clientId` & `clientSecret` from `https://api.slack.com/apps` then make sure that you also set your redirect URL to `http://YOUR-HUMHUB.com/user/auth/external?authclient=slack` or it won't work.

```php
'slack' => [
                    'class' => 'humhub\modules\user\authclient\Slack',
                    'clientId' => 'YOUR CLIENT ID HERE',
                    'clientSecret' => 'YOUR SECRET HERE',
           ],
```

#### [WordPress](/oauth/WordPress) (Tested!)
```php
'wordpress' => [
                    'class' => 'humhub\modules\user\authclient\WordPress',
                    'clientId' => 'YOUR CLIENT ID HERE',
                    'clientSecret' => 'YOUR SECRET HERE',
               ],
```

#### [Odnoklassniki](/oauth/Odnoklassniki) (Not Tested!)
```php
'odnoklassniki' => [
                    'class' => 'humhub\modules\user\authclient\Odnoklassniki',
                    'clientId' => 'YOUR CLIENT ID HERE',
                    'clientSecret' => 'YOUR SECRET HERE',
                   ],
```

#### [Instagram](/oauth/Instagram) (Deprecated since 1.0.1!)
```php
'instagram' => [
                    'class' => 'humhub\modules\user\authclient\Instagram',
                    'clientId' => 'YOUR CLIENT ID HERE',
                    'clientSecret' => 'YOUR SECRET HERE',
               ],
```

#### [QQ](/oauth/QQ) (Not Tested!)
```php
'qq' => [
                    'class' => 'humhub\modules\user\authclient\QQ',
                    'clientId' => 'YOUR CLIENT ID HERE',
                    'clientSecret' => 'YOUR SECRET HERE',
        ],
```

#### [Tumblr](/oauth/Tumblr) (Tested and not working!)
```php
'tumblr' => [
                    'class' => 'humhub\modules\user\authclient\Tumblr',
                    'consumerKey' => 'YOUR CLIENT ID HERE',
                    'consumerSecret' => 'YOUR SECRET HERE',
            ],
```

#### [Foursquare](/oauth/Foursquare) (Not tested!)
```php
'foursquare' => [
                    'class' => 'humhub\modules\user\authclient\Foursquare',
                    'clientId' => 'YOUR CLIENT ID HERE',
                    'clientSecret' => 'YOUR SECRET HERE',
                ],
```

#### [Pinterest](/oauth/Pinterest) (Tested!)
```php
'pinterest' => [
                    'class' => 'humhub\modules\user\authclient\Pinterest',
                    'clientId' => 'YOUR CLIENT ID HERE',
                    'clientSecret' => 'YOUR SECRET HERE',
               ],
```

#### [WeChat](/oauth/WeChat) (Not tested!)
```php
'wechat' => [
                    'class' => 'humhub\modules\user\authclient\WeChat',
                    'clientId' => 'YOUR CLIENT ID HERE',
                    'clientSecret' => 'YOUR SECRET HERE',
            ],
```

#### [Patreon](/oauth/Patreon) (Note: Do not use unless you know how Patreon Oauths work!)
```php
'patreon' => [
                    'class' => 'humhub\modules\user\authclient\Patreon',
                    'clientId' => 'YOUR CLIENT ID HERE',
                    'clientSecret' => 'YOUR SECRET HERE',
             ],
```

#### [Soundcloud](/oauth/Soundcloud) (Not tested!)
```php
'soundcloud' => [
                    'class' => 'humhub\modules\user\authclient\Soundcloud',
                    'clientId' => 'YOUR CLIENT ID HERE',
                    'clientSecret' => 'YOUR SECRET HERE',
           ],
```

#### [Twitch](/oauth/Twitch)
```php
               'twitch' => [
                    'class' => 'humhub\modules\user\authclient\Twitch',
                    'clientId' => 'YOUR CLIENT ID HERE',
                    'clientSecret' => 'YOUR SECRET HERE',
               ],
```

_More to come!_

> **Notice: These aren't all 100% working, and need work done before they can be used to the fullest!**
