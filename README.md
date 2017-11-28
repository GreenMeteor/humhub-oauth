# [HumHub](https://humhub.org/en) OAuths
A number of Social OAuth for the Social Platform HumHub

### OAuth Install & Setup
Once you've downloaded & uploaded the contents from both the Discord & Slack directories to `/protected/humhub/modules/user/authclient` add the following codes to your `common.php` file located in `/protected/config`.

#### [Discord](/oauth/Discord) (Not working)
```php
'discord' => [
                    'class' => 'humhub\modules\user\authclient\Discord',
                    'clientId' => 'YOUR CLIENT ID HERE',
                    'clientSecret' => 'YOUR SECRET HERE',
             ],
```

#### [Slack](/oauth/Slack) (Not Working)
```php
'slack' => [
                    'class' => 'humhub\modules\user\authclient\Slack',
                    'clientId' => 'YOUR CLIENT ID HERE',
                    'clientSecret' => 'YOUR SECRET HERE',
           ],
```

#### [WordPress](/oauth/WordPress) (Known URL Malformed issue)
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

#### [Instagram](/oauth/Instagram) (Tested and works!)
```php
'instagram' => [
                    'class' => 'humhub\modules\user\authclient\Instagram',
                    'clientId' => 'YOUR CLIENT ID HERE',
                    'clientSecret' => 'YOUR SECRET HERE',
                ],
```

#### [QQ](/oauth/QQ) (Not Tested!)
```php
'qqauth' => [
                    'class' => 'humhub\modules\user\authclient\QqAuth',
                    'clientId' => 'YOUR CLIENT ID HERE',
                    'clientSecret' => 'YOUR SECRET HERE',
                ],
```

#### [Tumblr](/oauth/Tumblr) (Not Tested and may not work!)
```php
'qqauth' => [
                    'class' => 'humhub\modules\user\authclient\Tumblr',
                    'clientId' => 'YOUR CLIENT ID HERE',
                    'clientSecret' => 'YOUR SECRET HERE',
                ],
```

_More to come!_

> **Notice: These aren't all 100% working, and need work done before they can be used to the fullest!**
