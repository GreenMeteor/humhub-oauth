<?php

/**
 * @link https://www.greenmeteor.net/
 * @copyright Copyright (c) 2020 Green Meteor Co.
 * @license https://greenmeteor.net/p/licences
 */

namespace humhub\modules\user\authclient;

use Yii;
use yii\authclient\OAuth2;
use yii\helpers\Json;
use Firebase\JWT\JWT;
use Firebase\JWT\JWK;
use Firebase\JWT\Key;
use yii\base\Exception;
use humhub\libs\Html;
use yii\web\BadRequestHttpException;

/**
 * Apple OAuth 2.0 client for HumHub.
 */
class Apple extends OAuth2
{
    /**
     * @var string OAuth authorization URL
     * @inheritdoc
     */
    public $authUrl = 'https://appleid.apple.com/auth/authorize';

    /**
     * @var string OAuth token URL
     * @inheritdoc
     */
    public $tokenUrl = 'https://appleid.apple.com/auth/token';

    /**
     * @var string API base URL
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://appleid.apple.com/auth/';

    /**
     * @var string OAuth scopes requested
     * @inheritdoc
     */
    public $scope = 'name email';

    /**
     * @var string Session key to store the nonce value
     * Nonce is used to prevent replay attacks and is verified against id_token
     */
    protected $nonceSessionKey = 'apple_oauth_nonce';

    /**
     * Initializes the user attributes from the access token.
     * 
     * Extracts user information from the ID token and verifies its authenticity.
     * For first-time sign-ins, name information is extracted from the POST data.
     * 
     * @return array User attributes
     * @throws BadRequestHttpException if nonce validation fails
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        $token = $this->getAccessToken();
        $params = $token->getParams();

        if (empty($params['id_token'])) {
            return [];
        }

        $idToken = $params['id_token'];
        $payload = $this->verifyAndDecodeJWT($idToken);

        if (!$payload || !isset($payload['sub'])) {
            return [];
        }

        $nonce = Html::nonce();
        if (!empty($nonce) && (!isset($payload['nonce']) || $payload['nonce'] !== $nonce)) {
            throw new BadRequestHttpException('Invalid nonce in Apple ID token');
        }

        $data = [
            'id' => $payload['sub'],
            'email' => $payload['email'] ?? null,
            'email_verified' => $payload['email_verified'] ?? null,
        ];

        $userJson = Yii::$app->request->post('user');
        if (!empty($userJson)) {
            try {
                $user = Json::decode($userJson, true);
                if (!empty($user['name']['firstName']) && !empty($user['name']['lastName'])) {
                    $data['first_name'] = $user['name']['firstName'];
                    $data['last_name'] = $user['name']['lastName'];
                    $data['name'] = $data['first_name'] . ' ' . $data['last_name'];
                }
            } catch (\Exception $e) {
                Yii::warning('Failed to decode user JSON from Apple: ' . $e->getMessage(), __METHOD__);
            }
        }

        return $data;
    }

    /**
     * Verifies and decodes an Apple ID token using Apple's public keys.
     * 
     * Fetches Apple's public JWKs and uses them to validate the signature
     * of the JWT token provided by Apple during authentication.
     *
     * @param string $jwt The ID token to verify and decode
     * @return array|null Decoded token payload or null on failure
     */
    protected function verifyAndDecodeJWT(string $jwt): ?array
    {
        try {
            $jwks = Json::decode(file_get_contents('https://appleid.apple.com/auth/keys'));
            $decoded = JWT::decode($jwt, JWK::parseKeySet($jwks));

            return (array) $decoded;
        } catch (\Exception $e) {
            Yii::error('Apple ID Token verification failed: ' . $e->getMessage(), __METHOD__);
            return null;
        }
    }

    /**
     * Returns the default client name.
     * 
     * @return string The client name
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'apple';
    }

    /**
     * Returns the default client title.
     * 
     * @return string The client title
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Apple';
    }

    /**
     * Returns the default view options for rendering.
     * 
     * @return array Default view options
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 680,
            'cssIcon' => 'fa fa-apple',
            'buttonBackgroundColor' => '#000000',
        ];
    }

    /**
     * Builds the authorization URL for Apple OAuth.
     * 
     * Generates a secure nonce, stores it in the session, and includes
     * it in the authorization request to prevent replay attacks.
     * 
     * @param array $params Additional query parameters
     * @return string Authorization URL
     * @inheritdoc
     */
    public function buildAuthUrl($params = [])
    {
        $nonce = Html::nonce();
        Yii::$app->session->set($this->nonceSessionKey, $nonce);

        $params['response_mode'] = 'form_post';
        $params['response_type'] = 'code id_token';
        $params['nonce'] = $nonce;

        return parent::buildAuthUrl($params);
    }
}
