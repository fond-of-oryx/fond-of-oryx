<?php

namespace FondOfOryx\Zed\OneTimePassword\Dependency\Facade;

use Generated\Shared\Transfer\OauthRequestTransfer;
use Generated\Shared\Transfer\OauthResponseTransfer;

interface OneTimePasswordToOauthFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\OauthRequestTransfer $oauthRequestTransfer
     *
     * @return \Generated\Shared\Transfer\OauthResponseTransfer
     */
    public function processAccessTokenRequest(OauthRequestTransfer $oauthRequestTransfer): OauthResponseTransfer;
}
