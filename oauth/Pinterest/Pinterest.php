<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\authclient;

use yii\authclient\OAuth2;

class Pinterest extends OAuth2
{
    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fab fa-pinterest',
            'buttonBackgroundColor' => '#4078C0',
        ];
    }

    /**
     * @inheritdoc
     */
    public $authUrl = 'https://api.pinterest.com/oauth/';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://api.pinterest.com/v1/oauth/token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://api.pinterest.com/v1';

    /**
     * @var array list of attribute names, which should be requested from API to initialize user attributes.
     */
    public $attributeNames = [
        'id',
        'username',
        'first_name',
        'last_name',
    ];

    /**
     * @inheritdoc
     */
    protected function defaultNormalizeUserAttributeMap()
    {
        return [
            'username' => 'username',
            'first_name' => 'first-name',
            'last_name' => 'last-name',
        ];
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->scope === null) {
            $this->scope = 'read_public';
        }
    }

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
    protected function defaultName()
    {
        return 'pinterest';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Pinterest';
    }
}
