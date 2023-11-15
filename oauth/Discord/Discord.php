<?php

/**
 * @link https://www.greenmeteor.net/
 * @copyright Copyright (c) 2020 Green Meteor Co.
 * @license https://greenmeteor.net/p/licences
 */

namespace humhub\modules\user\authclient;

use Yii;
use yii\authclient\OAuth2;
use yii\authclient\OAuthToken;

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
    public $authUrl = 'https://discord.com/api/oauth2/authorize';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://discord.com/api/oauth2/token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://discord.com/api/v10';

    /**
     * @inheritdoc
     */
    public $scope = 'identify email';

    /**
     * @inheritdoc
     */
    public $autoRefreshAccessToken = true;

    /**
     * @inheritdoc
     */
    public $autoExchangeAccessToken = false;

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
    public function fetchAccessToken($authCode, array $params = [])
    {
        $token = parent::fetchAccessToken($authCode, $params);
        if ($this->autoExchangeAccessToken) {
            $token = $this->exchangeAccessToken($token);
        }
        return $token;
    }

    /**
     *
     * @param OAuthToken $token short-live access token.
     * @return OAuthToken long-live access token.
     */
    public function exchangeAccessToken(OAuthToken $token)
    {
        $params = [
            'grant_type' => 'exchange_code',
            'exchange_code' => $token->getToken(),
        ];

        $request = $this->createRequest()
            ->setMethod('POST')
            ->setUrl($this->tokenUrl)
            ->setData($params);

        $this->applyClientCredentialsToRequest($request);

        $response = $this->sendRequest($request);

        $token = $this->createToken(['params' => $response]);
        $this->setAccessToken($token);

        return $token;
    }
    /**
     * 
     * @param string $authCode client auth code.
     * @param array $params
     * @return OAuthToken long-live client-specific access token.
     */
    public function fetchClientAccessToken($authCode, array $params = [])
    {
        $params = array_merge([
            'code' => $authCode,
            'redirect_uri' => $this->getReturnUrl(),
            'client_id' => $this->clientId,
        ], $params);

        $request = $this->createRequest()
            ->setMethod('POST')
            ->setUrl($this->tokenUrl)
            ->setData($params);

        $response = $this->sendRequest($request);

        $token = $this->createToken(['params' => $response]);
        $this->setAccessToken($token);

        return $token;
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
