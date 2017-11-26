<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\authclient;

use yii\authclient\OAuth2;

class Odnoklassniki extends OAuth2
{

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fa fa-odnoklassniki',
            'buttonBackgroundColor' => '#395697',
        ];
    }

    /**
     * @var string
     */
    public $applicationKey;
    /**
     * @inheritdoc
     */
    public $authUrl = 'http://www.odnoklassniki.ru/oauth/authorize';
    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://api.odnoklassniki.ru/oauth/token.do';
    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'http://api.odnoklassniki.ru';
    /**
     * @inheritdoc
     */
    public $scope = 'VALUABLE_ACCESS';
    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        $params = [];
        $params['access_token'] = $this->accessToken->getToken();
        $params['application_key'] = $this->applicationKey;
        $params['sig'] = $this->sig($params, $params['access_token'], $this->clientSecret);
        return $this->api('api/users/getCurrentUser', 'GET', $params);
    }
    /**
     * @inheritdoc
     */
    protected function apiInternal($accessToken, $url, $method, array $params, array $headers)
    {
        $params['access_token'] = $accessToken->getToken();
        $params['application_key'] = $this->applicationKey;
        $params['method'] = str_replace('/', '.', str_replace('api/', '', $url));
        $params['sig'] = $this->sig($params, $params['access_token'], $this->clientSecret);
        return $this->sendRequest($method, $url, $params, $headers);
    }
    /**
     * Generates a signature
     * @param $vars array
     * @param $accessToken string
     * @param $secret string
     * @return string
     */
    protected function sig($vars, $accessToken, $secret)
    {
        ksort($vars);
        $params = '';
        foreach ($vars as $key => $value) {
            if (in_array($key, ['sig', 'access_token'])) {
                continue;
            }
            $params .= "$key=$value";
        }
        return md5($params . md5($accessToken . $secret));
    }
    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'odnoklassniki';
    }
    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Odnoklassniki';
    }
    
    /**
     * @inheritdoc
     */
    protected function defaultNormalizeUserAttributeMap()
    {
        return [
            'id' => 'uid'
        ];
    }
}
