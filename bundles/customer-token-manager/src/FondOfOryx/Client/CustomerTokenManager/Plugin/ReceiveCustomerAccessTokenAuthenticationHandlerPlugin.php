<?php

namespace FondOfOryx\Client\CustomerTokenManager\Plugin;

use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\OauthAccessTokenValidationRequestTransfer;
use Spryker\Client\CustomerExtension\Dependency\Plugin\AccessTokenAuthenticationHandlerPluginInterface;
use Spryker\Client\Kernel\AbstractPlugin;

/**
 * @method \FondOfOryx\Client\CustomerTokenManager\CustomerTokenManagerFactory getFactory()
 */
class ReceiveCustomerAccessTokenAuthenticationHandlerPlugin extends AbstractPlugin implements AccessTokenAuthenticationHandlerPluginInterface
{
    /**
     * @inheriDoc
     *
     * @param string $accessToken
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function getCustomerByAccessToken(string $accessToken): CustomerResponseTransfer
    {
        $authAccessTokenValidationRequestTransfer = (new OauthAccessTokenValidationRequestTransfer())
            ->setAccessToken($accessToken);

        $authAccessTokenValidationResponseTransfer = $this->getFactory()
            ->getOAuthCLient()
            ->validateOauthAccessToken($authAccessTokenValidationRequestTransfer);

        if ($authAccessTokenValidationResponseTransfer->getIsValid() === false) {
            return (new CustomerResponseTransfer())->setIsSuccess(false);
        }

        return $this->getFactory()
            ->getCustomerClient()
            ->getCustomerByAccessToken($accessToken);
    }
}
