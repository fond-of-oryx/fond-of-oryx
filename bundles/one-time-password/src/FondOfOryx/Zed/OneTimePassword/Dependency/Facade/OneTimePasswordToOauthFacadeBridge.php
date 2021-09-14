<?php

namespace FondOfOryx\Zed\OneTimePassword\Dependency\Facade;

use Generated\Shared\Transfer\OauthRequestTransfer;
use Generated\Shared\Transfer\OauthResponseTransfer;
use Spryker\Zed\Oauth\Business\OauthFacadeInterface;

class OneTimePasswordToOauthFacadeBridge implements OneTimePasswordToOauthFacadeInterface
{
    /**
     * @var \Spryker\Zed\Oauth\Business\OauthFacadeInterface
     */
    protected $oauthFacade;

    /**
     * @param \Spryker\Zed\Oauth\Business\OauthFacadeInterface $oauthFacade
     */
    public function __construct(OauthFacadeInterface $oauthFacade)
    {
        $this->oauthFacade = $oauthFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\OauthRequestTransfer $oauthRequestTransfer
     *
     * @return \Generated\Shared\Transfer\OauthResponseTransfer
     */
    public function processAccessTokenRequest(OauthRequestTransfer $oauthRequestTransfer): OauthResponseTransfer
    {
        return $this->oauthFacade->processAccessTokenRequest($oauthRequestTransfer);
    }
}
