<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.org/en/licences
 */

namespace humhub\modules\user\authclient;

use Yii;
use yii\authclient\OAuth2;

/**
 * Discord Authclient
 */
class Discord extends Oauth2
{
    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fab fa-discord',
            'buttonBackgroundColor' => '#395697',
        ];
    }

    /**
     * @inheritdoc
     */
    public $authUrl = 'https://discordapp.com/api/oauth2/authorize';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://discordapp.com/api/oauth2/token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://discordapp.com/api/v6';

    /**
     * @inheritdoc
     */
    public $scope = 'identify email';

    /**
     * @inheritdoc
     */
    public $attributeNames = [
        'id',
        'email'
    ];

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        return $this->api('users/@me', 'GET');
    }

    /**
     * @inheritdoc
     */
    public function applyAccessTokenToRequest($request, $accessToken)
    {
        $request->getHeaders()->set('Authorization', 'Bearer '. $accessToken->getToken());
    }

    /**
     * @inheritdoc
     */
    protected function defaultName() {
        return 'discord';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle() {
        return 'Discord';
    }
}
