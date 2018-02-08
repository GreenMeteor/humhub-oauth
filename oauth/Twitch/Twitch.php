<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\authclient;

use Yii;
use yii\authclient\OAuth2;

class Twitch extends OAuth2
{

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fab fa-twitch',
            'buttonBackgroundColor' => '#395697',
        ];
    }

    /**
     * @inheritdoc
     */
    public $authUrl = 'https://api.twitch.tv/kraken/oauth2/authorize';
  
    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://api.twitch.tv/kraken/oauth2/token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://api.twitch.tv/kraken';

    /**
     * @inheritdoc
     */
    public $scope = 'user_read';

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        return $this->api('user', 'GET');
    }

    /**
     * @inheritdoc
     */
    protected function apiInternal($accessToken, $url, $method, array $params, array $headers)
    {
        $params['oauth_token'] = $accessToken->getToken();
        return $this->sendRequest($method, $url, $params, $headers);
    }

    /**
     * @inheritdoc
     */
    protected function defaultReturnUrl()
    {
        $params = $_GET;
        unset($params['code']);
        unset($params['scope']);
        $params[0] = Yii::$app->controller->getRoute();
        return Yii::$app->getUrlManager()->createAbsoluteUrl($params);
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'twitch';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Twitch';
    }

    /**
     * @inheritdoc
     */
    protected function defaultNormalizeUserAttributeMap()
    {
        return [
            'id' => '_id',
        ];
    }
}
