<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\authclient;

use yii\authclient\OAuth2;

class Foursquare extends OAuth2
{

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fab fa-foursquare',
            'buttonBackgroundColor' => '#395697',
        ];
    }

    /**
     * @inheritdoc
     */
    public $authUrl = 'https://foursquare.com/oauth2/authenticate';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://foursquare.com/oauth2/access_token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://api.foursquare.com/v2';

    /**
     * @var string param is a date in php:date('Ymd') [YYYYMMDD] format
     */
    public $v;

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        return $this->api('users/self', 'GET');
    }

    /**
     * @inheritdoc
     */
    public function applyAccessTokenToRequest($request, $accessToken)
    {
        $this->v = empty($this->v) ? date('Ymd') : $this->v;
        $data = $request->getData();
        $data['oauth_token'] = $accessToken->getToken();
        $data['v'] = isset($data['v']) ? $data['v'] : $this->v;
        $request->setData($data);
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'foursquare';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Foursquare';
    }
}
