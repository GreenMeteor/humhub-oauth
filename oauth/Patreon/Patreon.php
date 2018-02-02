<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\authclient;

use yii\authclient\OAuth2;

class Patreon extends OAuth2
{

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fab fa-patreon',
            'buttonBackgroundColor' => '#395697',
        ];
    }

    /**
     * @inheritdoc
     */
    public $authUrl = 'https://www.patreon.com/oauth2/authorize';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://api.patreon.com/oauth2/token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://patreon.com/api';

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        $response = $this->api('current_user', 'GET');
        return $response['data'];
    }

    /**
     * @inheritdoc
     */
    protected function apiInternal($accessToken, $url, $method, array $params, array $headers)
    {
        return $this->sendRequest($method, $url . '?access_token=' . $accessToken->getToken(), $params, $headers);
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'patreon';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Patreon';
    }
}
