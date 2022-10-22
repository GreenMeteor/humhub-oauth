<?php

namespace humhub\modules\user\authclient;

use yii\authclient\OAuth2;

class Slack extends OAuth2
{

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fa-slack',
            'buttonBackgroundColor' => '#395697',
        ];
    }

    /**
     * @inheritdoc
     */
    public $authUrl = 'https://slack.com/oauth/authorize';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://slack.com/api/oauth.access';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://slack.com/api';

    /**
     * @inheritdoc
     */
    public $scope = 'identity.basic';

    /**
     * @inheritdoc
     */
    public $attributeNames = [
        'id',
        'identity.basic',
    ];

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        return $this->api('users.info?', 'GET');
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
    protected function defaultName()
    {
        return 'slack';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Slack';
    }

}
