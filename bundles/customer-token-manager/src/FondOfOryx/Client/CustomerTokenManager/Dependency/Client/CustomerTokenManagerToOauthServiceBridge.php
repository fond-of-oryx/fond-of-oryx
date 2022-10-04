<?php

namespace FondOfOryx\Client\CustomerTokenManager\Dependency\Client;

use Generated\Shared\Transfer\OauthAccessTokenDataTransfer;
use Spryker\Service\Oauth\OauthServiceInterface;

class CustomerTokenManagerToOauthServiceBridge implements CustomerTokenManagerToOauthServiceBridgeInterface
{
    /**
     * @var \Spryker\Service\Oauth\OauthServiceInterface
     */
    protected $oauthService;

    /**
     * @param \Spryker\Service\Oauth\OauthServiceInterface $oauthService
     */
    public function __construct(OauthServiceInterface $oauthService)
    {
        $this->oauthService = $oauthService;
    }

    /**
     * @param string $token
     *
     * @return \Generated\Shared\Transfer\OauthAccessTokenDataTransfer
     */
    public function extractAccessTokenData(string $token): OauthAccessTokenDataTransfer
    {
        return $this->oauthService->extractAccessTokenData($token);
    }
}
