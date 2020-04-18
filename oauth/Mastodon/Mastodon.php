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
 * Mastodon Authclient
 */
class Mastodon extends Oauth2
{
    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fab fa-mastodon',
            'buttonBackgroundColor' => '#395697',
        ];
    }

    /**
     * @inheritdoc
     */
    public $authUrl = 'https://mastodon.social/oauth/authorize';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://mastodon.social/oauth/token';

    /**
     * @inheritdoc
     */
    public $revokeUrl = 'https://mastodon.social/oauth/revoke';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://mastodon.social/api/v1';

    /**
     * @inheritdoc
     */
    public $scope = 'read';

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        return $this->api('accounts/verify_credentials', 'GET');
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
        return 'mastodon';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle() {
        return 'Mastodon';
    }
}
