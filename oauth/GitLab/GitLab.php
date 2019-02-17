<?php


/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2019 HumHub GmbH & Co. KG
 * @license https://www.humhub.org/en/licences
 */

namespace humhub\modules\user\authclient;

use yii\authclient\OAuth2;

/**
 * GitLab authentication via GitLab OAuth2.
 */
class GitLab extends OAuth2
{
    /**
     * @inheritdoc
     */
    public $authUrl = 'https://gitlab.com/oauth/authorize';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://gitlab.com/oauth/token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://gitlab.com/api/v4/';

    /**
     * @inheritdoc
     */
    public $scope = 'read_user';

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        return $this->api('user', 'GET');
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'gitlab';
    }

/**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'GitLab';
    }

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fa fa-gitlab',
            'buttonBackgroundColor' => '#395697',
        ];
    }
}
