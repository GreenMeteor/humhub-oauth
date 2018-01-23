<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\authclient;

use yii\authclient\OAuth2;

class WordPress extends Oauth2
{

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fab fa-wordpress',
            'buttonBackgroundColor' => '#395697',
        ];
    }

	/**
	 * @inheritdoc
	 */
	public $authUrl = 'https://public-api.wordpress.com/oauth2/authorize';

	/**
	 * @inheritdoc
	 */
	public $tokenUrl = 'https://public-api.wordpress.com/oauth2/token';
	
	/**
	 * @inheritdoc
	 */
	public $apiBaseUrl = 'https://public-api.wordpress.com';

	/**
	 * @inheritdoc
	 */
	protected function initUserAttributes() {
		return $this->api('account/verify_credentials.json', 'GET');
	}

	/**
	 * @inheritdoc
	 */
	public function applyAccessTokenToRequest($request, $accessToken)
	{
		$request->getHeaders()->set('Authorization', 'Bearer '. $accessToken->getToken());
	}

	/**
	 * @inheritdoc
	 */
	protected function defaultName()
	{
	return 'wordpress';
	}

	/**
	 * @inheritdoc
	 */
	protected function defaultTitle()
	{
		return 'WordPress';
	}
}
