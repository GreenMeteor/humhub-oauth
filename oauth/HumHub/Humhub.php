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
 * Humhub Authclient
 */
class Humhub extends Oauth2
{
    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fa fa-sign-in',
            'buttonBackgroundColor' => '#395697',
        ];
    }

    /**
     * @inheritdoc
     */
    public $authUrl = 'TBA';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'TBA';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'http://localhost/api/v1';

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        return $this->api('user/{id}', 'GET');
    }

    /**
     * @inheritdoc
     */
    protected function defaultName() {
        return 'humhub';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle() {
        return 'HumHub';
    }
}
