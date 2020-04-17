<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\authclient;

use yii\authclient\OAuth2;
use yii\web\HttpException;
use Yii;

class WeChat extends OAuth2
{

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 800,
            'popupHeight' => 500,
            'cssIcon' => 'fab fa-weixin',
            'buttonBackgroundColor' => '#395697',
        ];
    }

    /**
     * @inheritdoc
     */
    public $authUrl = 'https://open.weixin.qq.com/connect/qrconnect';

    /**
     * @inheritdoc
     */
    public $authUrlMp = 'https://open.weixin.qq.com/connect/oauth2/authorize';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://api.weixin.qq.com/sns/oauth2/access_token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://api.weixin.qq.com';

    /**
     * @inheritdoc
     */
    public $scope = 'snsapi_base';

    /**
     * @inheritdoc
     */
    public $type = null;
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->scope === null) {
            $this->scope = implode(',', [
                'snsapi_userinfo',
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    protected function defaultNormalizeUserAttributeMap()
    {
        return [
            'id' => 'openid',
            'username' => 'nickname',
        ];
    }

    /**
     * @inheritdoc
     */
    public function buildAuthUrl(array $params = [])
    {
        $authState = $this->generateAuthState();
        $this->setState('authState', $authState);
        $defaultParams = [
            'appid' => $this->clientId,
            'redirect_uri' => $this->getReturnUrl(),
            'response_type' => 'code',
        ];
        if (!empty($this->scope)) {
            $defaultParams['scope'] = $this->scope;
        }
        $defaultParams['state'] = $authState;
        $url = $this->type == 'mp'?$this->authUrlMp:$this->authUrl;
        return $this->composeUrl($url, array_merge($defaultParams, $params));
    }

    /**
     * @inheritdoc
     */
	public function fetchAccessToken($authCode, array $params = [])
    {
        $authState = $this->getState('authState');
        if (!isset($_REQUEST['state']) || empty($authState) || strcmp($_REQUEST['state'], $authState) !== 0) {
            throw new HttpException(400, 'Invalid auth state parameter.');
        }
        $params['appid'] = $this->clientId;
        $params['secret'] = $this->clientSecret;
        return parent::fetchAccessToken($authCode, $params);
    }

    /**
     * @inheritdoc
     */
    // protected function apiInternal($accessToken, $url, $method, array $params, array $headers)
    // {
    //     $params['access_token'] = $accessToken->getToken();
    //     $params['openid'] = $accessToken->getParam('openid');
    //     $params['lang'] = 'zh_CN';
    //     return $this->sendRequest($method, $url, $params, $headers);
    // }

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        $accessToken = $this->getAccessToken();
        $data = [
            'access_token' => $accessToken->getToken(),
            'openid' => $accessToken->getParam('openid'),
            'lang' => 'zh-CN'
        ];
        return $this->api('sns/userinfo','GET',$data);
//        $userAttributes['id'] = $userAttributes['unionid'];
//        return $userAttributes;
    }

    /**
     * @inheritdoc
     */
    protected function defaultReturnUrl()
    {
        $params = $_GET;
        unset($params['code']);
        unset($params['state']);
        $params[0] = Yii::$app->controller->getRoute();
        return Yii::$app->getUrlManager()->createAbsoluteUrl($params);
    }

    /**
     * Generates the auth state value.
     * @return string auth state value.
     */
    protected function generateAuthState()
    {
        return sha1(uniqid(get_class($this), true));
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'wechat';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'WeChat';
    }
}
