<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.org/en/licences
 */

namespace humhub\modules\user\authclient;

use Yii;
use yii\helpers\Url;
use yii\authclient\OAuth2;
use yii\base\ErrorException;

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
            'cssIcon' => 'fa fa-slack',
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
    public $apiBaseUrl = 'https://api.slack.com';

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
        return $this->api('users.identity', 'GET');
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
        return 'slack';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle() {
        return 'Slack';
    }
}
