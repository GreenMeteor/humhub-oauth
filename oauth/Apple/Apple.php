<?php

/**
 * @link https://www.greenmeteor.net/
 * @copyright Copyright (c) 2020 Green Meteor Co.
 * @license https://greenmeteor.net/p/licences
 */

namespace gm\modules\oauth\authclient;

use yii\authclient\OAuth2;

class Apple extends OAuth2
{
    /**
     * @inheritdoc
     */
    public $authUrl = 'https://appleid.apple.com/auth/authorize';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://appleid.apple.com/auth/token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://appleid.apple.com/auth/';

    /**
     * @inheritdoc
     */
    public $scope = 'name email';

    protected function initUserAttributes()
    {
        $response = $this->getAccessToken()->getParams();
        $userData = explode('.', $response['id_token'])[1];
        $userData = (array)json_decode(base64_decode($userData));

        $data = [];
        $data['id'] = $userData['sub'];

        if (isset($_POST['user'])){
            $user = json_decode($_POST['user'], true);
            $fullName = $user["name"]["firstName"] . ' ' . $user["name"]["lastName"];
            $data['name'] = $fullName;
        }

        $data['email'] = $userData['email'];

        return $data;
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'apple';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Apple';
    }

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 680,
            'cssIcon' => 'fa fa-apple',
            'buttonBackgroundColor' => '#395697',
        ];
    }

    public function buildAuthUrl ( $params = [] ){
    	$params['response_mode'] = 'form_post';
    	return parent::buildAuthUrl($params);
    }

}
