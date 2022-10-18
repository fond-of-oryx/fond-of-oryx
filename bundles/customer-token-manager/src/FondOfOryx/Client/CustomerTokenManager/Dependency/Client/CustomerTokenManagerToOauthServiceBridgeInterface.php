<?php

namespace FondOfOryx\Client\CustomerTokenManager\Dependency\Client;

use Generated\Shared\Transfer\OauthAccessTokenDataTransfer;

interface CustomerTokenManagerToOauthServiceBridgeInterface
{
    /**
     * @param string $token
     *
     * @return \Generated\Shared\Transfer\OauthAccessTokenDataTransfer
     */
    public function extractAccessTokenData(string $token): OauthAccessTokenDataTransfer;
}
