# [HumHub](https://humhub.org/en) OAuths
A number of Social OAuth for the Social Platform HumHub

### OAuth Install & Setup
Once you've downloaded & uploaded the contents from both the Discord & Slack directories to `/protected/humhub/modules/user/authclient` add the following codes to your `common.php` file located in `/protected/config`.
#### [Discord](/oauth/Discord)
```php
'discord' => [
                    'class' => 'humhub\modules\user\authclient\Discord',
                    'clientId' => 'YOUR CLIENT ID HERE',
                    'clientSecret' => 'YOUR SECRET HERE',
             ],
```

#### [Slack](/oauth/Slack)
```php
'slack' => [
                    'class' => 'humhub\modules\user\authclient\Slack',
                    'clientId' => 'YOUR CLIENT ID HERE',
                    'clientSecret' => 'YOUR SECRET HERE',
           ],
```

#### [WordPress](/oauth/WordPress)
```php
'wordpress' => [
                    'class' => 'humhub\modules\user\authclient\WordPress',
                    'clientId' => '56072',
                    'clientSecret' => 'mYu1foz7WWGy6P8fymh1EP19aD85lWTqthKmGUvORzMxlHfP7UyXJSkbPisX2PyY',
           ],
```

_More to come!_

> **Notice: These aren't 100% working, and need work done before they can be used!**
