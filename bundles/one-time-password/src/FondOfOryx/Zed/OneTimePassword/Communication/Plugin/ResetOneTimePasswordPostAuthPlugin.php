<?php

namespace FondOfOryx\Zed\OneTimePassword\Communication\Plugin;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OauthResponseTransfer;
use Spryker\Zed\AuthRestApiExtension\Dependency\Plugin\PostAuthPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig getConfig()
 */
class ResetOneTimePasswordPostAuthPlugin extends AbstractPlugin implements PostAuthPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\OauthResponseTransfer $oauthResponseTransfer
     *
     * @return void
     */
    public function postAuth(OauthResponseTransfer $oauthResponseTransfer): void
    {
        $customerTransfer = (new CustomerTransfer())->setCustomerReference($oauthResponseTransfer->getCustomerReference());

        $this->getFacade()->resetOneTimePassword($customerTransfer);
    }
}
