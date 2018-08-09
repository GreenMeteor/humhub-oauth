<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.org/licences
 */

namespace humhub\modules\user\authclient;

use yii\authclient\OAuth2;

class Lianluo extends OAuth2
{

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fa fa-globe',
            'buttonBackgroundColor' => '#395697',
        ];
    }

    public $authUrl = 'https://mops-ucenter.lianluo.com/oauth2/auth';

    public $tokenUrl = 'https://mops-ucenter.lianluo.com/oauth2/token';

    public $apiBaseUrl = 'https://mops-ucenter.lianluo.com/api/oauth2/v1';

    protected function initUserAttributes()
    {
        return $this->api('users', 'GET');
    }

    protected function defaultName()
    {
        return '联络互动';
    }

   protected function defaultTitle()
    {
        return '联络互动';
    }
}
