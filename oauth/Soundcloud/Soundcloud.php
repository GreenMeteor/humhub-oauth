<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 * @deprecated since 1.0.4
 */

namespace humhub\modules\user\authclient;

use yii\authclient\OAuth2;
use yii\base\InvalidConfigException;

class Soundcloud extends OAuth2
{

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fa fa-soundcloud',
            'buttonBackgroundColor' => '#395697',
        ];
    }

    /**
     * @var string Soundcloud Client ID
     */
    protected $clientId;
    /**
     * @var string Soundcloud Client Secret
     */
    protected $clientSecret;
    /**
     * @var string Soundcloud Auth Callback Url
     */
    protected $callbackUrl;
    /**
     * @inheritdoc 
     */
    protected $soundcloud;
    public function __construct($config = [])
    {
        foreach ($config as $param => $value) {
            $this->$param = $value;
        }
        $this->validateParameters();
        $this->init();
    }
    /**
     * Validates supplied Params.
     *
     * @return void
     * @throws InvalidConfigException
     */
    protected function validateParameters()
    {
        if (empty($this->clientId) || !is_string($this->clientId)) {
            throw new InvalidConfigException("clientId cannot be empty and it must be a string");
        }
        if (empty($this->clientSecret) || !is_string($this->clientSecret)) {
            throw new InvalidConfigException("clientSecret cannot be empty and it must be a string");
        }
    }
    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function init()
    {
        $this->soundcloud = new Sc($this->clientId, $this->clientSecret, $this->callbackUrl);
    }
    public function __call($method, $args = [])
    {
        return call_user_func_array(array($this->soundcloud, $method), $args);
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'soundcloud';
    }
    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Soundcloud';
    }

}
