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

class Discord extends OAuth2
{

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fa fa-discord',
            'buttonBackgroundColor' => '#395697',
        ];
    }

    /**
     * @inheritdoc
     */
    public $authUrl = 'https://discordapp.com/api/oauth2/authorize';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://discordapp.com/api/oauth2/token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://discordapp.com/api';

    /**
     * An array of available OAuth scopes.
     *
     * @var array Available scopes.
     */
    protected $scopes = [
        'identify', // Allows you to retrieve user data (except for email)
        'email', // The same as identify but with email
        'connections', // Allows you to retrieve connected YouTube and Twitch accounts
        'guilds', // Allows you to retrieve the guilds the user is in
        'guilds.join', // Allows you to join the guild for the user
        'bot', // Defines a bot
    ];

    /**
     * {@inheritdoc}
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return $this->api('/users/@me', 'GET');
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaultScopes()
    {
        return ['identify', 'email'];
    }

    /**
     * {@inheritdoc}
     */
    public function getScopeSeparator()
    {
        return ' ';
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthorizationHeaders($token = null)
    {
        return [
            'Authorization' => 'Bearer '.$token->getToken(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (isset($data['error'])) {
            throw new ErrorException('Error in response from Discord: '.$data['error']);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new User($this, $token, (array) $response);
    }

    /**
     * Runs a request.
     *
     * @param string      $method  The HTTP method.
     * @param string      $url     The URL.
     * @param AccessToken $token   The auth token.
     * @param array       $options An array of request options.
     *
     * @return array Response.
     */
    public function request($method, $url, $token, array $options = [])
    {
        $request = $this->getAuthenticatedRequest(
            $method, $url, $token, $options
        );
        return $this->getResponse($request);
    }

    /**
     * Gets the guilds endpoint.
     *
     * @return string Endpoint.
     */
    public function getGuildsEndpoint()
    {
        return $this->api('/users/@me/guilds','GET');
    }

    /**
     * Gets the connections endpoint.
     *
     * @return string Endpoint.
     */
    public function getConnectionsEndpoint()
    {
        return $this->api('/users/@me/connections', 'GET');
    }

    /**
     * Gets the accept invite endpoint.
     *
     * @param string $invite The invite.
     *
     * @return string Endpoint.
     */
    public function getInviteEndpoint($invite)
    {
        return $this->api('/invites/'.$invite);
    }

    /**
     * Builds a part.
     *
     * @param string      $part       The part to build.
     * @param AccessToken $token      The access token.
     * @param array       $attributes Array of attributes.
     *
     * @return Part A part.
     */
    public function buildPart($part, AccessToken $token, $attributes = [])
    {
        return new $part($this, $token, (array) $attributes);
    }

    /**
     * @inheritdoc
     */
    protected function defaultName() {
        return 'discord';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle() {
        return 'Discord';
    }
}
