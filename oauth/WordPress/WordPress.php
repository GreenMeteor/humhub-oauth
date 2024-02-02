<?php

namespace humhub\modules\user\authclient;

use yii\authclient\OAuth2;

class WordPress extends OAuth2
{

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions(): array
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fab fa-wordpress',
            'buttonBackgroundColor' => '#395697',
        ];
    }

    /**
     * @inheritdoc
     */
    public $authUrl = 'https://public-api.wordpress.com/oauth2/authorize';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://public-api.wordpress.com/oauth2/token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://public-api.wordpress.com/rest/v1.1/';

    /**
     * @inheritdoc
     */
    public $scope = 'auth';

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        return $this->api('me', 'GET');
    }

    /**
     * @inheritdoc
     */
    public function applyAccessTokenToRequest($request, $accessToken)
    {
        $request->getHeaders()->set('Authorization', 'Bearer ' . $accessToken->getToken());
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'wordpress';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'WordPress';
    }
}
