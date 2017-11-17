<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\authclient;

use yii\authclient\OAuth2;
use yii\web\HttpException;
use Yii;

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
            'cssIcon' => 'fa fa-wordpress',
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
	public $requestTokenUrl = 'https://public-api.wordpress.com/oauth2/token';
	
	/**
	 * @inheritdoc
	 */
	public $apiBaseUrl = 'https://public-api.wordpress.com';

	/**
	 * @inheritdoc
	 */
	public $requestTokenMethod = 'POST';

	/**
	 * @inheritdoc
	 */
	public $accessTokenMethod = 'POST';

	/**
	 * @inheritdoc
	 */
	public $authorizationHeaderMethods = [ 'POST', 'PATCH', 'PUT', 'DELETE' ];

	/**
	 * @inheritdoc
	 */
	protected function initUserAttributes() {
		return $this->api( 'account/verify_credentials.json', 'GET', $this->attributeParams );
	}

	/**
	 * @inheritdoc
	 */
	protected function defaultName() {
		return 'wordpress';
	}

	/**
	 * @inheritdoc
	 */
	protected function defaultTitle() {
		return 'WordPress';
	}
}
