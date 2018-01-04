<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\authclient;

use Yii;
use yii\helpers\Url;
use yii\authclient\OAuth2;
use yii\base\ErrorException;

class Slack extends OAuth2
{

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fa fa-slack',
            'buttonBackgroundColor' => '#395697',
        ];
    }

    /**
     * @inheritdoc
     */
    public $authUrl = 'https://slack.com/oauth/authorize';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://slack.com/api/oauth.access';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://api.slack.com';

    public function init() {
        parent::init();
        if ($this->scope === null) {
            $this->scope = 'identity.basic';
        }
        // https://api.slack.com/docs/sign-in-with-slack
        $scopes = explode(',', $this->scope);
        if (!in_array('identity.basic', $scopes)) {
            throw new ErrorException("If you're just logging users in, set this to identity.basic. You can't ask for identity.email, identity.team, or identity.avatar without also asking for identity.basic.");
        }
    }

    /**
     * 
     * @param array $params
     * @return type
     */
    public function buildAuthUrl(array $params = array()) {
        $params['state'] = 'login';
        return parent::buildAuthUrl($params);
    }

    /**
     * @inheritdoc
     * @return type
     * @throws \yii\base\InvalidConfigException
     */
    protected function initUserAttributes() {
        $params = $this->getAccessToken()->getParams();
        if (!$params['ok']) {
            throw new \yii\base\InvalidConfigException("Invalid Slack Configuration");
        }
        return $params;
    }

    /**
     * 
     * @return type
     */
    protected function defaultReturnUrl() {
        $url = parent::defaultReturnUrl();
        $url = str_replace('&state=login', '', $url);
        return $url;
    }

    /**
     * @inheritdoc
     */
    protected function defaultName() {
        return 'slack';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle() {
        return 'Slack';
    }
}
