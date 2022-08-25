<?php

namespace FondOfOryx\Client\SharedCustomerSession\Dependency\Client;

use Generated\Shared\Transfer\OauthAccessTokenValidationRequestTransfer;
use Generated\Shared\Transfer\OauthAccessTokenValidationResponseTransfer;
use Spryker\Client\Oauth\OauthClientInterface;

class SharedCustomerSessionToOAuthClientBridge implements SharedCustomerSessionToOAuthClientInterface
{
    /**
     * @var \Spryker\Client\Oauth\OauthClientInterface
     */
    private $client;

    /**
     * @param \Spryker\Client\Oauth\OauthClientInterface $client
     */
    public function __construct(OauthClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param \Generated\Shared\Transfer\OauthAccessTokenValidationRequestTransfer $authAccessTokenValidationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\OauthAccessTokenValidationResponseTransfer
     */
    public function validateOauthAccessToken(
        OauthAccessTokenValidationRequestTransfer $authAccessTokenValidationRequestTransfer
    ): OauthAccessTokenValidationResponseTransfer {
        return $this->client->validateOauthAccessToken($authAccessTokenValidationRequestTransfer);
    }
}
