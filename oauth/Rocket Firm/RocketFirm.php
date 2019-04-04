<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\authclient;

use yii\authclient\OAuth2;

class RocketFirm extends OAuth2
{
    /**
     * @inheritdoc
     */
    public $authUrl = 'https://auth.rocketfirm.com/oauth/authorize';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://auth.rocketfirm.com/oauth/token';
    
    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://auth.rocketfirm.com';

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fa fa-rocket',
            'buttonBackgroundColor' => '#e0492f',
        ];
    }

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        return $this->api('api/user', 'GET');
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
        return 'rocket firm';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Rocket Firm';
    }
}
