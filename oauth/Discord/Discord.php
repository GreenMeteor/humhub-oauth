<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\authclient;

use Yii;
use yii\helpers\Url;
use yii\authclient\OAuth2;
use yii\base\ErrorException;

class Discord extends OAuth2
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
    public $scope = 'email';

    /**
     * @inheritdoc
     */
    public $attributeNames = [
        'id',
        'name',
        'email',
    ];

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        return $this->api('users/@me/connections ', 'GET', [
        'email' => implode(',', $this->attributeNames),
        ]);
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
