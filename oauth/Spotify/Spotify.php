<?php

/**
 * @link https://www.greenmeteor.net/
 * @copyright Copyright (c) 2020 Green Meteor Co.
 * @license https://greenmeteor.net/p/licences
 */

namespace humhub\modules\user\authclient;

use yii\authclient\OAuth2;

/**
 * Spotify Authclient
 */
class Spotify extends OAuth2
{
    /**
     * @inheritdoc
     */
    public $authUrl = 'https://accounts.spotify.com/authorize';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://accounts.spotify.com/api/token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://api.spotify.com/v1';

    /**
     * @inheritdoc
     */
    public $scope = 'user-read-email user-read-private';

    /**
     * @var array list of attribute names, which should be requested from API to initialize user attributes.
     */
    public $attributeNames = [
        'id',
        'display_name',
        'email',
    ];

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        return $this->api('me', 'GET', [
            'fields' => implode(',', $this->attributeNames),
        ]);
    }

    /**
     * @inheritdoc
     */
    protected function defaultNormalizeUserAttributeMap()
    {
        return [
            'name' => 'display_name',
        ];
    }

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fa fa-spotify',
            'buttonBackgroundColor' => '#395697',
        ];
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'spotify';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Spotify';
    }
}
