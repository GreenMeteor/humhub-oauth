<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\authclient;

use yii\authclient\OAuth2;

class Storenvy extends OAuth2
{
    /**
     * @inheritdoc
     */
    public $authUrl = 'https://www.storenvy.com/oauth/authorize';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://api.storenvy.com/oauth/token';
    
    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://api.storenvy.com/v1';

    /**
     * @inheritdoc
     */
    public $scope = 'user';

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fa fa-shopping-bag',
            'buttonBackgroundColor' => '#e0492f',
        ];
    }

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        return $this->api('/me', 'GET');
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
        return 'storenvy';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Storenvy';
    }
}
