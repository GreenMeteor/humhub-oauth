<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 * @deprecated since 1.0.5
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
            'cssIcon' => 'fab fa-odnoklassniki',
            'buttonBackgroundColor' => '#395697',
        ];
    }
    
    /*
    * @var string
    */
    public $applicationKey; //= 'CBACODHLEBABABABA';
    /**
     * @inheritdoc
     */
    public $authUrl = 'http://www.odnoklassniki.ru/oauth/authorize';
    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://api.odnoklassniki.ru/oauth/token.do'; //?redirect_uri=http%3A%2F%2F5sp.ru%2Fuser%2Fsecurity%2Fauth%3Fauthclient%3Dodnoklassniki';
    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'http://api.odnoklassniki.ru/';
    
    public $scope = 'VALUABLE_ACCESS';
    /**
     * @var array list of attribute names, which should be requested from API to initialize user attributes.
     * @since 2.0.4
     */
    public $attributeNames = [
        'uid',
        'first_name',
        'last_name',
        'nickname',
        'screen_name',
        'sex',
        'bdate',
        'city',
        'country',
        'timezone',
        'photo'
    ];
    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        $params = [];
        $params['access_token'] = $this->accessToken->getToken();
        $params['application_key'] = $this->applicationKey;
        //$params['redirect_uri'] = 'http://5sp.ru/user/security/auth?authclient=odnoklassniki';
        $params['sig'] = $this->sig($params, $params['access_token'], $this->clientSecret);
        //var_dump($this->api('api/users/getCurrentUser', 'GET', $params)); die;
        return $this->api('api/users/getCurrentUser', 'GET', $params);
    }
    /**
     * @inheritdoc
     */
    public function applyAccessTokenToRequest($request, $accessToken)
    {
        $data = $request->getData();
        $data['uids'] = $accessToken->getParam('user_id');
        $data['access_token'] = $accessToken->getToken();
        $request->setData($data);
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
